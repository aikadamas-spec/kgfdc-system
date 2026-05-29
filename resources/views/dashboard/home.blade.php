@extends('layouts.master')
@section('content')
<div class="page-wrapper">
    <div class="content container-fluid">

        {{-- Page Header --}}
        <div class="page-header">
            <div class="row">
                <div class="col-sm-12">
                    <div class="page-sub-header">
                        <h3 class="page-title">Welcome, {{ Session::get('name') }}!</h3>
                        <ul class="breadcrumb">
                            <li class="breadcrumb-item"><a href="{{ route('home') }}">Home</a></li>
                            <li class="breadcrumb-item active">{{ isset($isAccountant) && $isAccountant ? 'Accountant Dashboard' : 'Admin Dashboard' }}</li>
                        </ul>
                    </div>
                </div>
            </div>
        </div>

        {{-- Top Row: Summary Cards --}}
        <div class="row">
            @if(!isset($isAccountant) || !$isAccountant)
            {{-- Admin-only: teaching stats --}}
            <div class="col-xl col-sm-6 col-12 d-flex">
                <div class="card bg-comman w-100">
                    <div class="card-body">
                        <div class="db-widgets d-flex justify-content-between align-items-center">
                            <div class="db-info">
                                <h6>Total Students</h6>
                                <h3>{{ $totalStudents ?? '—' }}</h3>
                            </div>
                            <div class="db-icon">
                                <img src="{{ URL::to('assets/img/icons/dash-icon-01.svg') }}" alt="Students">
                            </div>
                        </div>
                    </div>
                </div>
            </div>
            <div class="col-xl col-sm-6 col-12 d-flex">
                <div class="card bg-comman w-100">
                    <div class="card-body">
                        <div class="db-widgets d-flex justify-content-between align-items-center">
                            <div class="db-info">
                                <h6>Total Teachers</h6>
                                <h3>{{ $totalTeachers ?? '—' }}</h3>
                            </div>
                            <div class="db-icon">
                                <img src="{{ URL::to('assets/img/icons/teacher-icon-01.svg') }}" alt="Teachers">
                            </div>
                        </div>
                    </div>
                </div>
            </div>
            <div class="col-xl col-sm-6 col-12 d-flex">
                <div class="card bg-comman w-100">
                    <div class="card-body">
                        <div class="db-widgets d-flex justify-content-between align-items-center">
                            <div class="db-info">
                                <h6>Total Subjects</h6>
                                <h3>{{ $totalSubjects ?? '—' }}</h3>
                            </div>
                            <div class="db-icon">
                                <img src="{{ URL::to('assets/img/icons/teacher-icon-02.svg') }}" alt="Subjects">
                            </div>
                        </div>
                    </div>
                </div>
            </div>
            <div class="col-xl col-sm-6 col-12 d-flex">
                <div class="card bg-comman w-100">
                    <div class="card-body">
                        <div class="db-widgets d-flex justify-content-between align-items-center">
                            <div class="db-info">
                                <h6>Total Departments</h6>
                                <h3>{{ $totalDepartments ?? '—' }}</h3>
                            </div>
                            <div class="db-icon">
                                <img src="{{ URL::to('assets/img/icons/dash-icon-03.svg') }}" alt="Departments">
                            </div>
                        </div>
                    </div>
                </div>
            </div>
            @else
            {{-- Accountant: financial summary cards --}}
            <div class="col-xl-4 col-sm-6 col-12 d-flex">
                <div class="card bg-comman w-100">
                    <div class="card-body">
                        <div class="db-widgets d-flex justify-content-between align-items-center">
                            <div class="db-info">
                                <h6>Total Invoices</h6>
                                <h3>{{ $totalInvoices ?? 0 }}</h3>
                            </div>
                            <div class="db-icon">
                                <div style="width:42px;height:42px;background:#e8f0fe;border-radius:50%;display:flex;align-items:center;justify-content:center;">
                                    <i class="fas fa-file-invoice" style="color:#1e3a8a;font-size:1.2rem;"></i>
                                </div>
                            </div>
                        </div>
                    </div>
                </div>
            </div>
            <div class="col-xl-4 col-sm-6 col-12 d-flex">
                <div class="card bg-comman w-100">
                    <div class="card-body">
                        <div class="db-widgets d-flex justify-content-between align-items-center">
                            <div class="db-info">
                                <h6>Total Students</h6>
                                <h3>{{ $totalStudents ?? '—' }}</h3>
                            </div>
                            <div class="db-icon">
                                <img src="{{ URL::to('assets/img/icons/dash-icon-01.svg') }}" alt="Students">
                            </div>
                        </div>
                    </div>
                </div>
            </div>
            @endif

            {{-- Total Revenue — visible to Super Admin and Accountant only --}}
            @if(isset($isSuperAdmin) && $isSuperAdmin || isset($isAccountant) && $isAccountant)
            <div class="col-xl col-sm-6 col-12 d-flex">
                <div class="card w-100" style="background: linear-gradient(135deg, #1e3a8a 0%, #2563eb 100%); border: none;">
                    <div class="card-body">
                        <div class="db-widgets d-flex justify-content-between align-items-center">
                            <div class="db-info">
                                <h6 style="color: rgba(255,255,255,0.8);">Total Revenue</h6>
                                <h3 style="color: #ffffff;">TZS {{ number_format($totalRevenue ?? 0) }}</h3>
                            </div>
                            <div class="db-icon">
                                <div style="width:42px;height:42px;background:rgba(255,255,255,0.2);border-radius:50%;display:flex;align-items:center;justify-content:center;">
                                    <i class="fas fa-money-bill-wave" style="color:#ffffff;font-size:1.2rem;"></i>
                                </div>
                            </div>
                        </div>
                    </div>
                </div>
            </div>
            @endif
        </div>

        {{-- Middle Row --}}
        <div class="row">

            @if(isset($isAccountant) && $isAccountant)
            {{-- ===== ACCOUNTANT VIEW: Recent Invoices table ===== --}}
            <div class="col-12">
                <div class="card comman-shadow">
                    <div class="card-header">
                        <div class="row align-items-center">
                            <div class="col-6">
                                <h5 class="card-title">Recent Invoices</h5>
                            </div>
                            <div class="col-6 text-end">
                                <a href="{{ route('invoice/list/page') }}" class="btn btn-sm btn-primary">View All Invoices</a>
                            </div>
                        </div>
                    </div>
                    <div class="card-body p-0">
                        <div class="table-responsive">
                            <table class="table table-hover table-center mb-0">
                                <thead class="table-light">
                                    <tr>
                                        <th>Invoice ID</th>
                                        <th>Customer</th>
                                        <th>Date</th>
                                        <th>Due Date</th>
                                        <th class="text-end">Action</th>
                                    </tr>
                                </thead>
                                <tbody>
                                    @forelse($recentInvoices ?? [] as $invoice)
                                    <tr>
                                        <td><span class="badge bg-primary">{{ $invoice->invoice_id }}</span></td>
                                        <td>{{ $invoice->customer_name }}</td>
                                        <td>{{ $invoice->date ? \Carbon\Carbon::parse($invoice->date)->format('d M Y') : '—' }}</td>
                                        <td>{{ $invoice->due_date ? \Carbon\Carbon::parse($invoice->due_date)->format('d M Y') : '—' }}</td>
                                        <td class="text-end">
                                            <a href="{{ route('invoice/view/page', $invoice->invoice_id) }}" class="btn btn-sm btn-outline-primary">
                                                <i class="fas fa-eye"></i> View
                                            </a>
                                        </td>
                                    </tr>
                                    @empty
                                    <tr>
                                        <td colspan="5" class="text-center text-muted py-4">No invoices found.</td>
                                    </tr>
                                    @endforelse
                                </tbody>
                            </table>
                        </div>
                    </div>
                </div>
            </div>

            @else
            {{-- ===== ADMIN VIEW: Teaching sections ===== --}}
            <div class="col-12 col-lg-12 col-xl-8">

                {{-- Upcoming Lessons --}}
                <div class="card flex-fill comman-shadow mb-4">
                    <div class="card-header">
                        <div class="row align-items-center">
                            <div class="col-6">
                                <h5 class="card-title">Upcoming Lessons</h5>
                            </div>
                            <div class="col-6">
                                <span class="float-end view-link"><a href="#">View All Courses</a></span>
                            </div>
                        </div>
                    </div>
                    <div class="pt-3 pb-3">
                        <div class="table-responsive lesson">
                            <table class="table table-center">
                                <tbody>
                                    <tr>
                                        <td>
                                            <div class="date">
                                                <b>Lesson 30</b>
                                                <p>3.1 Introduction to Topic</p>
                                                <ul class="teacher-date-list">
                                                    <li><i class="fas fa-calendar-alt me-2"></i>Sep 5, 2022</li>
                                                    <li>|</li>
                                                    <li><i class="fas fa-clock me-2"></i>09:00 - 10:00 am</li>
                                                </ul>
                                            </div>
                                        </td>
                                        <td>
                                            <div class="lesson-confirm"><a href="#">Confirmed</a></div>
                                            <button type="button" class="btn btn-info">Reschedule</button>
                                        </td>
                                    </tr>
                                    <tr>
                                        <td>
                                            <div class="date">
                                                <b>Lesson 31</b>
                                                <p>3.2 Advanced Concepts</p>
                                                <ul class="teacher-date-list">
                                                    <li><i class="fas fa-calendar-alt me-2"></i>Sep 6, 2022</li>
                                                    <li>|</li>
                                                    <li><i class="fas fa-clock me-2"></i>10:00 - 11:00 am</li>
                                                </ul>
                                            </div>
                                        </td>
                                        <td>
                                            <div class="lesson-confirm"><a href="#">Confirmed</a></div>
                                            <button type="button" class="btn btn-info">Reschedule</button>
                                        </td>
                                    </tr>
                                </tbody>
                            </table>
                        </div>
                    </div>
                </div>

                {{-- Teaching Activity Chart --}}
                <div class="card flex-fill comman-shadow">
                    <div class="card-header">
                        <div class="row align-items-center">
                            <div class="col-6">
                                <h5 class="card-title">Teaching Activity</h5>
                            </div>
                            <div class="col-6">
                                <ul class="chart-list-out">
                                    <li><span class="circle-blue"></span>Teachers</li>
                                    <li><span class="circle-green"></span>Students</li>
                                    <li class="star-menus">
                                        <a href="javascript:;"><i class="fas fa-ellipsis-v"></i></a>
                                    </li>
                                </ul>
                            </div>
                        </div>
                    </div>
                    <div class="card-body">
                        <div id="school-area"></div>
                    </div>
                </div>

            </div>

            {{-- Right: Calendar + Upcoming Events --}}
            <div class="col-12 col-lg-12 col-xl-4 d-flex">
                <div class="card flex-fill comman-shadow">
                    <div class="card-body">
                        <div id="calendar-doctor" class="calendar-container"></div>
                        <div class="calendar-info calendar-info1">
                            <div class="up-come-header">
                                <h2>Upcoming Events</h2>
                                <span><a href="javascript:;"><i class="feather-plus"></i></a></span>
                            </div>

                            @php
                                $nextMonday    = \Carbon\Carbon::now()->next('Monday');
                                $nextWednesday = \Carbon\Carbon::now()->next('Wednesday');
                                $nextFriday    = \Carbon\Carbon::now()->next('Friday');
                                $nextSaturday  = \Carbon\Carbon::now()->next('Saturday');
                            @endphp

                            {{-- Event 1: Semester Examination --}}
                            <div class="upcome-event-date">
                                <h3>{{ $nextMonday->format('d M') }}</h3>
                                <span><i class="fas fa-ellipsis-h"></i></span>
                            </div>
                            <div class="calendar-details">
                                <p>09:00 AM</p>
                                <div class="calendar-box normal-bg">
                                    <div class="calandar-event-name">
                                        <h4>Semester Examination</h4>
                                        <h5>All students must attend</h5>
                                    </div>
                                    <span>09:00 - 12:00 PM</span>
                                </div>
                            </div>

                            {{-- Event 2: Practical Workshop Assessment --}}
                            <div class="upcome-event-date">
                                <h3>{{ $nextWednesday->format('d M') }}</h3>
                                <span><i class="fas fa-ellipsis-h"></i></span>
                            </div>
                            <div class="calendar-details">
                                <p>10:30 AM</p>
                                <div class="calendar-box normal-bg">
                                    <div class="calandar-event-name">
                                        <h4>Practical Workshop Assessment</h4>
                                        <h5>Bring all required materials</h5>
                                    </div>
                                    <span>10:30 AM - 01:00 PM</span>
                                </div>
                            </div>

                            {{-- Event 3: Staff Meeting --}}
                            <div class="upcome-event-date">
                                <h3>{{ $nextFriday->format('d M') }}</h3>
                                <span><i class="fas fa-ellipsis-h"></i></span>
                            </div>
                            <div class="calendar-details">
                                <p>02:00 PM</p>
                                <div class="calendar-box break-bg">
                                    <div class="calandar-event-name">
                                        <h4>Staff Meeting: Term Review</h4>
                                        <h5>All teaching staff required</h5>
                                    </div>
                                    <span>02:00 - 04:00 PM</span>
                                </div>
                            </div>

                            {{-- Event 4: Community Outreach --}}
                            <div class="upcome-event-date">
                                <h3>{{ $nextSaturday->format('d M') }}</h3>
                                <span><i class="fas fa-ellipsis-h"></i></span>
                            </div>
                            <div class="calendar-details">
                                <p>08:00 AM</p>
                                <div class="calendar-box normal-bg">
                                    <div class="calandar-event-name">
                                        <h4>Community Outreach Program</h4>
                                        <h5>Kigamboni Community Centre</h5>
                                    </div>
                                    <span>08:00 AM - 12:00 PM</span>
                                </div>
                            </div>

                        </div>
                    </div>
                </div>
            </div>
            @endif

        </div>
    </div>
