{{-- ═══════════════════════════════════════════════════════════════════
     Sidebar — 8 Core Subsystems (clean English titles)
     1  Dashboard
     2  Student Management
     3  Staff Management
     4  Financials
     5  Lesson Tracking
     6  Attendance
     7  Exam Reports
     8  SMS & Alerts
     ─────────────────────────────────────────────────────────────────
     Admin-only (below the 8):  User Management · Settings
     ═══════════════════════════════════════════════════════════════════ --}}
<style>
    /* ── Extra breathing room so text & arrow don't crowd the right edge ── */
    #sidebar-menu ul li a {
        padding-right: 20px;
    }
    #sidebar-menu ul li a .menu-arrow {
        right: 14px;
    }
    /* Submenu child links inherit the same right padding */
    #sidebar-menu ul ul li a {
        padding-right: 20px;
    }
</style>

<div class="sidebar" id="sidebar">
    <div class="sidebar-inner slimscroll">
        <div id="sidebar-menu" class="sidebar-menu">
            <ul>
                <li class="menu-title">
                    <span>Main Menu</span>
                </li>

                @php
                    $userRoleName   = Session::get('role_name', '');
                    $normalizedRole = strtolower(trim($userRoleName));
                    $isSuperAdmin   = ($normalizedRole === 'super admin');
                    $isAdmin        = ($normalizedRole === 'admin');
                    $isCoordinator  = ($normalizedRole === 'coordinator');
                    $isTeacher      = ($normalizedRole === 'teacher');
                    $isStudent      = ($normalizedRole === 'student');
                    $isAccountant   = ($normalizedRole === 'accountant');

                    // ── Visibility rules per role ──────────────────────────────
                    $superAdminOnlyMenus = ['User Management', 'Settings'];

                    $adminOnlyMenus = [
                        'User Management', 'Settings',
                        'Financials', 'Invoices', 'Accounts',
                    ];

                    $accountantMenus = ['Dashboard', 'Financials'];

                    // ── Items that always show a dropdown arrow regardless of
                    //    whether they currently have DB children (placeholders) ──
                    $alwaysArrow = [
                        'Student Management',
                        'Staff Management',
                        'Financials',
                        'Lesson Tracking',
                        'Attendance',
                        'Exam Reports',
                        'SMS & Alerts',
                    ];
                @endphp

                @foreach ($menus as $menu)
                    @php
                        $isDashboard = ($menu->title === 'Dashboard');

                        if ($isSuperAdmin) {
                            $shouldShow = true;
                        } elseif ($isAdmin) {
                            $shouldShow = !in_array($menu->title, $superAdminOnlyMenus);
                        } elseif ($isCoordinator) {
                            $shouldShow = !in_array($menu->title, $adminOnlyMenus);
                        } elseif ($isAccountant) {
                            $shouldShow = in_array($menu->title, $accountantMenus);
                        } elseif ($isTeacher || $isStudent) {
                            $shouldShow = $isDashboard;
                        } else {
                            $shouldShow = !in_array($menu->title, $adminOnlyMenus);
                        }

                        // Show arrow when: item has DB children OR it's a known
                        // subsystem that will always have (or gain) children.
                        $hasChildren  = $menu->children->count() && !$isDashboard;
                        $showArrow    = $hasChildren || in_array($menu->title, $alwaysArrow);
                        $showChildren = $hasChildren;

                        $menuHref = $isDashboard
                            ? route('home')
                            : ($menu->route ? route($menu->route) : '#');
                    @endphp

                    @if($shouldShow)
                        <li class="{{ $isDashboard ? '' : ($showChildren ? 'submenu' : '') }} {{ set_active($menu->active_routes) }} {{ (isset($menu->pattern) && request()->is($menu->pattern)) ? 'active' : '' }}">
                            <a href="{{ $menuHref }}">
                                <i class="{{ $menu->icon }}"></i>
                                <span>{{ $menu->title }}</span>
                                @if ($showArrow)
                                    <span class="menu-arrow"></span>
                                @endif
                            </a>
                            @if ($showChildren)
                                <ul>
                                    @foreach ($menu->children as $child)
                                        @if($child->is_active)
                                            <li>
                                                <a href="{{ ($child->route && $child->route !== '#') ? route($child->route) : '#' }}"
                                                   class="{{ set_active($child->active_routes) }} {{ (isset($child->pattern) && request()->is($child->pattern)) ? 'active' : '' }}">
                                                    {{ $child->title }}
                                                </a>
                                            </li>
                                        @endif
                                    @endforeach
                                </ul>
                            @endif
                        </li>
                    @endif
                @endforeach

            </ul>
        </div>
    </div>
</div>
