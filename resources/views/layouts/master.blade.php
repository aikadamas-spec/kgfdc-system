<!DOCTYPE html>
<html lang="en">

<head>
    <meta charset="utf-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0, user-scalable=0">
    <meta http-equiv="Cache-Control" content="no-cache, no-store, must-revalidate">
    <meta http-equiv="Pragma" content="no-cache">
    <meta http-equiv="Expires" content="0">
    <title>Admin Dashboard</title>
    <link rel="icon" type="image/png" href="{{ asset('storage/' . ($siteSettings['favicon'] ?? 'settings/favicon.png')) }}?v={{ time() }}">
    <link rel="shortcut icon" href="{{ asset('storage/' . ($siteSettings['favicon'] ?? 'settings/favicon.png')) }}?v={{ time() }}">
    <link rel="stylesheet" href="{{ URL::to('assets/plugins/bootstrap/css/bootstrap.min.css') }}">
    <link rel="stylesheet" href="{{ URL::to('assets/plugins/feather/feather.css') }}">
    <link rel="stylesheet" href="{{ URL::to('assets/plugins/icons/flags/flags.css') }}">
    <link rel="stylesheet" href="{{ URL::to('assets/css/bootstrap-datetimepicker.min.cs') }}s">
    <link rel="stylesheet" href="{{ URL::to('assets/plugins/fontawesome/css/fontawesome.min.css') }}">
    <link rel="stylesheet" href="{{ URL::to('assets/plugins/fontawesome/css/all.min.css') }}">
    <link rel="stylesheet" href="{{ URL::to('assets/plugins/icons/feather/feather.css') }}">
    <link rel="stylesheet" href="{{ URL::to('assets/plugins/simple-calendar/simple-calendar.css') }}">
    <link rel="stylesheet" href="{{ URL::to('assets/plugins/datatables/datatables.min.css') }}">
    <link rel="stylesheet" href="{{ URL::to('assets/plugins/select2/css/select2.min.css') }}">
    <link rel="stylesheet" href="{{ URL::to('assets/css/style.css') }}">
    <style>
        /* Kill any stray Bootstrap modal backdrop */
        .modal-backdrop { display: none !important; }
        body { overflow: auto !important; }
        body.modal-open { overflow: auto !important; }
    </style>