</div>

{{-- ═══════════════════════════════════════════════════════════════════════
     VISITOR INSIGHTS MAP — Admin & Super Admin only
     Shows a Leaflet.js map with one pin per city, sized by visitor count.
     ═══════════════════════════════════════════════════════════════════════ --}}
@if(!isset($isAccountant) || !$isAccountant)
<div class="page-wrapper" style="padding-top:0;">
    <div class="content container-fluid">

        {{-- Section header --}}
        <div class="page-header">
            <div class="row align-items-center">
                <div class="col">
                    <h3 class="page-title">
                        <i class="fas fa-map-marked-alt me-2" style="color:#1e3a8a;"></i>
                        Visitor Insights Map
                    </h3>
                    <ul class="breadcrumb">
                        <li class="breadcrumb-item"><a href="{{ route('home') }}">Home</a></li>
                        <li class="breadcrumb-item active">Visitor Locations</li>
                    </ul>
                </div>
            </div>
        </div>

        <div class="row">

            {{-- ── Map card ─────────────────────────────────────────────── --}}
            <div class="col-12 col-xl-8 d-flex">
                <div class="card comman-shadow flex-fill">
                    <div class="card-header d-flex align-items-center justify-content-between">
                        <h5 class="card-title mb-0">
                            <i class="fas fa-globe-africa me-2 text-primary"></i>
                            Website Visitors by Location
                        </h5>
                        <span class="badge bg-primary" id="map-pin-count">Loading…</span>
                    </div>
                    <div class="card-body p-2">
                        <div id="visitor-map"
                             style="height:420px !important; width:100% !important; display:block !important; position:relative !important; z-index:1 !important; border-radius:10px; border:1px solid #cbd5e1;">
                        </div>
                    </div>
                </div>
            </div>

            {{-- ── Top cities table ─────────────────────────────────────── --}}
            <div class="col-12 col-xl-4 d-flex">
                <div class="card comman-shadow flex-fill">
                    <div class="card-header">
                        <h5 class="card-title mb-0">
                            <i class="fas fa-chart-bar me-2 text-primary"></i>
                            Top Visitor Cities
                        </h5>
                    </div>
                    <div class="card-body p-0">
                        <div class="table-responsive">
                            <table class="table table-hover table-center mb-0" id="visitor-city-table">
                                <thead class="table-light">
                                    <tr>
                                        <th>#</th>
                                        <th>City</th>
                                        <th>Country</th>
                                        <th class="text-end">Visitors</th>
                                    </tr>
                                </thead>
                                <tbody>
                                    <tr>
                                        <td colspan="4" class="text-center text-muted py-3">
                                            <i class="fas fa-spinner fa-spin me-1"></i> Loading…
                                        </td>
                                    </tr>
                                </tbody>
                            </table>
                        </div>
                    </div>
                </div>
            </div>

        </div>{{-- /row --}}
    </div>{{-- /content --}}
