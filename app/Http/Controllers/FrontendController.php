<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use App\Models\Application;
use App\Models\User;
use Illuminate\Support\Str;
use Illuminate\Support\Facades\DB;
use Illuminate\Support\Facades\Hash;
use Illuminate\Support\Facades\Http;
use Illuminate\Support\Facades\Log;
class FrontendController extends Controller
{
    // =============================================
    // HOMEPAGE
    // =============================================

    /** Homepage — standalone full-page view (hero slider, stats, news) */
    public function index()
    {
        // Visitor stats: AppServiceProvider view composer (frontend.* scope only)
        return view('frontend.mwanzo');
    }

    // =============================================
    // APPLICATION MODULE
    // =============================================

    /** Show the multi-step application form */
    public function showApplyForm()
    {
        return view('frontend.apply');
    }

    /** Handle application form submission — create record & redirect to checkout */
    public function submitApplication(Request $request)
    {
        $validated = $request->validate([
            'full_name'      => 'required|string|max:255',
            'email'          => 'nullable|email|max:255',
            'phone_number'   => 'required|string|max:20',
            'gender'         => 'required|in:Male,Female',
            'date_of_birth'  => 'nullable|date',
            'course_applied' => 'required|string|max:255',
            'course_type'    => 'required|in:muda_mrefu,muda_mfupi',
        ], [
            'full_name.required'      => 'Tafadhali jaza jina lako kamili.',
            'full_name.max'           => 'Jina haliwezi kuwa na herufi zaidi ya 255.',
            'email.email'             => 'Tafadhali ingiza barua pepe sahihi.',
            'phone_number.required'   => 'Namba ya simu inahitajika.',
            'phone_number.max'        => 'Namba ya simu ni ndefu mno.',
            'gender.required'         => 'Tafadhali chagua jinsia yako.',
            'gender.in'               => 'Jinsia uliyochagua siyo sahihi.',
            'date_of_birth.date'      => 'Tarehe ya kuzaliwa siyo sahihi.',
            'course_applied.required' => 'Tafadhali chagua kozi unayoomba.',
            'course_type.required'    => 'Tafadhali chagua aina ya kozi.',
            'course_type.in'          => 'Aina ya kozi uliyochagua siyo sahihi.',
        ]);

        $validated['payment_reference'] = strtoupper(Str::random(10));
        $validated['application_status'] = 'pending_payment';
        $validated['amount'] = 15000.00; // application fee in TZS

        $application = Application::create($validated);

        return redirect()->route('apply.checkout', $application->payment_reference);
    }

    /** Show the payment checkout page for a given application reference */
    public function showCheckout(string $reference)
    {
        $application = Application::where('payment_reference', $reference)->firstOrFail();

        return view('frontend.apply_checkout', compact('application'));
    }

    /**
     * Initiate a Beem C2B push payment request.
     * Called via AJAX or form POST from the checkout page.
     */
    public function initiateBeemPayment(Request $request)
    {
        $request->validate([
            'reference' => 'required|string',
        ]);

        $application = Application::where('payment_reference', $request->reference)
            ->where('application_status', 'pending_payment')
            ->firstOrFail();

        $apiKey    = config('services.beem.api_key');
        $secretKey = config('services.beem.secret_key');
        $amount    = 15000;

        $payload = [
            'msisdn'       => $application->phone_number,
            'amount'       => $amount,
            'reference'    => $application->payment_reference,
            'currency'     => 'TZS',
            'vendor'       => config('services.beem.vendor_id'),
            'extra_fields' => [
                'full_name' => $application->full_name,
            ],
        ];

        try {
            $response = Http::withBasicAuth($apiKey, $secretKey)
                ->timeout(30)
                ->post('https://apigw.beemafrica.com/v1/c2b/push', $payload);

            if ($response->successful()) {
                $data = $response->json();
                $application->update([
                    'beem_transaction_id' => $data['transaction_id'] ?? null,
                    'beem_reference'      => $data['reference']      ?? null,
                ]);

                return response()->json(['success' => true, 'message' => 'Ombi la malipo limetumwa. Angalia simu yako.']);
            }

            Log::error('Beem push failed', ['response' => $response->body(), 'ref' => $application->payment_reference]);
            return response()->json(['success' => false, 'message' => 'Imeshindwa kutuma ombi la malipo. Jaribu tena.'], 422);

        } catch (\Exception $e) {
            Log::error('Beem push exception', ['error' => $e->getMessage()]);
            return response()->json(['success' => false, 'message' => 'Hitilafu ya mtandao. Jaribu tena.'], 500);
        }
    }

