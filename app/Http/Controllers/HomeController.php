<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use Illuminate\Support\Facades\Session;
use Illuminate\Support\Facades\Auth;
use Illuminate\Support\Facades\DB;
use Illuminate\Support\Facades\Schema;
use App\Models\Student;
use App\Models\Teacher;
use App\Models\Department;
use App\Models\Subject;
use App\Models\InvoiceCustomerName;
use App\Models\InvoiceTotalAmount;

class HomeController extends Controller
{
    public function __construct()
    {
        $this->middleware('auth');
    }

    public function index()
    {
        $roleName = Session::get('role_name') ?? (Auth::check() ? Auth::user()->role_name : '');
        $role = strtolower(trim($roleName));

        $stats = [
            'totalStudents'    => Student::count(),
            'totalTeachers'    => Teacher::count(),
            'totalDepartments' => Department::count(),
            'totalSubjects'    => Subject::count(),
        ];

        // 1. Coordinator
        if ($role === 'coordinator') {
            return view('dashboard.coordinator_dashboard', $stats);
        }

        // 2. Teacher
        if ($role === 'teacher') {
            return view('dashboard.teacher_dashboard');
        }

        // 3. Student
        if ($role === 'student') {
            return view('dashboard.student_dashboard');
        }

        // 4. Accountant — financial dashboard with invoice data
        if ($role === 'accountant') {
            $totalInvoices    = InvoiceCustomerName::count();
            $totalRevenue     = InvoiceTotalAmount::sum('total_amount');
            $recentInvoices   = InvoiceCustomerName::latest()->take(10)->get();
            return view('dashboard.home', array_merge($stats, [
                'totalRevenue'   => $totalRevenue,
                'totalInvoices'  => $totalInvoices,
                'recentInvoices' => $recentInvoices,
                'isAccountant'   => true,
                'isSuperAdmin'   => false,
                'visitorMapData' => [],
            ]));
        }

        // 5. Admin / Super Admin — include visitor map data
        $visitorMapData = $this->getVisitorMapData();

        return view('dashboard.home', array_merge($stats, [
            'isAccountant'   => false,
            'isSuperAdmin'   => ($role === 'super admin'),
            'visitorMapData' => $visitorMapData,
        ]));
    }

    /**
     * Build a JSON array of grouped visitor locations for the map.
     * Groups by city so each pin shows "City — N visitors".
     * Only includes rows where lat/lng are present.
     *
     * @return array  Plain PHP array — the view encodes it with @json()
     */
    private function getVisitorMapData(): array
    {
        if (! Schema::hasTable('visitor_logs')) {
            return [];
        }

        try {
            return DB::table('visitor_logs')
                ->select(
                    'country',
                    'region',
                    'city',
                    DB::raw('AVG(latitude)  AS latitude'),
                    DB::raw('AVG(longitude) AS longitude'),
                    DB::raw('COUNT(*)       AS visitor_count')
                )
                ->whereNotNull('latitude')
                ->whereNotNull('longitude')
                ->groupBy('country', 'region', 'city')
                ->orderByDesc('visitor_count')
                ->get()
                ->map(fn ($row) => [
                    'country'       => $row->country       ?? 'Unknown',
                    'region'        => $row->region        ?? 'Unknown',
                    'city'          => $row->city          ?? 'Unknown',
                    'latitude'      => (float) $row->latitude,
                    'longitude'     => (float) $row->longitude,
                    'visitor_count' => (int)   $row->visitor_count,
                ])
                ->values()
                ->toArray();

        } catch (\Throwable $e) {
            return [];
        }
    }

    public function userProfile()
    {
        return view('dashboard.profile');
    }

    /**
     * DEV ONLY — Seed 4 real Tanzanian visitor locations into visitor_logs
     * so the admin map can be tested without needing live public traffic.
     *
     * Route: GET /activate-admin-map  (auth protected)
     * Remove this method and its route once live traffic is flowing.
     */
    public function simulateTraffic()
    {
        $now = now();

        $locations = [
            [
                'session_id'    => 'sim-dares-' . uniqid(),
                'ip_address'    => '41.75.192.1',
                'url_visited'   => url('/'),
                'country'       => 'Tanzania',
                'region'        => 'Dar es Salaam',
                'city'          => 'Dar es Salaam',
                'latitude'      => -6.7924,
                'longitude'     => 39.2083,
                'last_activity' => $now,
                'created_at'    => $now,
                'updated_at'    => $now,
            ],
            [
                'session_id'    => 'sim-mwanza-' . uniqid(),
                'ip_address'    => '41.75.193.1',
                'url_visited'   => url('/'),
                'country'       => 'Tanzania',
                'region'        => 'Mwanza',
                'city'          => 'Mwanza',
                'latitude'      => -2.5164,
                'longitude'     => 32.9016,
                'last_activity' => $now,
                'created_at'    => $now,
                'updated_at'    => $now,
            ],
            [
                'session_id'    => 'sim-arusha-' . uniqid(),
                'ip_address'    => '41.75.194.1',
                'url_visited'   => url('/'),
                'country'       => 'Tanzania',
                'region'        => 'Arusha',
                'city'          => 'Arusha',
                'latitude'      => -3.3731,
                'longitude'     => 36.6853,
                'last_activity' => $now,
                'created_at'    => $now,
                'updated_at'    => $now,
            ],
            [
                'session_id'    => 'sim-dodoma-' . uniqid(),
                'ip_address'    => '41.75.195.1',
                'url_visited'   => url('/'),
                'country'       => 'Tanzania',
                'region'        => 'Dodoma',
                'city'          => 'Dodoma',
                'latitude'      => -6.1722,
                'longitude'     => 35.7395,
                'last_activity' => $now,
                'created_at'    => $now,
                'updated_at'    => $now,
            ],
        ];

        foreach ($locations as $row) {
            // Use insert() directly — these are synthetic sessions with unique IDs
            // so there is no risk of colliding with the unique session_id constraint.
            DB::table('visitor_logs')->insert($row);
        }

        return redirect()
            ->route('home')
            ->with('success', '✅ Test map data injected: Dar es Salaam, Mwanza, Arusha, Dodoma. Refresh the dashboard to see the pins.');
    }

    public function teacherDashboardIndex()
    {
        return view('dashboard.teacher_dashboard');
    }

    public function studentDashboardIndex()
    {
        return view('dashboard.student_dashboard');
    }
}
