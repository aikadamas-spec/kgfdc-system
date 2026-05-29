{{--
|--------------------------------------------------------------------------
| Floating Visitors Counter (single source of truth)
|--------------------------------------------------------------------------
| Included by: frontend/mwanzo.blade.php, layouts/frontend.blade.php
| Stats: AppServiceProvider (frontend scope, 60s cache) — onlineCount, yesterdayCount,
|        weeklyCount, yearlyCount, totalCount
--}}
@php
    $vcOnline    = (int) ($onlineCount ?? 0);
    $vcYesterday = (int) ($yesterdayCount ?? 0);
    $vcWeekly    = (int) ($weeklyCount ?? 0);
    $vcYearly    = (int) ($yearlyCount ?? 0);
    $vcTotal     = (int) ($totalCount ?? 0);
    $vcIsSw      = app()->getLocale() === 'sw';
@endphp
<div style="position: fixed !important; left: 25px !important; top: 50% !important; transform: translateY(-50%) !important; z-index: 9999999 !important; display: flex !important; visibility: visible !important; opacity: 1 !important;">
    <div style="background-color: #4ba3ce !important; border: 2px solid #0f2c59 !important; border-radius: 12px !important; padding: 12px 16px; width: 250px !important; display: flex; flex-direction: column; gap: 8px; box-shadow: 0 6px 20px rgba(0,0,0,0.4);">

        <div style="font-size:15px; font-weight:700; color:#ffd700; text-align:center; text-transform:uppercase; letter-spacing:0.5px; font-family:Arial,sans-serif;">{{ $vcIsSw ? 'IDADI YA WAGENI' : 'VISITORS COUNTER' }}</div>
        <div style="border-top: 1px solid rgba(255,255,255,0.25);"></div>

        <div style="display:flex !important; align-items:center !important; justify-content:space-between !important; width:100% !important; white-space:nowrap !important;">
            <span style="display:flex; align-items:center; gap:6px; font-size:14px; color:#ffffff; font-family:Arial,sans-serif;"><i class="fas fa-sun" style="font-size:12px;"></i> {{ $vcIsSw ? 'Waliopo Sasa' : 'Online Now' }}</span>
            <span style="font-size:18px; font-weight:900; color:#ffffff; font-family:Arial,sans-serif;">{{ number_format($vcOnline) }}</span>
        </div>
        <div style="border-top: 1px solid rgba(255,255,255,0.2);"></div>

        <div style="display:flex !important; align-items:center !important; justify-content:space-between !important; width:100% !important; white-space:nowrap !important;">
            <span style="display:flex; align-items:center; gap:6px; font-size:14px; color:#ffffff; font-family:Arial,sans-serif;"><i class="fas fa-history" style="font-size:12px;"></i> {{ $vcIsSw ? 'Jana' : 'Yesterday' }}</span>
            <span style="font-size:18px; font-weight:900; color:#ffffff; font-family:Arial,sans-serif;">{{ number_format($vcYesterday) }}</span>
        </div>
        <div style="border-top: 1px solid rgba(255,255,255,0.2);"></div>

        <div style="display:flex !important; align-items:center !important; justify-content:space-between !important; width:100% !important; white-space:nowrap !important;">
            <span style="display:flex; align-items:center; gap:6px; font-size:14px; color:#ffffff; font-family:Arial,sans-serif;"><i class="fas fa-calendar-week" style="font-size:12px;"></i> {{ $vcIsSw ? 'Wiki Hii' : 'Weekly' }}</span>
            <span style="font-size:18px; font-weight:900; color:#ffffff; font-family:Arial,sans-serif;">{{ number_format($vcWeekly) }}</span>
        </div>
        <div style="border-top: 1px solid rgba(255,255,255,0.2);"></div>

        <div style="display:flex !important; align-items:center !important; justify-content:space-between !important; width:100% !important; white-space:nowrap !important;">
            <span style="display:flex; align-items:center; gap:6px; font-size:14px; color:#ffffff; font-family:Arial,sans-serif;"><i class="fas fa-chart-line" style="font-size:12px;"></i> {{ $vcIsSw ? 'Mwaka Huu' : 'Yearly' }}</span>
            <span style="font-size:18px; font-weight:900; color:#ffffff; font-family:Arial,sans-serif;">{{ number_format($vcYearly) }}</span>
        </div>
        <div style="border-top: 1px solid rgba(255,255,255,0.2);"></div>

        <div style="display:flex !important; align-items:center !important; justify-content:space-between !important; width:100% !important; white-space:nowrap !important;">
            <span style="display:flex; align-items:center; gap:6px; font-size:14px; color:#ffd700; font-family:Arial,sans-serif;"><i class="fas fa-users" style="font-size:12px;"></i> {{ $vcIsSw ? 'Jumla' : 'Total' }}</span>
            <span style="font-size:18px; font-weight:900; color:#ffd700; font-family:Arial,sans-serif;">{{ number_format($vcTotal) }}</span>
        </div>

    </div>
</div>
