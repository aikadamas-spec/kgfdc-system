<div class="sidebar" id="sidebar">
    <div class="sidebar-inner slimscroll">
        <div id="sidebar-menu" class="sidebar-menu">
            <ul>
                <li class="menu-title">
                    <span>Main Menu</span>
                </li>

                @php
                    $userRoleName = Session::get('role_name', '');
                    $normalizedRole = strtolower(trim($userRoleName));
                    $isSuperAdmin  = ($normalizedRole === 'super admin');
                    $isAdmin       = ($normalizedRole === 'admin');
                    $isCoordinator = ($normalizedRole === 'coordinator');
                    $isTeacher     = ($normalizedRole === 'teacher');
                    $isStudent     = ($normalizedRole === 'student');
                    $isAccountant  = ($normalizedRole === 'accountant');

                    // Menus restricted to Super Admin only
                    $superAdminOnlyMenus = ['User Management', 'Settings'];

                    // Menus hidden from Coordinator, Teacher, Student, Accountant
                    $adminOnlyMenus = ['User Management', 'Settings', 'Invoices', 'Accounts', 'Departments'];

                    // Menus Accountant can see
                    $accountantMenus = ['Dashboard', 'Invoices', 'Accounts'];
                @endphp

                @foreach ($menus as $menu)
                    @php
                        $isDashboard = ($menu->title === 'Dashboard');

                        if ($isSuperAdmin) {
                            // Super Admin sees everything
                            $shouldShow = true;
                        } elseif ($isAdmin) {
                            // Admin sees everything EXCEPT User Management and Settings
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

                        $showChildren = $menu->children->count() && !$isDashboard;
                        $menuHref = $isDashboard ? route('home') : ($menu->route ? route($menu->route) : '#');
                    @endphp

                    @if($shouldShow)
                        {{-- Use 'submenu' only when the item has children; leaf items get no extra class --}}
                        <li class="{{ $isDashboard ? '' : ($showChildren ? 'submenu' : '') }} {{ set_active($menu->active_routes) }}
                            {{ (isset($menu->pattern) && request()->is($menu->pattern)) ? 'active' : '' }}">
                            <a href="{{ $menuHref }}">
                                <i class="{{ $menu->icon }}"></i>
                                <span>{{ $menu->title }}</span>
                                @if ($showChildren)
                                    <span class="menu-arrow"></span>
                                @endif
                            </a>
                            @if ($showChildren)
                                <ul>
                                    @foreach ($menu->children as $child)
                                        <li>
                                            <a href="{{ $child->route ? route($child->route) : '#' }}"
                                               class="{{ set_active($child->active_routes) }}
                                                      {{ (isset($child->pattern) && request()->is($child->pattern)) ? 'active' : '' }}">
                                                {{ $child->title }}
                                            </a>
                                        </li>
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
