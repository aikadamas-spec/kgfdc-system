<?php

namespace App\Http\Controllers;

use App\Models\StudentProfile;
use App\Models\FeeStructure;
use App\Models\Application;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Http; // Muhimu kwa ajili ya kuongea na Beem

class StudentDashboardController extends Controller
{
    // 1. Inaonyesha Dashboard ya Mwanafunzi
    public function index()
    {
        $user = auth()->user();
        $profile = StudentProfile::where('user_id', $user->id)->first();

        // Kama hana profile, mpeleke akajaze fomu kwanza
        if (!$profile) {
            return redirect()->route('profile.create');
        }
        
        // Piga hesabu ya Ada (Default ni 520,400 kama kozi haina bei maalum)
        $structure = FeeStructure::where('course_name', $profile->course_applied)->first();
        $fee = $structure ? $structure->total_amount : 520400;

        // Jumla ya alicholipa (Tunaondoa @fdc.go.tz kupata namba ya simu)
        $phoneNumber = str_replace('@fdc.go.tz', '', $user->email);
        $paid = Application::where('phone_number', $phoneNumber)
                            ->where('payment_status', 'paid')
                            ->sum('amount');

        $balance = $fee - $paid;

        return view('dashboard', compact('profile', 'fee', 'paid', 'balance'));
    }

    // 2. Inashughulikia Malipo ya Ada kwenda Beem
    public function processFeePayment(Request $request)
    {
        // Hakikisha kiasi kimeingizwa na ni namba
        $request->validate([
            'amount' => 'required|numeric|min:100',
        ]);

        $user = auth()->user();
        $amount = $request->amount;
        $phoneNumber = str_replace('@fdc.go.tz', '', $user->email);

        // A. Rekodi malipo kama "pending" kwenye database yetu
        $application = Application::create([
            'applicant_name' => $user->name,
            'phone_number' => $phoneNumber,
            'amount' => $amount,
            'payment_status' => 'pending',
            'beem_reference' => 'FEE-' . time(), // Namba ya utambulisho wa malipo
        ]);

        // B. Tuma ombi la malipo (BPay Push) kwenda Beem Africa
        $apiKey = env('BEEM_API_KEY');
        $secretKey = env('BEEM_SECRET_KEY');

        $response = Http::withHeaders([
            'Authorization' => 'Basic ' . base64_encode("$apiKey:$secretKey"),
            'Content-Type' => 'application/json',
        ])->post('https://beem.africa', [
            'amount' => (int)$amount,
            'transaction_id' => $application->beem_reference,
            'reference_id' => 'FDC-' . $application->id,
            'mobile_number' => $phoneNumber,
            'callback_url' => route('beem.callback'),
        ]);

        // C. Rudisha ujumbe kwa mwanafunzi
        if ($response->successful()) {
            return back()->with('success', 'Ombi la malipo limetumwa. Tafadhali weka PIN kwenye simu yako.');
        }

        return back()->with('error', 'Imeshindikana kuunganishwa na Beem. Jaribu tena baadae.');
    }
}
