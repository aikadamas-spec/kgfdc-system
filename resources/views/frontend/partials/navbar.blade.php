{{--
|--------------------------------------------------------------------------
| Frontend Navbar Partial
|--------------------------------------------------------------------------
| Single source of truth for the public website navigation.
| Included by: layouts/frontend.blade.php and frontend/mwanzo.blade.php
| To update the menu, edit ONLY this file.
--}}

<!-- ===== TOP BAR ===== -->
<div class="bg-gradient-to-r from-light-blue to-ocean-blue text-white text-sm py-2">
    <div class="container mx-auto px-4 flex justify-between items-center">
        <div class="flex items-center space-x-6">
            <span><i class="fas fa-map-marker-alt mr-2"></i>{{ __('messages.top_location') }}</span>
            <span><i class="fas fa-phone mr-2"></i>+255 625 771 393</span>
        </div>
        <div class="flex items-center space-x-4">
            <a href="{{ route('frontend.ratiba') }}" class="hover:text-yellow-300 transition">{{ __('messages.top_schedule') }}</a>
            <span class="opacity-50">|</span>
            <a href="{{ route('frontend.wahitimu') }}" class="hover:text-yellow-300 transition">{{ __('messages.top_graduates') }}</a>
            <span class="opacity-50">|</span>
            <a href="{{ route('frontend.wasiliana') }}" class="hover:text-yellow-300 transition">{{ __('messages.top_contact') }}</a>

            {{-- Auth block: show Dashboard/Logout if logged in, else Login/Register --}}
            @if (Route::has('login'))
                @auth
                    @if(auth()->user()->role == 'coordinator' || auth()->user()->role == 'admin')
                        <a href="{{ url('/home') }}" class="bg-african-gold text-black px-3 py-1 rounded-md font-bold text-xs hover:bg-yellow-400 transition shadow-sm">
                            <i class="fas fa-user-shield"></i> Admin Panel
                        </a>
                    @else
                        <a href="{{ url('/home') }}" class="hover:text-yellow-300 transition text-xs font-bold underline">
                            <i class="fas fa-tachometer-alt text-[10px]"></i> Dashboard
                        </a>
                    @endif
                    <form method="POST" action="{{ route('logout') }}" class="inline">
                        @csrf
                        <button type="submit" class="text-white hover:text-red-300 transition ml-1" title="Toka">
                            <i class="fas fa-power-off"></i>
                        </button>
                    </form>
                @else
                    <a href="{{ route('login') }}" class="hover:text-yellow-300 transition text-xs font-medium">
                        <i class="fas fa-lock text-[10px]"></i> {{ __('messages.top_login') }}
                    </a>
                @endauth
            @endif

            <a href="https://www.facebook.com/profile.php?id=61555114508301" target="_blank" class="hover:text-yellow-300 transition"><i class="fab fa-facebook"></i></a>
            <a href="https://www.instagram.com/kigambonifdc/" target="_blank" class="hover:text-yellow-300 transition"><i class="fab fa-instagram"></i></a>
            <a href="https://wa.me/255717685138" target="_blank" class="hover:text-yellow-300 transition"><i class="fab fa-whatsapp"></i></a>
        </div>
    </div>
</div>