    /**
     * Beem webhook — called by Beem when payment is confirmed.
     * Creates a student user account and sends SMS login credentials.
     */
    public function beemWebhook(Request $request)
    {
        Log::info('Beem webhook received', $request->all());

        // Verify the webhook secret to prevent spoofing
        $webhookSecret = config('services.beem.webhook_secret');
        if ($webhookSecret && $request->header('X-Beem-Signature') !== $webhookSecret) {
            Log::warning('Beem webhook: invalid signature');
            return response()->json(['error' => 'Unauthorized'], 401);
        }

        $reference = $request->input('reference') ?? $request->input('extra_fields.reference');
        $status    = strtolower($request->input('status', ''));

        if (! $reference || $status !== 'success') {
            return response()->json(['message' => 'ignored'], 200);
        }

        $application = Application::where('payment_reference', $reference)
            ->where('application_status', 'pending_payment')
            ->first();

        if (! $application) {
            // Already processed or not found — return 200 so Beem stops retrying
            return response()->json(['message' => 'already processed'], 200);
        }

        // ── 1. Mark application as paid ──────────────────────────────────────
        $application->update(['application_status' => 'paid']);

        // ── 2. Create student user account ───────────────────────────────────
        $plainPassword = '12345678';

        $user = User::firstOrCreate(
            ['email' => $application->email],
            [
                'name'         => $application->full_name,
                'phone_number' => $application->phone_number,
                'role_name'    => 'Student',
                'status'       => 'active',
                'join_date'    => now()->format('Y-m-d'),
                'password'     => Hash::make($plainPassword),
            ]
        );

        // ── 3. Send SMS via Beem ──────────────────────────────────────────────
        $smsMessage = "Hongera! Malipo yako ya TZS 15,000 yamepokelewa. "
            . "Ingia kwenye mfumo wa Kg FDC ukitumia Email yako na Password: {$plainPassword}.";

        $this->sendBeemSms($application->phone_number, $smsMessage);

        Log::info('Beem webhook: account created', ['user_id' => $user->id, 'ref' => $reference]);

        return response()->json(['message' => 'processed'], 200);
    }

    /**
     * Send an SMS via the Beem SMS API.
     */
    private function sendBeemSms(string $phone, string $message): void
    {
        $apiKey    = config('services.beem.api_key');
        $secretKey = config('services.beem.secret_key');
        $senderId  = config('services.beem.sender_id', 'KgFDC');

        try {
            $response = Http::withBasicAuth($apiKey, $secretKey)
                ->timeout(15)
                ->post('https://apigw.beemafrica.com/v1/sms/send', [
                    'source_addr'  => $senderId,
                    'schedule_time' => '',
                    'encoding'     => '0',
                    'message'      => $message,
                    'recipients'   => [
                        ['recipient_id' => '1', 'dest_addr' => $phone],
                    ],
                ]);

            if (! $response->successful()) {
                Log::error('Beem SMS failed', ['phone' => $phone, 'response' => $response->body()]);
            }
        } catch (\Exception $e) {
            Log::error('Beem SMS exception', ['error' => $e->getMessage()]);
        }
    }

    /** Payment success page — shown after Beem confirms payment */
    public function paymentSuccess(string $reference)
    {
        $application = Application::where('payment_reference', $reference)->firstOrFail();

        return view('frontend.apply_success', compact('application'));
    }

    // =============================================
    // COURSE AJAX HELPER
    // =============================================

    /** Return JSON list of courses for a given type — used by the apply form dropdown */
    public function getCoursesByType(string $type)
    {
        // Base list shared by both course types
        $baseCourses = [
            'Ufundi wa Magari',
            'Ufundi Umeme wa Magari',
            'Ufundi Umeme wa Majumbani',
            'Uchomeleaji na Uungaji Vyuma',
            'Ufundi Bomba',
            'Ushonaji',
            'Ufundi Uashi',
            'Teknolojia ya Habari na Mawasiliano (TEHAMA)',
        ];

        switch ($type) {
            case 'muda_mrefu':
                $courses = $baseCourses;
                break;

            case 'muda_mfupi':
                // Same as long courses, plus Udereva at the end
                $courses = array_merge($baseCourses, ['Udereva (Driving)']);
                break;

            default:
                $courses = [];
        }

        return response()->json($courses);
    }

    // =============================================
    // SEARCH
    // =============================================

