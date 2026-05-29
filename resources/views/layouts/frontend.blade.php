<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>KIGAMBONI FDC - Folk Development College & Training Institute</title>
    <script src="{{ asset('frontend_assets/js/tailwind.min.js') }}"></script>
    <link rel="stylesheet" href="{{ asset('frontend_assets/fonts/fontawesome/css/all.min.css') }}">
    {{-- Alpine.js — required for accordion and interactive components --}}
    <script defer src="https://cdn.jsdelivr.net/npm/alpinejs@3.14.8/dist/cdn.min.js"></script>
    <script>
        tailwind.config = {
            theme: {
                extend: {
                    colors: {
                        'kigamboni-red': '#E31E24',
                        'kigamboni-dark': '#1A1A1A',
                        'kigamboni-gray': '#F5F5F5',
                        'african-green': '#1EB5A7',
                        'african-gold': '#FFD700',
                        'light-blue': '#4ca8cd',
                        'ocean-blue': '#FFD700',
                        'light-blue': '#4ca8cd',
                        'sky-blue': '#0EA5E9',
                        'ocean-blue': '#0284C7',
                    },
                    fontFamily: {
                        'sans': ['Inter', 'sans-serif'],
                    }
                }
            }
        }
    </script>
    <style>
        @import url('{{ asset('frontend_assets/fonts/inter/inter.css') }}');
        
        * {
            margin: 0;
            padding: 0;
            box-sizing: border-box;
        }
        
        html {
            scroll-behavior: smooth;
        }
        
        .hero-gradient {
            background: linear-gradient(135deg, rgba(0,0,0,0.7) 0%, rgba(0,0,0,0.3) 100%);
        }
        
        .nav-link {
            position: relative;
            font-family: Arial;
        }
        
        .nav-link::after {
            content: '';
            position: absolute;
            bottom: -2px;
            left: 0;
            width: 0;
            height: 2px;
            background-color: #102a5d; 
            transition: width 0.3s ease;
        }
        
        .nav-link:hover::after {
            width: 100%;
        }
        
        .dropdown-menu {
            opacity: 0;
            visibility: hidden;
            transform: translateY(10px);
            transition: all 0.3s ease;
        }
        
        .dropdown:hover .dropdown-menu {
            opacity: 1;
            visibility: visible;
            transform: translateY(0);
        }
        
        .card-hover {
            transition: all 0.4s ease;
        }
        
        .card-hover:hover {
            transform: translateY(-10px);
            box-shadow: 0 25px 50px -12px rgba(0, 0, 0, 0.25);
        }
        
        .stat-counter {
            animation: countUp 2s ease-out forwards;
        }
        
        @keyframes countUp {
            from { opacity: 0; transform: translateY(20px); }
            to { opacity: 1; transform: translateY(0); }
        }
        
        .slider-container {
            overflow: hidden;
        }
        
        .slider-track {
            display: flex;
            transition: transform 0.5s ease;
        }
        
        .slide {
            min-width: 100%;
        }
        
        .news-card:hover .news-image {
            transform: scale(1.05);
        }
        
        .mobile-menu {
            transform: translateX(-100%);
            transition: transform 0.3s ease;
        }
        
        .mobile-menu.active {
            transform: translateX(0);
        }
        
        .search-overlay {
            opacity: 0;
            visibility: hidden;
            transition: all 0.3s ease;
        }
        
        .search-overlay.active {
            opacity: 1;
            visibility: visible;
        }
        
        .category-card::before {
            content: '';
            position: absolute;
            top: 0;
            left: 0;
            width: 100%;
            height: 100%;
            background: linear-gradient(to top, rgba(0,0,0,0.8) 0%, transparent 50%);
            z-index: 1;
        }
        
        .floating-label {
            animation: float 3s ease-in-out infinite;
        }
        
        @keyframes float {
            0%, 100% { transform: translateY(0); }
            50% { transform: translateY(-10px); }
        }
        
        .pulse-dot {
            animation: pulse 2s infinite;
        }
        
        @keyframes pulse {
            0%, 100% { transform: scale(1); opacity: 1; }
            50% { transform: scale(1.5); opacity: 0.5; }
        }

  /* Updated Yellow Floating Sidebar */
        .floating-social {
            position: fixed;
            right: 20px;
            top: 50%;
            transform: translateY(-50%);
            display: flex;
            flex-direction: column;
            gap: 10px; /* Tighter gap like the image */
            z-index: 9999;
        }

        .social-btn {
            width: 48px;
            height: 48px;
            background-color: #4ba3ce !important; /* Solid college blue — no transparency */
            border: 2px solid #0f2c59 !important; /* Logo dark blue border */
            opacity: 1 !important;
            border-radius: 50%;
            position: relative;
            display: flex;
            align-items: center;
            justify-content: center;
            box-shadow: 0 4px 12px rgba(15, 44, 89, 0.35);
            transition: background-color 0.25s ease, border-width 0.2s ease, border-color 0.2s ease, box-shadow 0.25s ease, transform 0.2s ease;
            text-decoration: none;
            overflow: hidden; /* Keeps flags inside the circle */
        }

        .social-btn:hover {
            background-color: #3a8eb0 !important; /* Slightly darker on hover */
            border: 3px solid #0f2c59 !important; /* Border expands to 3px */
            box-shadow: 0 6px 18px rgba(15, 44, 89, 0.5);
            transform: scale(1.1);
        }

        .social-btn i {
            color: #ffffff !important; /* Solid white icons */
            font-size: 18px;
        }

        /* Visitor counter buttons — same shape as .social-btn but stacked vertically */
        .visitor-btn {
            width: 48px;
            height: 48px;
            border-radius: 50%;
            position: relative;
            display: flex;
            flex-direction: column;
            align-items: center;
            justify-content: center;
            box-shadow: 0 4px 10px rgba(0,0,0,0.25);
            transition: all 0.2s ease-in-out;
            overflow: visible; /* must NOT clip the stacked content */
            cursor: default;
        }

        .visitor-btn:hover {
            transform: scale(1.1);
            filter: brightness(1.1);
        }

        .flag-icon {
            width: 24px; /* Size for the flag images */
            height: auto;
        }

        .floating-group {
  position: fixed;   /* Pins the group to the screen */
  bottom: 25px;      /* Distance from bottom */
  right: 25px;       /* Distance from right */
  display: flex;
  flex-direction: column;
  gap: 15px;
  z-index: 1000;     /* Keeps it on top of other content */
}