<!-- ===== MAIN NAVIGATION ===== -->
<nav class="bg-white shadow-lg sticky top-0 z-50 border-b-4 border-light-blue">
    <div class="container mx-auto px-4">
        <div class="flex justify-between items-center py-4">

            <!-- Left Logo (Coat of Arms) -->
            <a href="{{ route('frontend.home') }}" class="flex items-center">
                <img src="{{ asset('frontend_assets/img/nembotaifa.webp') }}" alt="KIGAMBONI FDC" class="h-20 w-auto">
            </a>

            <!-- Desktop Menu -->
            <div class="hidden lg:flex items-center space-x-6">

                <a href="{{ route('frontend.home') }}"
                   class="nav-link font-bold text-gray-700 hover:text-light-blue transition {{ request()->routeIs('frontend.home') ? 'text-light-blue' : '' }}">
                    {{ __('messages.home') }}
                </a>

                {{-- Kuhusu Sisi --}}
                <div class="dropdown relative">
                    <a href="#" class="nav-link font-bold text-gray-700 hover:text-light-blue transition {{ request()->routeIs('frontend.historia','frontend.dira','frontend.lengo','frontend.utawala','frontend.wafanyakazi','frontend.wahitimu') ? 'text-light-blue' : '' }}">
                        {{ __('messages.about_us') }} <i class="fas fa-chevron-down text-xs ml-1"></i>
                    </a>
                    <div class="dropdown-menu absolute left-0 top-full bg-white shadow-xl rounded-lg mt-2 py-4 w-64 z-50">
                        <a href="{{ route('frontend.historia') }}"       class="block px-4 py-2 hover:bg-gray-50 hover:text-light-blue {{ request()->routeIs('frontend.historia') ? 'text-light-blue font-semibold' : '' }}">{{ __('messages.history') }}</a>
                        <a href="{{ route('frontend.dira') }}"           class="block px-4 py-2 hover:bg-gray-50 hover:text-light-blue {{ request()->routeIs('frontend.dira') ? 'text-light-blue font-semibold' : '' }}">{{ __('messages.vision_mission') }}</a>
                        <a href="{{ route('frontend.lengo') }}"          class="block px-4 py-2 hover:bg-gray-50 hover:text-light-blue {{ request()->routeIs('frontend.lengo') ? 'text-light-blue font-semibold' : '' }}">{{ __('messages.goals') }}</a>
                        <a href="{{ route('frontend.utawala') }}"        class="block px-4 py-2 hover:bg-gray-50 hover:text-light-blue {{ request()->routeIs('frontend.utawala') ? 'text-light-blue font-semibold' : '' }}">{{ __('messages.governance') }}</a>
                        <a href="{{ route('frontend.wafanyakazi') }}"    class="block px-4 py-2 hover:bg-gray-50 hover:text-light-blue {{ request()->routeIs('frontend.wafanyakazi') ? 'text-light-blue font-semibold' : '' }}">{{ __('messages.staff') }}</a>
                        <a href="{{ route('frontend.wahitimu') }}"       class="block px-4 py-2 hover:bg-gray-50 hover:text-light-blue {{ request()->routeIs('frontend.wahitimu') ? 'text-light-blue font-semibold' : '' }}">{{ __('messages.alumni') }}</a>
                    </div>
                </div>

                {{-- Kozi Zinazotolewa --}}
                <div class="dropdown relative">
                    <a href="#" class="nav-link font-bold text-gray-700 hover:text-light-blue transition {{ request()->routeIs('frontend.kozi-mrefu','frontend.kozi-mfupi') ? 'text-light-blue' : '' }}">
                        {{ __('messages.courses') }} <i class="fas fa-chevron-down text-xs ml-1"></i>
                    </a>
                    <div class="dropdown-menu absolute left-0 top-full bg-white shadow-xl rounded-lg mt-2 py-4 w-64 z-50">
                        <a href="{{ route('frontend.kozi-mrefu') }}" class="block px-4 py-2 hover:bg-gray-50 hover:text-light-blue {{ request()->routeIs('frontend.kozi-mrefu') ? 'text-light-blue font-semibold' : '' }}">{{ __('messages.long_courses') }}</a>
                        <a href="{{ route('frontend.kozi-mfupi') }}" class="block px-4 py-2 hover:bg-gray-50 hover:text-light-blue {{ request()->routeIs('frontend.kozi-mfupi') ? 'text-light-blue font-semibold' : '' }}">{{ __('messages.short_courses') }}</a>
                    </div>
                </div>

                {{-- Kujiunga na Chuo --}}
                <div class="dropdown relative">
                    <a href="#" class="nav-link font-bold text-gray-700 hover:text-light-blue transition {{ request()->routeIs('frontend.sifa','frontend.mahitaji','frontend.hatua') ? 'text-light-blue' : '' }}">
                        {{ __('messages.join_us') }} <i class="fas fa-chevron-down text-xs ml-1"></i>
                    </a>
                    <div class="dropdown-menu absolute left-0 top-full bg-white shadow-xl rounded-lg mt-2 py-4 w-64 z-50">
                        <a href="{{ route('frontend.sifa') }}"     class="block px-4 py-2 hover:bg-gray-50 hover:text-light-blue {{ request()->routeIs('frontend.sifa') ? 'text-light-blue font-semibold' : '' }}">{{ __('messages.applicant_qualifications') }}</a>
                        <a href="{{ route('frontend.mahitaji') }}" class="block px-4 py-2 hover:bg-gray-50 hover:text-light-blue {{ request()->routeIs('frontend.mahitaji') ? 'text-light-blue font-semibold' : '' }}">{{ __('messages.admission_requirements') }}</a>
                        <a href="{{ route('frontend.hatua') }}"    class="block px-4 py-2 hover:bg-gray-50 hover:text-light-blue {{ request()->routeIs('frontend.hatua') ? 'text-light-blue font-semibold' : '' }}">{{ __('messages.admission_steps') }}</a>
                    </div>
                </div>

                {{-- Idara Zetu --}}
                <div class="dropdown relative">
                    <a href="#" class="nav-link font-bold text-gray-700 hover:text-light-blue transition {{ request()->routeIs('frontend.ufundi-magari','frontend.umeme-magari','frontend.umeme-majumbani','frontend.uchomeleaji','frontend.ufundi-bomba','frontend.ushonaji','frontend.uashi','frontend.tehama') ? 'text-light-blue' : '' }}">
                        Fani Tunazofundisha <i class="fas fa-chevron-down text-xs ml-1"></i>
                    </a>
                    <div class="dropdown-menu absolute left-0 top-full bg-white shadow-xl rounded-lg mt-2 py-4 w-72 z-50">
                        <a href="{{ route('frontend.ufundi-magari') }}"    class="block px-4 py-2 hover:bg-gray-50 hover:text-light-blue {{ request()->routeIs('frontend.ufundi-magari') ? 'text-light-blue font-semibold' : '' }}">{{ __('messages.dept_mechanic') }}</a>
                        <a href="{{ route('frontend.umeme-magari') }}"     class="block px-4 py-2 hover:bg-gray-50 hover:text-light-blue {{ request()->routeIs('frontend.umeme-magari') ? 'text-light-blue font-semibold' : '' }}">{{ __('messages.dept_auto_electrical') }}</a>
                        <a href="{{ route('frontend.umeme-majumbani') }}"  class="block px-4 py-2 hover:bg-gray-50 hover:text-light-blue {{ request()->routeIs('frontend.umeme-majumbani') ? 'text-light-blue font-semibold' : '' }}">{{ __('messages.dept_domestic_elec') }}</a>
                        <a href="{{ route('frontend.uchomeleaji') }}"      class="block px-4 py-2 hover:bg-gray-50 hover:text-light-blue {{ request()->routeIs('frontend.uchomeleaji') ? 'text-light-blue font-semibold' : '' }}">{{ __('messages.dept_welding') }}</a>
                        <a href="{{ route('frontend.ufundi-bomba') }}"     class="block px-4 py-2 hover:bg-gray-50 hover:text-light-blue {{ request()->routeIs('frontend.ufundi-bomba') ? 'text-light-blue font-semibold' : '' }}">{{ __('messages.dept_plumbing') }}</a>
                        <a href="{{ route('frontend.ushonaji') }}"         class="block px-4 py-2 hover:bg-gray-50 hover:text-light-blue {{ request()->routeIs('frontend.ushonaji') ? 'text-light-blue font-semibold' : '' }}">{{ __('messages.dept_tailoring') }}</a>
                        <a href="{{ route('frontend.uashi') }}"            class="block px-4 py-2 hover:bg-gray-50 hover:text-light-blue {{ request()->routeIs('frontend.uashi') ? 'text-light-blue font-semibold' : '' }}">{{ __('messages.dept_masonry') }}</a>
                        <a href="{{ route('frontend.tehama') }}"           class="block px-4 py-2 hover:bg-gray-50 hover:text-light-blue {{ request()->routeIs('frontend.tehama') ? 'text-light-blue font-semibold' : '' }}">{{ __('messages.dept_ict') }}</a>
                    </div>
                </div>

                {{-- Maisha Chuoni --}}
                <div class="dropdown relative">
                    <a href="#" class="nav-link font-bold text-gray-700 hover:text-light-blue transition {{ request()->routeIs('frontend.uongozi','frontend.sheria','frontend.malazi','frontend.michezo','frontend.ratiba') ? 'text-light-blue' : '' }}">
                        {{ __('messages.campus_life') }} <i class="fas fa-chevron-down text-xs ml-1"></i>
                    </a>
                    <div class="dropdown-menu absolute left-0 top-full bg-white shadow-xl rounded-lg mt-2 py-4 w-64 z-50">
                        <a href="{{ route('frontend.uongozi') }}" class="block px-4 py-2 hover:bg-gray-50 hover:text-light-blue {{ request()->routeIs('frontend.uongozi') ? 'text-light-blue font-semibold' : '' }}">{{ __('messages.student_leadership') }}</a>
                        <a href="{{ route('frontend.sheria') }}"  class="block px-4 py-2 hover:bg-gray-50 hover:text-light-blue {{ request()->routeIs('frontend.sheria') ? 'text-light-blue font-semibold' : '' }}">{{ __('messages.student_rules') }}</a>
                        <a href="{{ route('frontend.malazi') }}"  class="block px-4 py-2 hover:bg-gray-50 hover:text-light-blue {{ request()->routeIs('frontend.malazi') ? 'text-light-blue font-semibold' : '' }}">{{ __('messages.accommodation') }}</a>
                        <a href="{{ route('frontend.michezo') }}" class="block px-4 py-2 hover:bg-gray-50 hover:text-light-blue {{ request()->routeIs('frontend.michezo') ? 'text-light-blue font-semibold' : '' }}">{{ __('messages.sports') }}</a>
                        <a href="{{ route('frontend.ratiba') }}"  class="block px-4 py-2 hover:bg-gray-50 hover:text-light-blue {{ request()->routeIs('frontend.ratiba') ? 'text-light-blue font-semibold' : '' }}">{{ __('messages.timetable') }}</a>
                    </div>
                </div>

                <a href="{{ route('frontend.habari') }}"
                   class="nav-link font-bold text-gray-700 hover:text-light-blue transition {{ request()->routeIs('frontend.habari') ? 'text-light-blue' : '' }}">
                    {{ __('messages.news_gallery') }}
                </a>

                <a href="{{ route('frontend.wasiliana') }}"
                   class="nav-link font-bold text-gray-700 hover:text-light-blue transition {{ request()->routeIs('frontend.wasiliana') ? 'text-light-blue' : '' }}">
                    {{ __('messages.contact_us') }}
                </a>

            </div><!-- end desktop menu -->

            <!-- Right Logo (FDC Logo) -->
            <a href="{{ route('frontend.home') }}" class="flex items-center">
                <img src="{{ asset('frontend_assets/img/fdclogonow.webp') }}" alt="FDC Logo" class="h-20 w-auto">
            </a>

            <!-- Search & Drawer Toggle -->
            <div class="flex items-center space-x-4">
                <button id="searchBtn" class="text-gray-700 hover:text-light-blue transition" aria-label="Tafuta">
                    <i class="fas fa-search text-lg"></i>
                </button>
                <button id="rightDrawerBtn" class="text-gray-700 hover:text-light-blue transition" aria-label="Menyu">
                    <i class="fas fa-bars text-xl"></i>
                </button>
            </div>

        </div>
    </div>

    <!-- Search Overlay -->
    <div id="searchOverlay" class="search-overlay fixed inset-0 bg-black bg-opacity-95 z-50 flex items-center justify-center">
        <div class="container mx-auto px-4">
            <div class="max-w-3xl mx-auto">
                <div class="flex justify-end mb-4">
                    <button id="closeSearch" class="text-white text-3xl">&times;</button>
                </div>
                <form action="{{ route('frontend.search') }}" method="GET">
                    <div class="flex gap-3">
                        <input type="text"
                               name="query"
                               id="searchInput"
                               placeholder="{{ __('messages.search_placeholder') }}"
                               class="flex-1 bg-transparent border-b-2 border-white text-white text-2xl py-4 focus:outline-none focus:border-light-blue placeholder-white/50">
                        <button type="submit"
                                class="text-white hover:text-light-blue transition text-2xl px-4">
                            <i class="fas fa-search"></i>
                        </button>
                    </div>
                </form>
                <div class="mt-8 flex flex-wrap gap-3">
                    <span class="text-gray-400">{{ app()->getLocale() === 'sw' ? 'Maarufu:' : 'Popular:' }}</span>
                    <a href="{{ route('frontend.historia') }}"   class="text-white bg-gray-800 px-3 py-1 rounded-full text-sm hover:bg-light-blue transition">{{ __('messages.history') }}</a>
                    <a href="{{ route('frontend.kozi-mrefu') }}" class="text-white bg-gray-800 px-3 py-1 rounded-full text-sm hover:bg-light-blue transition">{{ __('messages.long_courses') }}</a>
                    <a href="{{ route('frontend.kozi-mfupi') }}" class="text-white bg-gray-800 px-3 py-1 rounded-full text-sm hover:bg-light-blue transition">{{ __('messages.short_courses') }}</a>
                    <a href="{{ route('frontend.hatua') }}"      class="text-white bg-gray-800 px-3 py-1 rounded-full text-sm hover:bg-light-blue transition">{{ __('messages.join_us') }}</a>
                </div>
            </div>
        </div>
    </div>