</div>{{-- /page-wrapper --}}
@endif

@endsection

@if(!isset($isAccountant) || !$isAccountant)
@section('script')
{{-- ── Leaflet CSS loaded here so it is guaranteed present before init ── --}}
<link rel="stylesheet"
      href="https://unpkg.com/leaflet@1.9.4/dist/leaflet.css"
      integrity="sha256-p4NxAoJBhIIN+hmNHrzRCf9tD/miZyoHS5obTRR9BMY="
      crossorigin="anonymous">

{{-- ── Leaflet JS — must be BEFORE our init script ─────────────────────── --}}
<script src="https://unpkg.com/leaflet@1.9.4/dist/leaflet.js"
        integrity="sha256-20nQCchB9co0qIjJZRGuk2/Z9VM+kNiyxNV/XN/WLs="
        crossorigin="anonymous"></script>

<script>
// Visitor data from HomeController — native PHP echo avoids all Blade compiler conflicts
var VISITOR_MAP_DATA = <?php echo json_encode($visitorMapData ?? []); ?>;

// ── Table population — runs immediately, no Leaflet dependency ───────────────
// Separated from map init so a slow CDN never blocks the table rendering.
document.addEventListener('DOMContentLoaded', function () {
    try {
        var visitorData = Array.isArray(VISITOR_MAP_DATA) ? VISITOR_MAP_DATA : [];

        // Pin-count badge
        var badge = document.getElementById('map-pin-count');
        if (badge) {
            badge.textContent = visitorData.length + ' location' + (visitorData.length !== 1 ? 's' : '');
        }

        // Top-cities table
        var tbody = document.querySelector('#visitor-city-table tbody');
        if (tbody) {
            if (visitorData.length === 0) {
                tbody.innerHTML = '<tr><td colspan="4" class="text-center text-muted py-3">No location data yet.</td></tr>';
            } else {
                var rows = '';
                for (var i = 0; i < Math.min(visitorData.length, 15); i++) {
                    var d   = visitorData[i];
                    var sub = (d.region && d.region !== d.city)
                        ? '<br><small class="text-muted">' + d.region + '</small>'
                        : '';
                    rows += '<tr>'
                        + '<td><span class="badge bg-secondary">' + (i + 1) + '</span></td>'
                        + '<td><strong>' + d.city + '</strong>' + sub + '</td>'
                        + '<td>' + d.country + '</td>'
                        + '<td class="text-end"><span class="badge bg-primary">' + d.visitor_count + '</span></td>'
                        + '</tr>';
                }
                tbody.innerHTML = rows;
            }
        }
    } catch (tableErr) {
        console.warn('Visitor table error:', tableErr);
        var tb = document.querySelector('#visitor-city-table tbody');
        if (tb) {
            tb.innerHTML = '<tr><td colspan="4" class="text-center text-muted py-3">Could not load data.</td></tr>';
        }
    }
});