.icon-link img {
  width: 45px;       /* Set your preferred size */
  background: transparent; /* Ensures no background box appears */
  display: block;
  transition: opacity 0.3s ease;
}

/* Optional: Fade slightly on hover for interactivity */
.icon-link:hover img {
  opacity: 0.7;      /* Values range from 0 (transparent) to 1 (opaque) */
}

       /*myb style mihtech */
                .slider {
                position: relative;
                width: 100%;
                height: 100vh;
                overflow: hidden;
            }

            .slide {
                position: absolute;
                width: 100%;
                height: 100%;
                background-size: cover;
                background-position: center;
                animation: slideAnimation 20s infinite;
                opacity: 0;
            }

            /* Mpangilio wa muda kwa kila picha */
            .slide:nth-child(1) { animation-delay: 0s; }
            .slide:nth-child(2) { animation-delay: 5s; }
            .slide:nth-child(3) { animation-delay: 10s; }
            .slide:nth-child(4) { animation-delay: 15s; }

        @keyframes slideAnimation {
            0% { opacity: 0; }
            5% { opacity: 1; }  /* Picha inatokea */
            25% { opacity: 1; } /* Picha inakaa (100 / 4 picha = 25%) */
            30% { opacity: 0; } /* Picha inapotea */
            100% { opacity: 0; }
}
    </style>
</head>
<body class="font-sans text-gray-800">

    {{-- ===== NAVBAR — edit resources/views/frontend/partials/navbar.blade.php ===== --}}
    @include('frontend.partials.navbar')

    {{-- LEGACY TOP BAR (kept for reference — remove after confirming navbar works) --}}
    {{-- <div class="bg-gradient-to-r from-light-blue to-ocean-blue text-white text-sm py-2"> --}}

<!-- Page Content -->
<div class="w-full max-w-screen-xl mx-auto my-10 bg-white rounded-[2rem] p-10 shadow-[0_10px_40px_rgba(0,0,0,0.08)] font-sans">
    @yield('content')