</head>
<body>
    <div class="main-wrapper">
        <div class="header">
            <div class="header-left">
                <a href="{{ route('home') }}" class="logo">
                    <img src="{{ !empty($siteSettings['logo']) ? asset('storage/' . $siteSettings['logo']) : asset('assets/img/logo_kg_fdc.jpg') }}"
                         style="max-height:40px;width:auto;object-fit:contain;" alt="Logo">
                    <span style="font-weight: 900; color: #1e3a8a; font-size: 1.2rem; margin-left: 10px;">
                        {{ $siteSettings['website_name'] ?? 'Kg FDC' }}
                    </span>
                </a>
                <a href="{{ route('home') }}" class="logo logo-small">
                    <img src="{{ !empty($siteSettings['logo']) ? asset('storage/' . $siteSettings['logo']) : asset('assets/img/logo_kg_fdc.jpg') }}"
                         alt="Logo" style="max-height:30px;width:auto;object-fit:contain;">
                </a>
            </div>
            <div class="menu-toggle">
                <a href="javascript:void(0);" id="toggle_btn">
                    <i class="fas fa-bars"></i>
                </a>
            </div>

            <div class="top-nav-search">
                <form>
                    <input type="text" class="form-control" placeholder="Search here">
                    <button class="btn" type="submit"><i class="fas fa-search"></i></button>
                </form>
            </div>
            <a class="mobile_btn" id="mobile_btn">
                <i class="fas fa-bars"></i>
            </a>
            <ul class="nav user-menu">
                <li class="nav-item dropdown noti-dropdown language-drop me-2">
                    <a href="#" class="dropdown-toggle nav-link header-nav-list" data-bs-toggle="dropdown">
                        <i class="flag flag-gb" style="width:1.5rem;height:1.5rem;vertical-align:middle;"></i>
                    </a>
                    <div class="dropdown-menu ">
                        <div class="noti-content">
                            <div>
                                <a class="dropdown-item" href="javascript:;"><i class="flag flag-gb me-2"></i>English</a>
                                <a class="dropdown-item" href="javascript:;"><i class="flag flag-tz me-2"></i>Swahili</a>
                            </div>
                        </div>
                    </div>
                </li>

                <li class="nav-item dropdown noti-dropdown me-2">
                    <a href="#" class="dropdown-toggle nav-link header-nav-list" data-bs-toggle="dropdown">
                        <img src="{{ URL::to('assets/img/icons/header-icon-05.svg') }}" alt="">
                    </a>
                    <div class="dropdown-menu notifications">
                        <div class="topnav-dropdown-header">
                            <span class="notification-title">Notifications</span>
                            <a href="javascript:void(0)" class="clear-noti"> Clear All </a>
                        </div>
                        <div class="noti-content">
                            <ul class="notification-list">
                                <li class="notification-message">
                                    <a href="#">
                                        <div class="media d-flex">
                                            <span class="avatar avatar-sm flex-shrink-0">
                                                <img class="avatar-img rounded-circle" alt="User Image" src="{{ URL::to('assets/img/logo-small.png') }}">
                                            </span>
                                            <div class="media-body flex-grow-1">
                                                <p class="noti-details"><span class="noti-title">Carlson Tech</span> has
                                                    approved <span class="noti-title">your estimate</span></p>
                                                <p class="noti-time"><span class="notification-time">4 mins ago</span>
                                                </p>
                                            </div>
                                        </div>
                                    </a>
                                </li>
                                <li class="notification-message">
                                    <a href="#">
                                        <div class="media d-flex">
                                            <span class="avatar avatar-sm flex-shrink-0">
                                                <img class="avatar-img rounded-circle" alt="User Image" src="{{ URL::to('assets/img/logo-small.png') }}">
                                            </span>
                                            <div class="media-body flex-grow-1">
                                                <p class="noti-details">
                                                    <span class="noti-title">International Software Inc</span> has sent you a invoice in the amount of
                                                    <span class="noti-title">TZS 218</span>
                                                </p>
                                                <p class="noti-time">
                                                    <span class="notification-time">6 mins ago</span>
                                                </p>
                                            </div>
                                        </div>
                                    </a>
                                </li>
                                <li class="notification-message">
                                    <a href="#">
                                        <div class="media d-flex">
                                            <span class="avatar avatar-sm flex-shrink-0">
                                                <img class="avatar-img rounded-circle" alt="User Image" src="{{ URL::to('assets/img/logo-small.png') }}">
                                            </span>
                                            <div class="media-body flex-grow-1">
                                                <p class="noti-details"><span class="noti-title">John Hendry</span> sent a cancellation request <span class="noti-title">Apple iPhone XR</span></p>
                                                <p class="noti-time"><span class="notification-time">8 mins ago</span>
                                                </p>
                                            </div>
                                        </div>
                                    </a>
                                </li>
                                <li class="notification-message">
                                    <a href="#">
                                        <div class="media d-flex">
                                            <span class="avatar avatar-sm flex-shrink-0">
                                                <img class="avatar-img rounded-circle" alt="" src="{{ URL::to('assets/img/logo-small.png') }}">
                                            </span>
                                            <div class="media-body flex-grow-1">
                                                <p class="noti-details"><span class="noti-title">Mercury Software Inc</span> added a new product <span class="noti-title">Apple MacBook Pro</span></p>
                                                <p class="noti-time"><span class="notification-time">12 mins ago</span>
                                                </p>
                                            </div>
                                        </div>
                                    </a>
                                </li>
                            </ul>
                        </div>
                        <div class="topnav-dropdown-footer">
                            <a href="#">View all Notifications</a>
                        </div>
                    </div>
                </li>

                <li class="nav-item zoom-screen me-2">
                    <a href="#" class="nav-link header-nav-list win-maximize">
                        <img src="{{ URL::to('assets/img/icons/header-icon-04.svg') }}" alt="">
                    </a>
                </li>

                <li class="nav-item dropdown has-arrow new-user-menus">
                    <a href="#" class="dropdown-toggle nav-link" data-bs-toggle="dropdown">
                        <span class="user-img">
                            <img class="rounded-circle" width="31" height="31" alt=""
                                 style="object-fit:cover;"
                                 src="{{ Session::get('avatar') ? asset('images/' . Session::get('avatar')) : asset('assets/img/user.png') }}"
                                 onerror="this.onerror=null;this.src='{{ asset('assets/img/user.png') }}'">
                            <div class="user-text">
                                <h6>{{ Session::get('name') }}</h6>
                                <p class="text-muted mb-0">{{ Session::get('role_name') }}</p>
                            </div>
                        </span>
                    </a>
                    <div class="dropdown-menu">
                        <div class="user-header">
                            <div class="avatar avatar-sm">
                                <img class="avatar-img rounded-circle" alt=""
                                     style="object-fit:cover;"
                                     src="{{ Session::get('avatar') ? asset('images/' . Session::get('avatar')) : asset('assets/img/user.png') }}"
                                     onerror="this.onerror=null;this.src='{{ asset('assets/img/user.png') }}'">
                            </div>
                            <div class="user-text">
                                <h6>{{ Session::get('name') }}</h6>
                                <p class="text-muted mb-0">{{ Session::get('role_name') }}</p>
                            </div>
                        </div>
                        <a class="dropdown-item" href="{{ route('user/profile/page') }}">My Profile</a>
                        <a class="dropdown-item" href="inbox.html">Inbox</a>
                        <a class="dropdown-item" href="{{ route('logout') }}">Logout</a>
                    </div>
                </li>
            </ul>
        </div>
		{{-- side bar --}}
		@include('sidebar.sidebar')
		{{-- content page --}}
        @yield('content')
        <footer>
            <p>Copyright &copy; <?php echo date('Y'); ?> Kg FDC by Aikaruwa.</p>
        </footer>
    
    </div>

    <script src="{{ URL::to('assets/js/jquery-3.6.0.min.js') }}"></script>
    <script src="{{ URL::to('assets/plugins/bootstrap/js/bootstrap.bundle.min.js') }}"></script>
    <script src="{{ URL::to('assets/js/feather.min.js') }}"></script>
    <script src="{{ URL::to('assets/plugins/slimscroll/jquery.slimscroll.min.js') }}"></script>
    <script src="{{ URL::to('assets/plugins/apexchart/apexcharts.min.js') }}"></script>
    <script src="{{ URL::to('assets/plugins/apexchart/chart-data.js') }}"></script>
    <script src="{{ URL::to('assets/plugins/simple-calendar/jquery.simple-calendar.js') }}"></script>
    <script src="{{ URL::to('assets/js/circle-progress.min.js') }}"></script>
    {{-- calander.js replaced inline below with a safe try-catch wrapper --}}
    <script src="{{ URL::to('assets/plugins/moment/moment.min.js') }}"></script>
    <script src="{{ URL::to('assets/js/bootstrap-datetimepicker.min.js') }}"></script>
    <script src="{{ URL::to('assets/plugins/datatables/datatables.min.js') }}"></script>
    <script src="{{ URL::to('assets/plugins/select2/js/select2.min.js') }}"></script>
    <script>
        // Safety guard: remove any stray backdrop script.js may leave behind
        window.addEventListener('load', function() {
            $('.modal-backdrop').remove();
            $('body').removeClass('modal-open').css('overflow', 'auto');
        });
    </script>
    <script src="{{ URL::to('assets/js/script.js') }}"></script>
    <!-- imessage -->
    <script src="{{ asset('assets/js/imessage.js') }}"></script>
    <script>
        document.addEventListener("DOMContentLoaded", function () {
            let messages = {
                success: "{{ session('success') }}",
                error: "{{ session('error') }}",
                warning: "{{ session('warning') }}",
                info: "{{ session('info') }}"
            };
    
            Object.keys(messages).forEach(type => {
                if (messages[type]) {
                    new Message('imessage').show(messages[type], type === "error" ? "fail" : type, "top-center");
                }
            });
        });
    </script>
    <script>
        $(document).ready(function() {
            $('.select2').select2({
                closeOnSelect: false
            });
        });
    </script>
    <script>
        // Safe calendar init — only runs if #calendar-doctor exists on this page
        $(document).ready(function () {
            try {
                if ($('#calendar-doctor').length > 0) {
                    $('#calendar-doctor').simpleCalendar({
                        fixedStartDay: 0,
                        disableEmptyDetails: true,
                        events: [
                            {
                                startDate: new Date(new Date().setHours(new Date().getHours() + 24)).toDateString(),
                                endDate:   new Date(new Date().setHours(new Date().getHours() + 25)).toISOString(),
                                summary:   'Conference with teachers'
                            },
                            {
                                startDate: new Date(new Date().setHours(0)).toISOString(),
                                endDate:   new Date(new Date().setHours(1)).toISOString(),
                                summary:   'Old classes'
                            },
                            {
                                startDate: new Date(new Date().setHours(new Date().getHours() - 48)).toISOString(),
                                endDate:   new Date(new Date().setHours(new Date().getHours() - 24)).toISOString(),
                                summary:   'Old Lessons'
                            }
                        ]
                    });
                }
            } catch (e) {
                console.warn('Calendar init skipped:', e.message);
            }
        });
    </script>
    @yield('script')

    <script>
        // Remove any stray modal backdrop injected by Bootstrap JS
        document.addEventListener('DOMContentLoaded', function () {
            document.querySelectorAll('.modal-backdrop').forEach(el => el.remove());
            document.body.classList.remove('modal-open');
            document.body.style.overflow = 'auto';
            document.body.style.paddingRight = '';
        });
    </script>
</body>
</html>