// ── Map initialisation — waits for Leaflet CDN to load ───────────────────────
function initVisitorMap() {
    try {
        var mapEl = document.getElementById('visitor-map');
        if (!mapEl) { return; }

        // Leaflet not ready yet — retry in 500ms
        if (typeof L === 'undefined') {
            setTimeout(initVisitorMap, 500);
            return;
        }

        // Already initialised — skip
        if (mapEl._leaflet_id) { return; }

        var visitorData = Array.isArray(VISITOR_MAP_DATA) ? VISITOR_MAP_DATA : [];

        var map = L.map('visitor-map', {
            center:          [-6.3690, 34.8888],
            zoom:            6,
            scrollWheelZoom: false,
            zoomControl:     true,
        });

        L.tileLayer('https://{s}.tile.openstreetmap.org/{z}/{x}/{y}.png', {
            attribution: '&copy; <a href="https://www.openstreetmap.org/copyright">OpenStreetMap</a> contributors',
            maxZoom: 18,
        }).addTo(map);

        // No data — placeholder pin at Kigamboni FDC
        if (visitorData.length === 0) {
            L.marker([-6.8677, 39.3881])
                .addTo(map)
                .bindPopup('<b>Kigamboni FDC</b><br>Visitor tracking active.<br>No location data yet.')
                .openPopup();
            map.setView([-6.8677, 39.3881], 12);
            setTimeout(function () { map.invalidateSize(); }, 300);
            return;
        }

        // Circle markers scaled by visitor count
        var maxCount = 1;
        for (var j = 0; j < visitorData.length; j++) {
            if (visitorData[j].visitor_count > maxCount) {
                maxCount = visitorData[j].visitor_count;
            }
        }

        var locale = (document.documentElement.lang === 'sw') ? 'sw' : 'en';

        for (var k = 0; k < visitorData.length; k++) {
            var d      = visitorData[k];
            var radius = 8 + Math.round((d.visitor_count / maxCount) * 22);

            var circle = L.circleMarker([d.latitude, d.longitude], {
                radius:      radius,
                fillColor:   '#1e3a8a',
                color:       '#4ba3ce',
                weight:      2,
                opacity:     1,
                fillOpacity: 0.80,
            }).addTo(map);

            var label = (locale === 'sw')
                ? '<b>Mji: ' + d.city + '</b><br>Mkoa: ' + d.region + '<br>Nchi: ' + d.country
                  + '<br><span style="color:#1e3a8a;font-weight:700;">Wageni: ' + d.visitor_count + '</span>'
                : '<b>City: ' + d.city + '</b><br>Region: ' + d.region + '<br>Country: ' + d.country
                  + '<br><span style="color:#1e3a8a;font-weight:700;">Visitors: ' + d.visitor_count + '</span>';

            circle.bindPopup(label);
            circle.on('mouseover', function () { this.openPopup(); });
        }

        // Fit bounds to all markers
        var coords = [];
        for (var m = 0; m < visitorData.length; m++) {
            coords.push([visitorData[m].latitude, visitorData[m].longitude]);
        }
        map.fitBounds(L.latLngBounds(coords).pad(0.25));

        // Force tile repaint after Bootstrap card animations settle
        setTimeout(function () { map.invalidateSize(); }, 300);
        setTimeout(function () { map.invalidateSize(); }, 800);

    } catch (mapErr) {
        console.warn('Visitor map error:', mapErr);
    }
}

// Map runs after full page load (guarantees Leaflet script is parsed)
window.addEventListener('load', initVisitorMap);
</script>
@endsection
@endif