</div>


    <!-- CTA Section -->
    <section class="py-20 bg-gradient-to-r from-light-blue to-ocean-blue">
        <div class="container mx-auto px-4 text-center">
            <h2 class="text-4xl font-bold text-white mb-4">{{ __('messages.cta_heading') }}</h2>
            <p class="text-white text-xl mb-8 max-w-2xl mx-auto">{{ __('messages.cta_subtext') }}</p>
            <div class="flex flex-wrap justify-center gap-4">
                <a href="tel:+255717685138" class="bg-white text-light-blue px-8 py-4 rounded-lg font-semibold hover:bg-gray-100 transition inline-flex items-center">
                    <i class="fas fa-phone mr-2"></i> +255 717 685 138
                </a>
                <a href="https://www.google.com/maps/place/KIGAMBONI+FDC/@-6.8676616,39.3880999,17z"
                   target="_blank"
                   rel="noopener noreferrer"
                   class="border-2 border-white text-white px-8 py-4 rounded-lg font-semibold hover:bg-white hover:text-light-blue transition inline-flex items-center">
                    {{ __('messages.cta_visit_label') }} <i class="fas fa-arrow-right ml-2"></i>
                </a>
                <a href="{{ route('apply.start') }}" class="border-2 border-white text-white px-8 py-4 rounded-lg font-semibold hover:bg-white hover:text-light-blue transition inline-flex items-center">
                    <i class="fas fa-file-alt mr-2"></i> {{ __('messages.apply_now') }}
                </a>
            </div>
        </div>
    </section>

    <!-- News & Events -->
    <section class="py-20">
        <div class="container mx-auto px-4">
            <div class="text-center mb-16">
                <span class="text-light-blue font-semibold uppercase tracking-wider">{{ __('messages.news_section_label') }}</span>
                <h2 class="text-4xl font-bold mt-2">{{ __('messages.news_section_title') }}</h2>
            </div>

            <div class="grid md:grid-cols-3 gap-8">

                {{-- News 1 - Mechanic Workshop --}}
                <article class="news-card group">
                    <div class="relative overflow-hidden rounded-2xl mb-4">
                        <img src="{{ asset('frontend_assets/img/autogarage.webp') }}" alt="News 1"
                             class="news-image w-full h-48 object-cover transition duration-500">
                    </div>
                    <span class="text-sm text-light-blue font-medium">March 09</span>
                    <h3 class="text-xl font-bold mt-2 mb-2 group-hover:text-light-blue transition">
                        <a href="https://whatsapp.com/channel/0029Vb7aWdOAojYs2eAC7T2U" target="_blank"
                           class="inline-flex items-center font-semibold group-hover:gap-3 gap-2 transition-all">
                            {{ __('messages.news1_title') }}
                        </a>
                    </h3>
                    <p style="text-align: justify;" class="text-gray-600">{{ __('messages.news1_body') }}</p>
                </article>

                {{-- News 2 - Plumbing Workshop --}}
                <article class="news-card group">
                    <div class="relative overflow-hidden rounded-2xl mb-4">
                        <img src="{{ asset('frontend_assets/img/bomba.webp') }}" alt="News 2"
                             class="news-image w-full h-48 object-cover transition duration-500">
                    </div>
                    <span class="text-sm text-light-blue font-medium">March 12</span>
                    <h3 class="text-xl font-bold mt-2 mb-2 group-hover:text-light-blue transition">
                        <a href="https://whatsapp.com/channel/0029Vb7LpfB42DcaKNTT713z" target="_blank"
                           class="inline-flex items-center font-semibold group-hover:gap-3 gap-2 transition-all">
                            {{ __('messages.news2_title') }}
                        </a>
                    </h3>
                    <p style="text-align: justify;" class="text-gray-600">{{ __('messages.news2_body') }}</p>
                </article>

                {{-- News 3 - Electrical Workshop --}}
                <article class="news-card group">
                    <div class="relative overflow-hidden rounded-2xl mb-4">
                        <img src="{{ asset('frontend_assets/img/umememajumbani2.webp') }}" alt="News 3"
                             class="news-image w-full h-48 object-cover transition duration-500">
                    </div>
                    <span class="text-sm text-light-blue font-medium">March 14</span>
                    <h3 class="text-xl font-bold mt-2 mb-2 group-hover:text-light-blue transition">
                        <a href="https://whatsapp.com/channel/0029Vb7aWdOAojYs2eAC7T2U" target="_blank"
                           class="inline-flex items-center font-semibold group-hover:gap-3 gap-2 transition-all">
                            {{ __('messages.news3_title') }}
                        </a>
                    </h3>
                    <p style="text-align: justify;" class="text-gray-600">{{ __('messages.news3_body') }}</p>
                </article>

            </div>
        </div>
    </section>
    <!-- Footer -->
    <footer class="bg-kigamboni-dark text-white pt-16">
        <div class="container mx-auto px-4">
            <div class="grid md:grid-cols-2 lg:grid-cols-4 gap-8 mb-12">
                <!-- Location / Map -->
                <div>
                    <h4 class="font-bold text-sm mb-2 text-gray-300 uppercase tracking-wide">
                        {{ __('messages.footer_location') }}
                    </h4>
                    <div class="overflow-hidden rounded-lg shadow-md border border-gray-700 mb-4">
                        <iframe
                            src="https://www.google.com/maps/embed?pb=!1m18!1m12!1m3!1d1231.4250409586639!2d39.388099866240076!3d-6.867661567195587!2m3!1f0!2f0!3f0!3m2!1i1024!2i768!4f13.1!3m3!1m2!1s0x185dcbba1379051b%3A0x3821567ada1dd3ce!2sKIGAMBONI%20FDC!5e1!3m2!1sen!2stz!4v1778470379852!5m2!1sen!2stz"
                            width="100%"
                            height="220"
                            style="border:0;"
                            allowfullscreen=""
                            loading="lazy"
                            referrerpolicy="no-referrer-when-downgrade"
                            title="Kigamboni FDC Location">
                        </iframe>
                    </div>
                    <div class="flex space-x-3">
                        <a href="https://www.facebook.com/profile.php?id=61555114508301" target="_blank"
                           class="w-9 h-9 bg-gray-700 rounded-full flex items-center justify-center hover:bg-light-blue transition" aria-label="Facebook">
                            <i class="fab fa-facebook-f text-sm"></i>
                        </a>
                        <a href="https://www.instagram.com/kigambonifdc/" target="_blank"
                           class="w-9 h-9 bg-gray-700 rounded-full flex items-center justify-center hover:bg-light-blue transition" aria-label="Instagram">
                            <i class="fab fa-instagram text-sm"></i>
                        </a>
                        <a href="https://wa.me/255717685138" target="_blank"
                           class="w-9 h-9 bg-gray-700 rounded-full flex items-center justify-center hover:bg-light-blue transition" aria-label="WhatsApp">
                            <i class="fab fa-whatsapp text-sm"></i>
                        </a>
                    </div>
                </div>
                
                <!-- Products -->
                <div>
                    <h4 class="font-bold text-lg mb-4">{{ __('messages.footer_courses') }}</h4>
                    <ul class="space-y-2">
                        <li><a href="{{ route('frontend.ufundi-magari') }}"   class="text-gray-400 hover:text-white transition">{{ __('messages.dept_mechanic') }}</a></li>
                        <li><a href="{{ route('frontend.umeme-magari') }}"    class="text-gray-400 hover:text-white transition">{{ __('messages.dept_auto_electrical') }}</a></li>
                        <li><a href="{{ route('frontend.umeme-majumbani') }}" class="text-gray-400 hover:text-white transition">{{ __('messages.dept_domestic_elec') }}</a></li>
                        <li><a href="{{ route('frontend.uchomeleaji') }}"     class="text-gray-400 hover:text-white transition">{{ __('messages.dept_welding') }}</a></li>
                        <li><a href="{{ route('frontend.ufundi-bomba') }}"    class="text-gray-400 hover:text-white transition">{{ __('messages.dept_plumbing') }}</a></li>
                        <li><a href="{{ route('frontend.tehama') }}"          class="text-gray-400 hover:text-white transition">{{ __('messages.dept_ict') }}</a></li>
                    </ul>
                </div>
                
                <!-- Quick Links -->
                <div>
                    <h4 class="font-bold text-lg mb-4">{{ __('messages.footer_quick_links') }}</h4>
                    <ul class="space-y-2">
                        <li><a href="{{ route('frontend.ratiba') }}"   class="text-gray-400 hover:text-white transition">{{ __('messages.footer_timetable') }}</a></li>
                        <li><a href="{{ route('frontend.historia') }}" class="text-gray-400 hover:text-white transition">{{ __('messages.footer_history') }}</a></li>
                        <li><a href="{{ route('frontend.dira') }}"     class="text-gray-400 hover:text-white transition">{{ __('messages.footer_vision') }}</a></li>
                        <li><a href="{{ route('frontend.utawala') }}"  class="text-gray-400 hover:text-white transition">{{ __('messages.footer_governance') }}</a></li>
                        <li><a href="{{ route('frontend.sifa') }}"     class="text-gray-400 hover:text-white transition">{{ __('messages.footer_qualifications') }}</a></li>
                        <li><a href="{{ route('frontend.mahitaji') }}" class="text-gray-400 hover:text-white transition">{{ __('messages.footer_requirements') }}</a></li>
                        <li><a href="{{ route('apply.start') }}"       class="text-gray-400 hover:text-white transition">{{ __('messages.footer_apply_link') }}</a></li>
                        <li><a href="{{ route('frontend.habari') }}"   class="text-gray-400 hover:text-white transition">{{ __('messages.footer_gallery_link') }}</a></li>
                    </ul>
                </div>
                
                <!-- Contact -->
                <div>
                    <h4 class="font-bold text-lg mb-4">{{ __('messages.footer_contact') }}</h4>
                    <ul class="space-y-3">
                        <li class="flex items-start">
                            <i class="fas fa-map-marker-alt mt-1 mr-3 text-light-blue"></i>
                            <span class="text-gray-400">Kigamboni FDC<br>Plot No. Kigamboni Geza Ulole Road<br>Kigamboni Area<br>S.L.P. 20499<br>Dar es Salaam, Tanzania</span>
                        </li>
                        <li class="flex items-center">
                            <i class="fas fa-phone mr-3 text-light-blue"></i>
                            <span class="text-gray-400">+255 625 771 393</span>
                        </li>
                        <li class="flex items-center">
                            <i class="fas fa-phone mr-3 text-light-blue"></i>
                            <span class="text-gray-400">+255 717 685 138</span>
                        </li>
                        <li class="flex items-center">
                            <i class="fab fa-whatsapp mr-3 text-light-blue"></i>
                            <span class="text-gray-400">+255 717 685 138</span>
                        </li>
                    </ul>
                </div>
            </div>
            
            <!-- Bottom Bar -->
            <div class="border-t border-gray-800 py-6">
                <div class="flex flex-col md:flex-row justify-between items-center">
                    <p class="text-gray-400 text-sm">&copy; 2026 KIGAMBONI FDC. {{ __('messages.footer_copyright') }}</p>
                    <div class="flex space-x-6 mt-4 md:mt-0">
                        <a href="{{ route('frontend.faragha') }}"  class="text-gray-400 hover:text-white text-sm transition">{{ __('messages.footer_privacy') }}</a>
                        <a href="{{ route('frontend.vidakuzi') }}" class="text-gray-400 hover:text-white text-sm transition">{{ __('messages.footer_cookies') }}</a>
                        <a href="{{ route('frontend.masharti') }}" class="text-gray-400 hover:text-white text-sm transition">{{ __('messages.footer_terms') }}</a>
                    </div>
                </div>
            </div>
                </div>
            </div>
        </div>
    </footer>

    <!-- JavaScript -->
    <script>
        // Search Overlay
        const searchBtn = document.getElementById('searchBtn');
        const searchOverlay = document.getElementById('searchOverlay');
        const closeSearch = document.getElementById('closeSearch');
        
        searchBtn.addEventListener('click', () => {
            searchOverlay.classList.add('active');
        });
        
        closeSearch.addEventListener('click', () => {
            searchOverlay.classList.remove('active');
        });
        
        searchOverlay.addEventListener('click', (e) => {
            if (e.target === searchOverlay) {
                searchOverlay.classList.remove('active');
            }
        });
        
        // Mobile Menu (kept for backward compatibility)
        const mobileMenuBtn = document.getElementById('mobileMenuBtn');
        const mobileMenu = document.getElementById('mobileMenu');
        const closeMobileMenu = document.getElementById('closeMobileMenu');
        
        if (mobileMenuBtn) {
            mobileMenuBtn.addEventListener('click', () => {
                mobileMenu.classList.add('active');
            });
        }
        
        if (closeMobileMenu) {
            closeMobileMenu.addEventListener('click', () => {
                mobileMenu.classList.remove('active');
            });
        }
        
        // Navbar scroll effect
        const navbar = document.querySelector('nav');
        
        window.addEventListener('scroll', () => {
            if (window.scrollY > 100) {
                navbar.classList.add('shadow-lg');
            } else {
                navbar.classList.remove('shadow-lg');
            }
        });
        
        // Smooth scroll for anchor links
        document.querySelectorAll('a[href^="#"]').forEach(anchor => {
            anchor.addEventListener('click', function(e) {
                e.preventDefault();
                const target = document.querySelector(this.getAttribute('href'));
                if (target) {
                    target.scrollIntoView({
                        behavior: 'smooth',
                        block: 'start'
                    });
                }
            });
        });
        
        // Animate stats on scroll
        const stats = document.querySelectorAll('.stat-counter');
        
        const observerOptions = {
            threshold: 0.5
        };
        
        const observer = new IntersectionObserver((entries) => {
            entries.forEach(entry => {
                if (entry.isIntersecting) {
                    entry.target.classList.add('stat-counter');
                }
            });
        }, observerOptions);
        
        stats.forEach(stat => {
            observer.observe(stat);
        });
        
        // Right Drawer Functionality
        const rightDrawerBtn = document.getElementById('rightDrawerBtn');
        const rightDrawer = document.getElementById('rightDrawer');
        const closeRightDrawer = document.getElementById('closeRightDrawer');
        const drawerOverlay = document.getElementById('drawerOverlay');
        
        rightDrawerBtn.addEventListener('click', () => {
            rightDrawer.classList.remove('translate-x-full');
            drawerOverlay.classList.remove('hidden');
            document.body.classList.add('overflow-hidden');
        });
        
        closeRightDrawer.addEventListener('click', () => {
            rightDrawer.classList.add('translate-x-full');
            drawerOverlay.classList.add('hidden');
            document.body.classList.remove('overflow-hidden');
        });
        
        drawerOverlay.addEventListener('click', () => {
            rightDrawer.classList.add('translate-x-full');
            drawerOverlay.classList.add('hidden');
            document.body.classList.remove('overflow-hidden');
        });
        
        // Language Switching
        const translations = {
            en: {
                // Top bar
                whereToBuy: "Where to Buy",
                contactUs: "Contact Us",
                // Navigation
                products: "Products",
                solutions: "Solutions",
                sustainability: "Sustainability",
                tools: "Tools",
                training: "Training",
                aboutUs: "About Us",
                allProductLines: "All Product Lines",
                searchProducts: "Search Products",
                popularInTanzania: "Popular in Tanzania",
                productLibrary: "Product Library",
                residential: "Residential",
                commercial: "Commercial",
                infrastructure: "Infrastructure",
                industrial: "Industrial",
                hospitality: "Hospitality",
                groutCalculator: "Grout Calculator",
                productSelector: "Product Selector",
                cadSpecs: "CAD/Specs",
                // Hero
                buildingTanzania: "Building Tanzania's Future",
                heroTitle: "Building Tanzania with Excellence",
                heroDesc: "Your trusted partner for premium adhesives, sealants, and construction chemicals across Tanzania and East Africa. Over 90 years of global excellence, now closer to you.",
                exploreProducts: "Explore Products",
                watchVideo: "Watch Video",
                // Stats
                yearsGlobal: "Years Global Experience",
                yearsTanzania: "Years in Tanzania",
                projectsCompleted: "Projects Completed",
                localPartners: "Local Partners",
                // Products
                ourSolutions: "Our Solutions",
                productCategories: "Product Categories",
                productCategoriesDesc: "Comprehensive range of products for every construction need",
                tileStone: "Tile & Stone Installation",
                tileStoneDesc: "Professional adhesives for homes & businesses across Tanzania",
                waterproofing: "Waterproofing",
                waterproofingDesc: "Tropical climate solutions for lasting protection",
                floorCoverings: "Floor Coverings",
                floorCoveringsDesc: "Quality adhesives for all floor types",
                concreteRepair: "Concrete Repair",
                concreteRepairDesc: "Strong & durable restoration solutions",
                viewAllProducts: "View All Products",
                // Solutions
                eastAfricaOps: "East Africa Operations",
                tailoredSolutions: "Tailored Solutions for Tanzania",
                solutionsDesc: "From Dar es Salaam to Arusha, KIGAMBONI FDC delivers innovative educational programs backed by decades of experience. We understand East African educational needs & development challenges.",
                publicWorks: "Public Works",
                // Featured
                popularTanzania: "Popular in Tanzania",
                featuredProducts: "Featured Products",
                bestSeller: "Best Seller",
                tropical: "Tropical",
                viewDetails: "View Details",
                // Sustainability
                sustainabilityTitle: "Building a Sustainable Tanzania",
                sustainabilityDesc: "KIGAMBONI FDC is committed to sustainable development in East Africa. Our programs are designed to empower communities and minimize educational gaps while being specifically tailored for local needs.",
                ecoFriendly: "Eco-Friendly",
                ecoFriendlyDesc: "Low-VOC formulations suitable for East African environment",
                localSupport: "Local Support",
                localSupportDesc: "Training & jobs for local communities",
                co2Offset: "CO2 Offset",
                co2OffsetDesc: "Carbon-neutral products available",
                learnSustainability: "Learn About Our Sustainability",
                // Tools
                toolsResources: "Tools & Resources",
                professionalTools: "Professional Tools",
                technicalDocs: "Technical Docs",
                technicalDocsDesc: "TDS & SDS in Swahili available",
                kigamboniFdcApp: "KIGAMBONI FDC App",
                kigamboniFdcAppDesc: "Product info on the go",
                // CTA
                readyProject: "Ready to Start Your Project?",
                ctaDesc: "Contact our Tanzania team for product recommendations and technical support",
                findDistributor: "Find a Distributor",
                whatsapp: "WhatsApp",
                // News
                latestUpdates: "Latest Updates",
                newsFromTanzania: "News from Tanzania",
                // Footer
                companyName: "Kigamboni FDC",
                companyTagline: "Ujuzi ni Ajira",
                authorizedDistributor: "Official KIGAMBONI FDC Partner in Tanzania",
                director: "Director",
                quickLinks: "Quick Links",
                productLinks: "Products",
                tileInstallation: "Tile Installation",
                // Contact footer
                contactTanzania: "Contact Tanzania",
                // Bottom
                rightsReserved: "All rights reserved.",
                privacyPolicy: "Privacy Policy",
                cookiePolicy: "Cookie Policy",
                termsOfUse: "Terms of Use",
            },
            sw: {
                // Top bar
                whereToBuy: "Nunua Hapa",
                contactUs: "Wasiliana Nasi",
                // Navigation
                products: "Bidhaa",
                solutions: "Suluhisho",
                sustainability: "Uendelevu",
                tools: "Zana",
                training: "Mafunzo",
                aboutUs: "Kuhusu Sisi",
                allProductLines: "Mistari Yote ya Bidhaa",
                searchProducts: "Tafuta Bidhaa",
                popularInTanzania: "Maarufu Tanzania",
                productLibrary: "Maktaba ya Bidhaa",
                residential: "Makazi",
                commercial: "Biashara",
                infrastructure: "Miundombinu",
                industrial: "Viwanda",
                hospitality: "Hoteli",
                groutCalculator: "Kokotoa ya Grout",
                productSelector: "Chagua Bidhaa",
                cadSpecs: "CAD/Maelezo",
                // Hero
                buildingTanzania: "Kujenga Mustakabali wa Tanzania",
                heroTitle: "Kujenga Tanzania kwa Ubora",
                heroDesc: "Mshirika wako wa kuthaminiwa kwa vyenzo vya kuunganisha,密封 na kemikali za ujenzi Tanzania na Afrika Mashariki. Zaidi ya miaka 90 ya ubora wa kimataifa, sasa karibu nawe.",
                exploreProducts: "Tazama Bidhaa",
                watchVideo: "Tazama Video",
                // Stats
                yearsGlobal: "Miaka ya Uchuzi wa Kimataifa",
                yearsTanzania: "Miaka Tanzania",
                projectsCompleted: "Miradi Iliyokamilika",
                localPartners: "Washirika Wa Karibu",
                // Products
                ourSolutions: "Suluhisho Zetu",
                productCategories: "Aina za Bidhaa",
                productCategoriesDesc: "Seti kamili ya bidhaa kwa kila hitaji la ujenzi",
                tileStone: "Uwekaji wa Tile & Mawe",
                tileStoneDesc: "Vyenzo vya kuunganisha vya kitaaluma kwa nyumba na biashara Tanzania",
                waterproofing: "Kuzuia Maji",
                waterproofingDesc: "Suluhisho la hali ya hewa ya kitropiki kwa kinga endelevu",
                floorCoverings: "Vigae vya Sakafu",
                floorCoveringsDesc: "Vyenzo vya ubora kwa aina zote za sakafu",
                concreteRepair: "Ukarabati wa Betoni",
                concreteRepairDesc: "Suluhisho imara na endelevu ya ukarabati",
                viewAllProducts: "Tazama Bidhaa Zote",
                // Solutions
                eastAfricaOps: "Shughuli za Afrika Mashariki",
                tailoredSolutions: "Suluhisho Maalum kwa Tanzania",
                solutionsDesc: "Kutoka Dar es Salaam hadi Arusha, KIGAMBONI FDC huwasilisha mipango ya elimu ya ubunifu zilizokwishwa na miaka mingi ya uzoefu. tunaelewa mahitaji ya kielimu ya Afrika Mashariki na changamoto za maendeleo.",
                publicWorks: "Miradi ya Umma",
                // Featured
                popularTanzania: "Maarufu Tanzania",
                featuredProducts: "Bidhaa Zilizoangaziwa",
                bestSeller: "Biashara Bora",
                tropical: "Tropiki",
                viewDetails: "Tazama Maelezo",
                // Sustainability
                sustainabilityTitle: "Kujenga Tanzania ya Kudumu",
                sustainabilityDesc: "KIGAMBONI FDC imej_commit_ katika maendeleo endelevu Afrika Mashariki. Mipango yetu imeundwa ili kuwapa nguvu jamii na kupunguza migogoro ya kielimu huku ikibuniwa mahsusi kwa mahitaji ya ndani.",
                ecoFriendly: "Mazingira",
                ecoFriendlyDesc: "Mafomula ya chini ya VOC yanayofaa kwa mazingira ya Afrika Mashariki",
                localSupport: "Msaada wa Mahali",
                localSupportDesc: "Mafunzo na ajira kwa jamii za ndani",
                co2Offset: "Kupunguza CO2",
                co2OffsetDesc: "Bidhaa zisizotokana na kaboni zinapatikana",
                learnSustainability: "Jifu外观 ya Uendelevu wetu",
                // Tools
                toolsResources: "Zana na Rasilimali",
                professionalTools: "Zana za Kitaaluma",
                technicalDocs: "Hati za Kiufundi",
                technicalDocsDesc: "TDS & SDS kwa Kiswahili zinapatikana",
                kigamboniFdcApp: "APP ya KIGAMBONI FDC",
                kigamboniFdcAppDesc: "Maelezo ya bidhaa njiani",
                // CTA
                readyProject: "Uko Tayari Kuanza Mradi Wako?",
                ctaDesc: "Wasiliana na timu yetu ya Tanzania kwa mapendekezo ya bidhaa na usaidizi wa kiufundi",
                findDistributor: "Tafuta Msambazaji",
                whatsapp: "WhatsApp",
                // News
                latestUpdates: "Masuala Ya Hivi Karibuni",
                newsFromTanzania: "Habari kutoka Tanzania",
                // Footer
                companyName: "Silver Star",
                companyTagline: "Kutoa suluhisho endelevu",
                authorizedDistributor: "Mshirika Halali wa KIGAMBONI FDC",
                director: " Mkurugenzi",
                quickLinks: "Viungo Haraka",
                productLinks: "Bidhaa",
                tileInstallation: "Uwekaji wa Tile",
                // Contact footer
                contactTanzania: "Wasiliana Tanzania",
                // Bottom
                rightsReserved: "Haki zote zimehifadhiwa.",
                privacyPolicy: "Sera ya Faragha",
                cookiePolicy: "Sera ya Kukumbuka",
                termsOfUse: " Masharti ya Matumizi",
            }
        };

        let currentLang = 'en';

        function setLanguage(lang) {
            currentLang = lang;
            
            // Update language buttons
            const buttons = document.querySelectorAll('.language-btn');
            buttons.forEach(btn => {
                if (btn.dataset.lang === lang) {
                    btn.classList.add('text-light-blue', 'font-semibold');
                    btn.classList.remove('text-gray-500');
                } else {
                    btn.classList.remove('text-light-blue', 'font-semibold');
                    btn.classList.add('text-gray-500');
                }
            });

            // Update all translatable elements
            document.querySelectorAll('[data-en][data-sw]').forEach(el => {
                el.textContent = el.getAttribute(`data-${lang}`);
            });

            // Update menu items
            updateMenuTranslations(lang);
        }

        function updateMenuTranslations(lang) {
            const t = translations[lang];
            if (!t) return;

            // Menu items mapping
            const menuMap = {
                'menu-marine': t.marine || 'Kuhusu sisi',
                'menu-retails': t.retailsRestaurant || 'Histotia ya Kigamboni FDC',
                'menu-infrastructure': t.infrastructure || 'Infrastructures',
                'menu-sports': t.sportsFlooring || 'Sports Flooring',
                'menu-magazine': 'REALTA MAGAZINE',
                'menu-training': t.trainingSupport || 'TRAINING AND TECHNICAL SUPPORT',
                'menu-sustainability': t.sustainability || 'SUSTAINABILITY',
                'menu-tools': t.toolsDownloads || 'TOOLS AND DOWNLOADS',
                'menu-faqs': 'FAQS',
                'menu-blog': '"TECH TALK" BLOG',
                'menu-projects': t.projects || 'PROJECTS',
                'menu-about': t.aboutUs || 'ABOUT US',
                'menu-where': t.whereToBuy || 'WHERE TO BUY',
                'menu-news': 'NEWS & EVENTS',
                'menu-careers': 'CAREERS',
                'menu-contact': t.contactUs || 'CONTACT US',
            };

            Object.keys(menuMap).forEach(id => {
                const el = document.getElementById(id);
                if (el) el.textContent = menuMap[id];
            });
        }

        // Initialize language from URL params
        const urlParams = new URLSearchParams(window.location.search);
        const urlLang = urlParams.get('lang');
        if (urlLang && (urlLang === 'en' || urlLang === 'sw')) {
            setLanguage(urlLang);
        }
    </script>
    <!-- Updated Floating Sidebar with Tailwind Tooltips -->
    <div class="floating-social">
        <!-- Support -->
        <div class="group relative">
            <a href="#" class="social-btn">
                <i class="fas fa-headset" style="color:#ffffff !important; font-size:20px;"></i>
            </a>
            <span class="absolute right-14 top-1/2 -translate-y-1/2 scale-0 group-hover:scale-100 transition-all duration-200 origin-right bg-[#4ca8cd]/90 text-white px-4 py-2 rounded-lg text-sm whitespace-nowrap shadow-lg">Tafuta</span>
        </div>
        
        <!-- Chat -->
        <div class="group relative">
            <a href="#" class="social-btn">
                <i class="fas fa-comment" style="color:#ffffff !important; font-size:20px;"></i>
            </a>
            <span class="absolute right-14 top-1/2 -translate-y-1/2 scale-0 group-hover:scale-100 transition-all duration-200 origin-right bg-[#4ca8cd]/90 text-white px-4 py-2 rounded-lg text-sm whitespace-nowrap shadow-lg">Chat</span>
        </div>
        
        <!-- Kiswahili (TZ) -->
        <div class="group relative">
            <a href="{{ url('change-language/sw') }}" class="social-btn" style="text-decoration:none; padding:3px;">
                <span style="display:flex; align-items:center; justify-content:center; width:100%; height:100%; border-radius:50%; border:2px solid rgba(255,255,255,0.7); overflow:hidden; transition:border-color 0.2s ease;">
                    <img src="{{ asset('frontend_assets/img/tzflag.webp') }}" alt="Kiswahili" class="h-full w-full object-cover transition-transform duration-200 group-hover:scale-110">
                </span>
            </a>
            <span class="absolute right-14 top-1/2 -translate-y-1/2 scale-0 group-hover:scale-100 transition-all duration-200 origin-right bg-[#4ca8cd]/90 text-white px-4 py-2 rounded-lg text-sm whitespace-nowrap shadow-lg">Kiswahili</span>
        </div>
        
        <!-- English (GB) -->
        <div class="group relative">
            <a href="{{ url('change-language/en') }}" class="social-btn" style="text-decoration:none; padding:3px;">
                <span style="display:flex; align-items:center; justify-content:center; width:100%; height:100%; border-radius:50%; border:2px solid rgba(255,255,255,0.7); overflow:hidden; transition:border-color 0.2s ease;">
                    <img src="{{ asset('frontend_assets/img/gbflag.webp') }}" alt="English" class="h-full w-full object-cover transition-transform duration-200 group-hover:scale-110">
                </span>
            </a>
            <span class="absolute right-14 top-1/2 -translate-y-1/2 scale-0 group-hover:scale-100 transition-all duration-200 origin-right bg-[#4ca8cd]/90 text-white px-4 py-2 rounded-lg text-sm whitespace-nowrap shadow-lg">English</span>
        </div>
    </div>

    @include('frontend.partials.visitors_counter')
        <div class="floating-group">
  <a href="#" class="icon-link">
    <img src="{{ asset('frontend_assets/img/dira2050.png') }}" class="w-1/2 md:w-1/3 h-auto" alt ="Dira 2050">
</a>
</div>
    <!-- jQuery -->
    <script src="https://code.jquery.com/jquery-3.7.1.min.js"></script>

    @yield('script')

</body>
</html>