    /**
     * Search courses and pages by query string.
     * Matches against both Swahili and English names so the search
     * works regardless of which language the user is browsing in.
     */
    public function search(Request $request)
    {
        $query = trim($request->input('query', ''));

        // Full searchable index — each entry has sw/en names, a route, and an icon
        $index = [
            // ── Courses ──────────────────────────────────────────────────────
            ['sw' => 'Ufundi wa Magari',                             'en' => 'Motor Vehicle Mechanics',                     'route' => 'frontend.ufundi-magari',   'icon' => 'fa-car',           'type' => 'course'],
            ['sw' => 'Ufundi Umeme wa Magari',                       'en' => 'Automotive Electrical Engineering',            'route' => 'frontend.umeme-magari',    'icon' => 'fa-bolt',          'type' => 'course'],
            ['sw' => 'Ufundi Umeme wa Majumbani',                    'en' => 'Domestic Electrical Installation',             'route' => 'frontend.umeme-majumbani', 'icon' => 'fa-plug',          'type' => 'course'],
            ['sw' => 'Uchomeleaji na Uungaji Vyuma',                 'en' => 'Welding & Metal Fabrication',                  'route' => 'frontend.uchomeleaji',     'icon' => 'fa-fire',          'type' => 'course'],
            ['sw' => 'Ufundi Bomba',                                 'en' => 'Plumbing & Pipe Fitting',                      'route' => 'frontend.ufundi-bomba',    'icon' => 'fa-wrench',        'type' => 'course'],
            ['sw' => 'Ushonaji',                                     'en' => 'Tailoring & Garment Making',                   'route' => 'frontend.ushonaji',        'icon' => 'fa-cut',           'type' => 'course'],
            ['sw' => 'Ufundi Uashi',                                 'en' => 'Masonry & Building Construction',              'route' => 'frontend.uashi',           'icon' => 'fa-building',      'type' => 'course'],
            ['sw' => 'Teknolojia ya Habari na Mawasiliano (TEHAMA)', 'en' => 'Information & Communication Technology (ICT)', 'route' => 'frontend.tehama',          'icon' => 'fa-laptop',        'type' => 'course'],
            ['sw' => 'Udereva',                                      'en' => 'Driving',                                      'route' => 'frontend.kozi-mfupi',      'icon' => 'fa-car-side',      'type' => 'course'],
            // ── Pages ────────────────────────────────────────────────────────
            ['sw' => 'Historia ya Kigamboni FDC',                    'en' => 'History of Kigamboni FDC',                     'route' => 'frontend.historia',        'icon' => 'fa-landmark',      'type' => 'page'],
            ['sw' => 'Dira na Dhamira',                              'en' => 'Vision & Mission',                             'route' => 'frontend.dira',            'icon' => 'fa-eye',           'type' => 'page'],
            ['sw' => 'Lengo, Madhumuni na Wajibu',                   'en' => 'Goals, Objectives & Duties',                   'route' => 'frontend.lengo',           'icon' => 'fa-bullseye',      'type' => 'page'],
            ['sw' => 'Utawala',                                      'en' => 'Governance',                                   'route' => 'frontend.utawala',         'icon' => 'fa-university',    'type' => 'page'],
            ['sw' => 'Wafanyakazi',                                  'en' => 'Staff',                                        'route' => 'frontend.wafanyakazi',     'icon' => 'fa-users',         'type' => 'page'],
            ['sw' => 'Wahitimu',                                     'en' => 'Alumni',                                       'route' => 'frontend.wahitimu',        'icon' => 'fa-graduation-cap','type' => 'page'],
            ['sw' => 'Sifa za Muombaji',                             'en' => 'Applicant Qualifications',                     'route' => 'frontend.sifa',            'icon' => 'fa-check-circle',  'type' => 'page'],
            ['sw' => 'Mahitaji ya Kujiunga',                         'en' => 'Admission Requirements',                       'route' => 'frontend.mahitaji',        'icon' => 'fa-list-alt',      'type' => 'page'],
            ['sw' => 'Hatua za Kujiunga',                            'en' => 'Steps to Join',                                'route' => 'frontend.hatua',           'icon' => 'fa-shoe-prints',   'type' => 'page'],
            ['sw' => 'Malazi',                                       'en' => 'Accommodation',                                'route' => 'frontend.malazi',          'icon' => 'fa-bed',           'type' => 'page'],
            ['sw' => 'Michezo na Burudani',                          'en' => 'Sports & Recreation',                          'route' => 'frontend.michezo',         'icon' => 'fa-futbol',        'type' => 'page'],
            ['sw' => 'Ratiba ya Chuo',                               'en' => 'College Timetable',                            'route' => 'frontend.ratiba',          'icon' => 'fa-calendar-alt',  'type' => 'page'],
            ['sw' => 'Wasiliana Nasi',                               'en' => 'Contact Us',                                   'route' => 'frontend.wasiliana',       'icon' => 'fa-envelope',      'type' => 'page'],
            ['sw' => 'Habari na Picha',                              'en' => 'News & Gallery',                               'route' => 'frontend.habari',          'icon' => 'fa-images',        'type' => 'page'],
            ['sw' => 'Omba Kujiunga',                                'en' => 'Apply Now',                                    'route' => 'apply.start',              'icon' => 'fa-file-alt',      'type' => 'page'],
        ];

        $results = [];

        if ($query !== '') {
            $lower = mb_strtolower($query);
            foreach ($index as $item) {
                if (
                    str_contains(mb_strtolower($item['sw']), $lower) ||
                    str_contains(mb_strtolower($item['en']), $lower)
                ) {
                    $results[] = $item;
                }
            }
        }

        return view('frontend.search_results', compact('query', 'results'));
    }