</nav>

<!-- ===== RIGHT DRAWER (Slide-in menu) ===== -->
<div id="rightDrawer" class="right-drawer fixed inset-y-0 right-0 w-full md:w-96 bg-white shadow-2xl z-50 transform translate-x-full transition-transform duration-300 ease-in-out">
    <div class="h-full flex flex-col">

        <!-- Search input -->
        <div class="p-4 border-b">
            <form action="{{ route('frontend.search') }}" method="GET">
                <div class="flex items-center justify-between gap-3">
                    <input type="text"
                           name="query"
                           placeholder="{{ __('messages.search_placeholder') }}"
                           class="flex-1 px-4 py-2 border border-gray-300 rounded-lg focus:outline-none focus:border-light-blue text-sm">
                    <button type="submit" class="text-light-blue hover:text-blue-700 transition">
                        <i class="fas fa-search text-lg"></i>
                    </button>
                    <button type="button" id="closeRightDrawer" class="text-gray-600 hover:text-light-blue text-2xl">
                        <i class="fas fa-times"></i>
                    </button>
                </div>
            </form>
        </div>

        <!-- Logo & Login -->
        <div class="p-4 border-b bg-gray-50">
            <div class="flex items-center justify-between">
                <img src="{{ asset('frontend_assets/img/fdclogonow.webp') }}" alt="KIGAMBONI FDC" class="h-16">
                <div class="flex items-center space-x-3">
                    <a href="{{ route('login') }}" class="text-sm text-light-blue hover:underline font-medium">
                        <i class="fas fa-lock text-xs mr-1"></i>{{ __('messages.top_login') }}
                    </a>
                </div>
            </div>
        </div>

        <!-- Drawer Nav Links -->
        <div class="flex-1 overflow-y-auto">
            <nav class="py-2">
                <a href="{{ route('frontend.home') }}"        class="block px-6 py-3 text-gray-700 hover:bg-light-blue hover:text-white transition border-b border-gray-100 font-semibold">{{ __('messages.home') }}</a>

                <p class="px-6 pt-4 pb-1 text-xs font-bold text-gray-400 uppercase tracking-widest">{{ __('messages.about_us') }}</p>
                <a href="{{ route('frontend.historia') }}"    class="block px-6 py-3 text-gray-700 hover:bg-light-blue hover:text-white transition border-b border-gray-100">{{ __('messages.history') }}</a>
                <a href="{{ route('frontend.dira') }}"        class="block px-6 py-3 text-gray-700 hover:bg-light-blue hover:text-white transition border-b border-gray-100">{{ __('messages.vision_mission') }}</a>
                <a href="{{ route('frontend.lengo') }}"       class="block px-6 py-3 text-gray-700 hover:bg-light-blue hover:text-white transition border-b border-gray-100">{{ __('messages.goals') }}</a>
                <a href="{{ route('frontend.utawala') }}"     class="block px-6 py-3 text-gray-700 hover:bg-light-blue hover:text-white transition border-b border-gray-100">{{ __('messages.governance') }}</a>
                <a href="{{ route('frontend.wafanyakazi') }}" class="block px-6 py-3 text-gray-700 hover:bg-light-blue hover:text-white transition border-b border-gray-100">{{ __('messages.staff') }}</a>
                <a href="{{ route('frontend.wahitimu') }}"    class="block px-6 py-3 text-gray-700 hover:bg-light-blue hover:text-white transition border-b border-gray-100">{{ __('messages.alumni') }}</a>

                <p class="px-6 pt-4 pb-1 text-xs font-bold text-gray-400 uppercase tracking-widest">{{ __('messages.courses') }}</p>
                <a href="{{ route('frontend.kozi-mrefu') }}"  class="block px-6 py-3 text-gray-700 hover:bg-light-blue hover:text-white transition border-b border-gray-100">{{ __('messages.long_courses') }}</a>
                <a href="{{ route('frontend.kozi-mfupi') }}"  class="block px-6 py-3 text-gray-700 hover:bg-light-blue hover:text-white transition border-b border-gray-100">{{ __('messages.short_courses') }}</a>

                <p class="px-6 pt-4 pb-1 text-xs font-bold text-gray-400 uppercase tracking-widest">{{ __('messages.join_us') }}</p>
                <a href="{{ route('frontend.sifa') }}"        class="block px-6 py-3 text-gray-700 hover:bg-light-blue hover:text-white transition border-b border-gray-100">{{ __('messages.applicant_qualifications') }}</a>
                <a href="{{ route('frontend.mahitaji') }}"    class="block px-6 py-3 text-gray-700 hover:bg-light-blue hover:text-white transition border-b border-gray-100">{{ __('messages.admission_requirements') }}</a>
                <a href="{{ route('frontend.hatua') }}"       class="block px-6 py-3 text-gray-700 hover:bg-light-blue hover:text-white transition border-b border-gray-100">{{ __('messages.admission_steps') }}</a>

                <p class="px-6 pt-4 pb-1 text-xs font-bold text-gray-400 uppercase tracking-widest">{{ __('messages.departments') }}</p>
                <a href="{{ route('frontend.ufundi-magari') }}"   class="block px-6 py-3 text-gray-700 hover:bg-light-blue hover:text-white transition border-b border-gray-100">{{ __('messages.dept_mechanic') }}</a>
                <a href="{{ route('frontend.umeme-magari') }}"    class="block px-6 py-3 text-gray-700 hover:bg-light-blue hover:text-white transition border-b border-gray-100">{{ __('messages.dept_auto_electrical') }}</a>
                <a href="{{ route('frontend.umeme-majumbani') }}" class="block px-6 py-3 text-gray-700 hover:bg-light-blue hover:text-white transition border-b border-gray-100">{{ __('messages.dept_domestic_elec') }}</a>
                <a href="{{ route('frontend.uchomeleaji') }}"     class="block px-6 py-3 text-gray-700 hover:bg-light-blue hover:text-white transition border-b border-gray-100">{{ __('messages.dept_welding') }}</a>
                <a href="{{ route('frontend.ufundi-bomba') }}"    class="block px-6 py-3 text-gray-700 hover:bg-light-blue hover:text-white transition border-b border-gray-100">{{ __('messages.dept_plumbing') }}</a>
                <a href="{{ route('frontend.ushonaji') }}"        class="block px-6 py-3 text-gray-700 hover:bg-light-blue hover:text-white transition border-b border-gray-100">{{ __('messages.dept_tailoring') }}</a>
                <a href="{{ route('frontend.uashi') }}"           class="block px-6 py-3 text-gray-700 hover:bg-light-blue hover:text-white transition border-b border-gray-100">{{ __('messages.dept_masonry') }}</a>
                <a href="{{ route('frontend.tehama') }}"          class="block px-6 py-3 text-gray-700 hover:bg-light-blue hover:text-white transition border-b border-gray-100">{{ __('messages.dept_ict') }}</a>

                <p class="px-6 pt-4 pb-1 text-xs font-bold text-gray-400 uppercase tracking-widest">{{ __('messages.campus_life') }}</p>
                <a href="{{ route('frontend.uongozi') }}"  class="block px-6 py-3 text-gray-700 hover:bg-light-blue hover:text-white transition border-b border-gray-100">{{ __('messages.student_leadership') }}</a>
                <a href="{{ route('frontend.sheria') }}"   class="block px-6 py-3 text-gray-700 hover:bg-light-blue hover:text-white transition border-b border-gray-100">{{ __('messages.student_rules') }}</a>
                <a href="{{ route('frontend.malazi') }}"   class="block px-6 py-3 text-gray-700 hover:bg-light-blue hover:text-white transition border-b border-gray-100">{{ __('messages.accommodation') }}</a>
                <a href="{{ route('frontend.michezo') }}"  class="block px-6 py-3 text-gray-700 hover:bg-light-blue hover:text-white transition border-b border-gray-100">{{ __('messages.sports') }}</a>
                <a href="{{ route('frontend.ratiba') }}"   class="block px-6 py-3 text-gray-700 hover:bg-light-blue hover:text-white transition border-b border-gray-100">{{ __('messages.timetable') }}</a>

                <p class="px-6 pt-4 pb-1 text-xs font-bold text-gray-400 uppercase tracking-widest">{{ __('messages.more') }}</p>
                <a href="{{ route('frontend.habari') }}"    class="block px-6 py-3 text-gray-700 hover:bg-light-blue hover:text-white transition border-b border-gray-100">{{ __('messages.news_gallery') }}</a>
                <a href="{{ route('frontend.wasiliana') }}" class="block px-6 py-3 text-gray-700 hover:bg-light-blue hover:text-white transition border-b border-gray-100">{{ __('messages.contact_us') }}</a>
            </nav>
        </div>

        <!-- Contact footer -->
        <div class="p-4 border-t bg-gray-50 text-center">
            <p class="text-sm text-gray-600"><i class="fas fa-phone mr-2 text-light-blue"></i>+255 625 771 393</p>
            <p class="text-sm text-gray-600"><i class="fas fa-phone mr-2 text-light-blue"></i>+255 717 685 138</p>
        </div>

    </div>
</div>

<!-- Drawer Overlay -->
<div id="drawerOverlay" class="fixed inset-0 bg-black bg-opacity-50 z-40 hidden"></div>