    public function historia()
    {
        return view('frontend.historia');
    }

    public function diraNaDhima()
    {
        return view('frontend.dira_na_dhima');
    }

    public function lengo()
    {
        return view('frontend.lengo_madhumuni_na_wajibu');
    }

    public function utawala()
    {
        return view('frontend.utawala');
    }

    public function wafanyakazi()
    {
        return view('frontend.wafanyakazi');
    }

    public function wahitimu()
    {
        return view('frontend.wahitimu');
    }

    // =============================================
    // KOZI (COURSES)
    // =============================================

    public function koziMudaMrefu()
    {
        return view('frontend.kozi_za_muda_mrefu');
    }

    public function koziMudaMfupi()
    {
        return view('frontend.kozi_za_muda_mfupi');
    }

    // =============================================
    // IDARA (DEPARTMENTS)
    // =============================================

    public function ufundiWaMagari()
    {
        return view('frontend.ufundi_wa_magari');
    }

    public function ushonaji()
    {
        return view('frontend.ushonaji');
    }

    public function ufundiUashi()
    {
        return view('frontend.ufundi_uashi');
    }

    public function ufundiUmemeMajumbani()
    {
        return view('frontend.ufundi_umeme_wa_majumbani');
    }

    public function ufundiUmemeMagari()
    {
        return view('frontend.ufundi_umeme_wa_magari');
    }

    public function uchomeleaji()
    {
        return view('frontend.uchomeleaji_na_uungaji_vyuma');
    }

    public function ufundiBomba()
    {
        return view('frontend.ufundi_bomba');
    }

    public function tehama()
    {
        return view('frontend.tehama');
    }

    public function hudumaZaMechanic()
    {
        return view('frontend.huduma_za_mechanic');
    }

    // =============================================
    // MAISHA CHUONI (CAMPUS LIFE)
    // =============================================

    public function malazi()
    {
        return view('frontend.malazi');
    }

    public function michezo()
    {
        return view('frontend.michezo_na_burudani');
    }

    public function uongoziWaWanafunzi()
    {
        return view('frontend.uongozi_wa_wanafunzi');
    }

    public function sheriaNdogo()
    {
        return view('frontend.sheria_ndogo_za_wanafunzi');
    }

    public function ratibaYaChuo()
    {
        return view('frontend.ratiba_ya_chuo');
    }

    // =============================================
    // KUJIUNGA (ADMISSIONS)
    // =============================================

    public function sifaZaMuombaji()
    {
        return view('frontend.sifa_za_muombaji');
    }

    public function mahitajiYaKujiunga()
    {
        return view('frontend.mahitaji_ya_kujiunga');
    }

    public function hatuzaKujiunga()
    {
        return view('frontend.hatua_za_kujiunga');
    }

    // =============================================
    // HABARI (NEWS / GALLERY)
    // =============================================

    public function habariPicha()
    {
        return view('frontend.habari_picha');
    }

    // =============================================
    // WASILIANA (CONTACT)
    // =============================================

    public function wasilianaNasi()
    {
        return view('frontend.wasiliana_nasi');
    }

    // =============================================
    // SERA NA MASHARTI (POLICIES)
    // =============================================

    public function seraYaFaragha()
    {
        return view('frontend.sera_ya_faragha');
    }

    public function seraYaVidakuzi()
    {
        return view('frontend.sera_ya_vidakuzi');
    }

    public function mashartiyaMatumizi()
    {
        return view('frontend.masharti_ya_matumizi');
    }
}
