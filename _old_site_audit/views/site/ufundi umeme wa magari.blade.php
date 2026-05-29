<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>KIGAMBONI FDC - Folk Development College & Training Institute</title>
    <script src="https://cdn.tailwindcss.com"></script>
    <link rel="stylesheet" href="https://cdnjs.cloudflare.com/ajax/libs/font-awesome/6.4.0/css/all.min.css">
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
        @import url('https://fonts.googleapis.com/css2?family=Inter:wght@300;400;500;600;700;800&display=swap');
        
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

        /* Tooltip Styles for Floating Social Icons */
        .social-tooltip {
            position: absolute;
            left: -130px;
            top: 50%;
            transform: translateY(-50%);
            background: rgba(76, 168, 205, 0.95);
            color: white;
            padding: 10px 16px;
            border-radius: 25px;
            white-space: nowrap;
            font-size: 14px;
            font-weight: 500;
            opacity: 0;
            visibility: hidden;
            transition: all 0.3s ease;
            z-index: 10001;
            box-shadow: 0 10px 30px rgba(0,0,0,0.2);
            pointer-events: none;
            min-width: 85px;
            text-align: center;
            backdrop-filter: blur(10px);
        }
        .social-btn:hover .social-tooltip {
            opacity: 1;
            visibility: visible;
            animation: tooltipSlide 0.25s ease-out;
        }
        @keyframes tooltipSlide {
            0% { transform: translateY(-50%) translateX(-10px); opacity: 0; }
            100% { transform: translateY(-50%) translateX(0); opacity: 1; }
        }
        .social-tooltip::after {
            content: '';
            position: absolute;
            right: -8px;
            top: 50%;
            transform: translateY(-50%);
            width: 0;
            height: 0;
            border-top: 8px solid transparent;
            border-bottom: 8px solid transparent;
            border-left: 10px solid rgba(76, 168, 205, 0.92);
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
            background: #FAEE03; /* Bright yellow from your image */
            border-radius: 50%;
            Position:relative;
            display: flex;
            align-items: center;
            justify-content: center;
            box-shadow: 0 4px 10px rgba(0,0,0,0.2); /* Slightly deeper shadow */
            transition: all 0.2s ease-in-out;
            text-decoration: none;
            overflow: hidden; /* Keeps flags inside the circle */
        }


        .social-btn:hover {
            transform: scale(1.1);
            filter: brightness(1.1);
        }

        .social-btn i {
            color: #333; /* Dark gray icons */
            font-size: 18px;
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
    

    <!-- Top Bar -->
    <div class="bg-gradient-to-r from-light-blue to-ocean-blue text-white text-sm py-2">
        <div class="container mx-auto px-4 flex justify-between items-center">
            <div class="flex items-center space-x-6">
                <span><i class="fas fa-map-marker-alt mr-2"></i>Tanzania</span>
                <span><i class="fas fa-phone mr-2"></i>+255 625 771 393</span>
            </div>
            <div class="flex items-center space-x-4">
                <a href="#" class="hover:text-yellow-300 transition" data-en="Where to Buy" data-sw="Nunua Hapa">Ratiba ya Chuo</a>
                <a href="#" class="hover:text-yellow-300 transition" data-en="Where to Buy" data-sw="Nunua Hapa">|</a>
                <a href="#" class="hover:text-yellow-300 transition" data-en="Where to Buy" data-sw="Nunua Hapa">Wahitimu</a>
                <a href="#" class="hover:text-yellow-300 transition" data-en="Where to Buy" data-sw="Nunua Hapa">|</a>
                <a href="#" class="hover:text-yellow-300 transition" data-en="Contact Us" data-sw="Wasiliana Nasi">Contact Us</a>
                <a href="https://www.facebook.com/profile.php?id=61555114508301" target="_blank" class="hover:text-yellow-300 transition"><i class="fab fa-facebook"></i></a>
                <a href="https://www.instagram.com/kigambonifdc/" target="_blank" class="hover:text-yellow-300 transition"><i class="fab fa-instagram"></i></a>
                <a href="https://wa.me" target="_blank" class="hover:text-yellow-300 transition"><i class="fab fa-whatsapp"></i></a>
            </div>
        </div>
    </div>

    <!-- Navigation -->
    <nav class="bg-white shadow-lg sticky top-0 z-50 border-b-4 border-light-blue">
        <div class="container mx-auto px-4">
            <div class="flex justify-between items-center py-4">
                <!-- Logo -->
                <a href="#" class="flex items-center">
                    <img src="{{ asset('nembotaifa.webp') }}" alt="KIGAMBONI FDC" class="h-20 w-auto">
                </a>
                
                <!-- Desktop Menu -->
                <div class="hidden lg:flex items-center space-x-8">
                    <a href="{{ url ('/') }}" class="nav-link font-bold text-gray-700 hover:text-dark-blue transition" data-en="Programs" data-sw="Mipango">Mwanzo</a>
                    <div class="dropdown relative">
                        <a href="#" class="nav-link font-bold text-gray-700 hover:text-light-blue transition" data-en="Programs" data-sw="Mipango">Kuhusu sisi</a>
                        <div class="dropdown-menu absolute left-0 top-full bg-white shadow-xl rounded-lg mt-2 py-4 w-64">
                            <a href="{{ url ('/historia') }}" class="block px-4 py-2 hover:bg-gray-50 hover:text-light-blue" data-en="All Program Areas" data-sw="Maeneo Yote ya Mipango">Historia</a>
                            <a href="{{ url ('/maono na dhamira') }}" class="block px-4 py-2 hover:bg-gray-50 hover:text-light-blue" data-en="Browse Programs" data-sw="Tazama Mipango">Maono na dhamira</a>
                            <a href="{{ url ('/utawala') }}" class="block px-4 py-2 hover:bg-gray-50 hover:text-light-blue" data-en="Popular in Tanzania" data-sw="Maarufu Tanzania">Utawala</a>
                        </div>
                    </div>
                    <div class="dropdown relative">
                        <a href="#" class="nav-link font-bold text-gray-700 hover:text-light-blue transition" data-en="Services" data-sw="Huduma">Kozi zinazotolewa</a>
                        <div class="dropdown-menu absolute left-0 top-full bg-white shadow-xl rounded-lg mt-2 py-4 w-64">
                            <a href="{{ url ('/kozi za muda mrefu') }}" class="block px-4 py-2 hover:bg-gray-50 hover:text-light-blue" data-en="Residential" data-sw="Makazi">Kozi za Muda Mrefu</a>
                            <a href="{{ url ('/kozi za muda mfupi') }}" class="block px-4 py-2 hover:bg-gray-50 hover:text-light-blue" data-en="Commercial" data-sw="Biashara">Kozi za Muda Mfupi</a>
                        </div>
                    </div>
                    <div class="dropdown relative">
                        <a href="#" class="nav-link font-bold text-gray-700 hover:text-light-blue transition" data-en="Tools" data-sw="Zana">Kujiunga na chuo </a>
                        <div class="dropdown-menu absolute left-0 top-full bg-white shadow-xl rounded-lg mt-2 py-4 w-64">
                            <a href="{{ url ('/sifa za muombaji') }}" class="block px-4 py-2 hover:bg-gray-50 hover:text-light-blue" data-en="Infrastructure" data-sw="Miundombinu">Sifa za Muombaji</a>
                            <a href="{{ url ('/mahitaji ya kujiunga') }}" class="block px-4 py-2 hover:bg-gray-50 hover:text-light-blue" data-en="Grout Calculator" data-sw="Kokotoa ya Grout">Mahitaji ya Kujiunga</a>
                            <a href="{{ url ('/hatua za kujiunga') }}" class="block px-4 py-2 hover:bg-gray-50 hover:text-light-blue" data-en="Program Finder" data-sw="Tafuta Mipango">Hatua za Kujiunga</a>
                            <a href="{{ url ('/fomu za kujiunga') }}" class="block px-4 py-2 hover:bg-gray-50 hover:text-light-blue" data-en="CAD/Specs" data-sw="CAD/Maelezo">Fomu za Kujiunga</a>
                        </div>
                    </div>
                    <div class="dropdown relative">
                        <a href="#" class="nav-link font-bold text-gray-700 hover:text-light-blue transition" data-en="Tools" data-sw="Zana">Idara zetu</a>
                        <div class="dropdown-menu absolute left-0 top-full bg-white shadow-xl rounded-lg mt-2 py-4 w-64">
                            <a href="{{ url ('/ufundi wa magari') }}" class="block px-4 py-2 hover:bg-gray-50 hover:text-light-blue" data-en="Grout Calculator" data-sw="Kokotoa ya Grout">Ufundi wa Magari</a>
                            <a href="{{ url ('/ufundi umeme wa magari') }}" class="block px-4 py-2 hover:bg-gray-50 hover:text-light-blue" data-en="Program Finder" data-sw="Tafuta Mipango">Ufundi Umeme wa Magari</a>
                            <a href="{{ url ('/ufundi umeme wa majumbani') }}" class="block px-4 py-2 hover:bg-gray-50 hover:text-light-blue" data-en="CAD/Specs" data-sw="CAD/Maelezo">Ufundi Umeme wa Majumbani</a>
                            <a href="{{ url ('/uchomeleaji na uungaji vyuma') }}" class="block px-4 py-2 hover:bg-gray-50 hover:text-light-blue" data-en="CAD/Specs" data-sw="CAD/Maelezo">Uchomeleaji na uungaji vyuma</a>
                            <a href="{{ url ('/ufundi bomba') }}" class="block px-4 py-2 hover:bg-gray-50 hover:text-light-blue" data-en="CAD/Specs" data-sw="CAD/Maelezo">Ufundi bomba</a>
                            <a href="{{ url ('/ushonaji') }}" class="block px-4 py-2 hover:bg-gray-50 hover:text-light-blue" data-en="CAD/Specs" data-sw="CAD/Maelezo">Ushonaji</a>
                            <a href="{{ url ('/ufundi uashi') }}" class="block px-4 py-2 hover:bg-gray-50 hover:text-light-blue" data-en="CAD/Specs" data-sw="CAD/Maelezo">Ufundi Uashi</a>
                            <a href="{{ url ('/technolojia ya habari na mawasiliano') }}" class="block px-4 py-2 hover:bg-gray-50 hover:text-light-blue" data-en="CAD/Specs" data-sw="CAD/Maelezo">Teknolojia ya Habari na Mawasiliano</a>



                        </div>
                    </div>
                    <div class="dropdown relative">
                        <a href="#" class="nav-link font-bold text-gray-700 hover:text-light-blue transition" data-en="Tools" data-sw="Zana">Maisha chuoni </a>
                        <div class="dropdown-menu absolute left-0 top-full bg-white shadow-xl rounded-lg mt-2 py-4 w-64">
                            <a href="{{ url ('/uongozi wa wanafunzi') }}" class="block px-4 py-2 hover:bg-gray-50 hover:text-light-blue" data-en="Grout Calculator" data-sw="Kokotoa ya Grout">Uongozi wa wanafunzi</a>
                            <a href="{{ url ('/sheria ndogo za wanafunzi') }}" class="block px-4 py-2 hover:bg-gray-50 hover:text-light-blue" data-en="Program Finder" data-sw="Tafuta Mipango">Sheria ndogo za wanafunzi</a>
                            <a href="{{ url ('/malazi') }}" class="block px-4 py-2 hover:bg-gray-50 hover:text-light-blue" data-en="CAD/Specs" data-sw="CAD/Maelezo">Malazi</a>
                            <a href="{{ url ('/michezo na burudani') }}" class="block px-4 py-2 hover:bg-gray-50 hover:text-light-blue" data-en="CAD/Specs" data-sw="CAD/Maelezo">Michezo na burudani</a>
                        </div>
                    </div>
                    <a href="{{ url ('/habari picha') }}" class="nav-link font-bold text-gray-700 hover:text-light-blue transition" data-en="Programs" data-sw="Mipango">Habari Picha</a>
                    <a href="{{ url ('/wafanyakazi') }}" class="nav-link font-bold text-gray-700 hover:text-light-blue transition" data-en="Programs" data-sw="Mipango">Wafanyakazi</a>
                    <a href="{{ url ('/wasiliana nasi') }}" class="nav-link font-bold text-gray-700 hover:text-light-blue transition" data-en="About Us" data-sw="Kuhusu Sisi">Wasiliana nasi</a>
                </div>
                <!-- Logo -->
                <a href="#" class="flex items-center">
                    <img src="{{ asset('FDClogonow.webp') }}" alt="fdc logo" class="h-20 w-auto">
                </a>
                <!-- Search & Mobile Toggle -->
                <div class="flex items-center space-x-4">
                    <button id="searchBtn" class="text-gray-700 hover:text-light-blue transition">
                        <i class="fas fa-search text-lg"></i>
                    </button>
                    <button id="rightDrawerBtn" class="text-gray-700 hover:text-light-blue transition">
                        <i class="fas fa-bars text-xl"></i>
                    </button>
                </div>
            </div>
        </div>
        
        <!-- Search Overlay -->
        <div id="searchOverlay" class="search-overlay fixed inset-0 bg-black bg-opacity-95 z-50 flex items-center justify-center">
            <div class="container mx-auto px-4">
                <div class="max-w-3xl mx-auto">
                    <div class="flex justify-end">
                        <button id="closeSearch" class="text-white text-3xl">&times;</button>
                    </div>
                    <input type="text" placeholder="Tafuta programu, kozi, Taarifa..." 
                           class="w-full bg-transparent border-b-2 border-white text-white text-2xl py-4 focus:outline-none focus:border-light-blue">
                    <div class="mt-8 flex flex-wrap gap-3">
                        <span class="text-gray-400">Maarufu:</span>
                        <a href="#" class="text-white bg-gray-800 px-3 py-1 rounded-full text-sm hover:bg-light-blue">Kuhusu sisi</a>
                        <a href="#" class="text-white bg-gray-800 px-3 py-1 rounded-full text-sm hover:bg-light-blue">Kozi za Muda Mrefu</a>
                        <a href="#" class="text-white bg-gray-800 px-3 py-1 rounded-full text-sm hover:bg-light-blue">Kozi za Muda Mfupi</a>
                        <a href="#" class="text-white bg-gray-800 px-3 py-1 rounded-full text-sm hover:bg-light-blue">Kujiuga na Chuo</a>
                    </div>
                </div>
            </div>
        </div>
    </nav>

    <!-- Right Drawer -->
    <div id="rightDrawer" class="right-drawer fixed inset-y-0 right-0 w-full md:w-96 bg-white shadow-2xl z-50 transform translate-x-full transition-transform duration-300 ease-in-out">
        <div class="h-full flex flex-col">
            <!-- Top Section -->
            <div class="p-4 border-b">
                <div class="flex items-center justify-between">
                    <div class="flex-1 mr-4">
                        <input type="text" placeholder="Tafuta..." 
                               class="w-full px-4 py-2 border border-gray-300 rounded-lg focus:outline-none focus:border-light-blue">
                    </div>
                    <button id="closeRightDrawer" class="text-gray-600 hover:text-light-blue text-2xl">
                        <i class="fas fa-times"></i>
                    </button>
                </div>
            </div>
            
            <!-- Logo & User Section -->
            <div class="p-4 border-b bg-gray-50">
                <div class="flex items-center justify-between">
                    <img src="{{ asset('FDClogonow.webp') }}" alt="KIGAMBONI FDC" class="h-20">
                    <div class="flex items-center space-x-4">
                        <a href="#" class="text-sm text-light-blue hover:underline">Ingia</a>
                        <div class="flex items-center space-x-2">
                            <button onclick="" class="text-sm font-medium text-light-blue hover:underline language-btn" data-lang="en">EN</button>
                            <span class="text-gray-400">|</span>
                            <button onclick="" class="text-sm text-gray-500 hover:text-light-blue hover:underline language-btn" data-lang="sw">SW</button>
                        </div>
                    </div>
                </div>
            </div>
            
            <!-- Menu Items -->
            <div class="flex-1 overflow-y-auto">
                <nav class="py-2">
                    <a href="#" class="block px-6 py-3 text-gray-700 hover:bg-light-blue hover:text-white transition border-b border-gray-100">
                        Mwanzo
                    </a>
                    <a href="#" class="block px-6 py-3 text-gray-700 hover:bg-light-blue hover:text-white transition border-b border-gray-100">
                        Historia ya Kigamboni FDC
                    </a>
                    <a href="#" class="block px-6 py-3 text-gray-700 hover:bg-light-blue hover:text-white transition border-b border-gray-100">
                        Maono na dhamira
                    </a>
                    <a href="#" class="block px-6 py-3 text-gray-700 hover:bg-light-blue hover:text-white transition border-b border-gray-100">
                        Utawala
                    </a>
                    <a href="#" class="block px-6 py-3 text-gray-700 hover:bg-light-blue hover:text-white transition border-b border-gray-100 font-semibold">
                        KOZI ZA MUDA MREFU
                    </a>
                    <a href="#" class="block px-6 py-3 text-gray-700 hover:bg-light-blue hover:text-white transition border-b border-gray-100">
                        KOZI ZA MUDA MFUPI
                    </a>
                    <a href="#" class="block px-6 py-3 text-gray-700 hover:bg-light-blue hover:text-white transition border-b border-gray-100">
                        SIFA ZA MUOMBAJI
                    </a>
                    <a href="#" class="block px-6 py-3 text-gray-700 hover:bg-light-blue hover:text-white transition border-b border-gray-100">
                        MAHITAJI YA KUJIUNGA
                    </a>
                    <a href="#" class="block px-6 py-3 text-gray-700 hover:bg-light-blue hover:text-white transition border-b border-gray-100">
                        FOMU YA KUJIUNGA
                    </a>
                    <a href="#" class="block px-6 py-3 text-gray-700 hover:bg-light-blue hover:text-white transition border-b border-gray-100 font-semibold">
                        UFUNDI WA MAGARI
                    </a>
                    <a href="#" class="block px-6 py-3 text-gray-700 hover:bg-light-blue hover:text-white transition border-b border-gray-100">
                        UFUNDI UMEME WA MAGARI
                    </a>
                    <a href="#" class="block px-6 py-3 text-gray-700 hover:bg-light-blue hover:text-white transition border-b border-gray-100">
                        UFUNDI UMEME WA MAJUMBANI
                    </a>
                    <a href="#" class="block px-6 py-3 text-gray-700 hover:bg-light-blue hover:text-white transition border-b border-gray-100">
                        UFUNDI BOMBA
                    </a>
                    <a href="#" class="block px-6 py-3 text-gray-700 hover:bg-light-blue hover:text-white transition border-b border-gray-100">
                        UFUNDI UASHI
                    </a>
                    <a href="#" class="block px-6 py-3 text-gray-700 hover:bg-light-blue hover:text-white transition border-b border-gray-100">
                        TECHNOLOJIA YA HABARI NA MAWASILIANO
                    </a>
                    <a href="#" class="block px-6 py-3 text-gray-700 hover:bg-light-blue hover:text-white transition border-b border-gray-100">
                        WASILIANA NASI
                    </a>
                </nav>
            </div>
            
            <!-- Bottom Contact -->
            <div class="p-4 border-t bg-gray-50">
                <div class="text-center">
                    <p class="text-sm text-gray-600"><i class="fas fa-phone mr-2"></i>+255 625 771 393</p>
                    <p class="text-sm text-gray-600"><i class="fas fa-phone mr-2"></i>+255 717 685 138</p>
                </div>
            </div>
        </div>
    </div>

    <!-- Drawer Overlay -->
    <div id="drawerOverlay" class="fixed inset-0 bg-black bg-opacity-50 z-40 hidden"></div>

    <!-- Mobile Menu -->
    <div id="mobileMenu" class="mobile-menu fixed inset-0 bg-white z-50 lg:hidden">
        <div class="p-4">
            <div class="flex justify-between items-center mb-8">
                <div class="bg-light-blue text-white font-bold text-2xl px-3 py-1">KIGAMBONI FDC</div>
                <button id="closeMobileMenu" class="text-gray-700 text-3xl">&times;</button>
            </div>
            <div class="space-y-4">
                <a href="#" class="block py-3 border-b text-xl font-medium">Programs</a>
                <a href="#" class="block py-3 border-b text-xl font-medium">Services</a>
                <a href="#" class="block py-3 border-b text-xl font-medium">Sustainability</a>
                <a href="#" class="block py-3 border-b text-xl font-medium">Tools</a>
                <a href="#" class="block py-3 border-b text-xl font-medium">Training</a>
                <a href="#" class="block py-3 border-b text-xl font-medium">About Us</a>
                <a href="#" class="block py-3 text-xl font-medium text-light-blue">Where to Buy</a>
            </div>
        </div>
    </div>
<!-- Certificate Programs Card -->
<div class="w-[1600px] mx-auto my-10 bg-white rounded-[2rem] p-10 shadow-[0_10px_40px_rgba(0,0,0,0.08)] font-sans">
    
    <!-- Content Section -->
    <h2 class="text-2xl font-bold text-center mb-3">Ufundi Umeme wa Magari</h2>
    <p class="text-gray-500 text-sm leading-relaxed mb-6">
        .
    </p>
</div>

    <!-- CTA Section -->
    <section class="py-20 bg-gradient-to-r from-light-blue to-ocean-blue">
        <div class="container mx-auto px-4 text-center">
            <h2 class="text-4xl font-bold text-white mb-4">Je, uko tayari Kuanza Safari Yako ya Masomo?</h2>
            <p class="text-white text-xl mb-8 max-w-2xl mx-auto">        
Wasiliana nasi kwa taarifa za programu na ushauri wa wanafunzi
            </p>
            <div class="flex flex-wrap justify-center gap-4">
                <a href="#" class="bg-white text-light-blue px-8 py-4 rounded-lg font-semibold hover:bg-gray-100 transition inline-flex items-center">
                    <i class="fas fa-phone mr-2"></i> +255 717 685 138
                </a>
                <a href="#" class="border-2 border-white text-white px-8 py-4 rounded-lg font-semibold hover:bg-white hover:text-light-blue transition inline-flex items-center">
                    Tembelea Ofisini Kwetu <i class="fas fa-arrow-right ml-2"></i>
                </a>
                <a href="#" class="border-2 border-white text-white px-8 py-4 rounded-lg font-semibold hover:bg-white hover:text-light-blue transition inline-flex items-center">
                    <i class="fab fa-whatsapp mr-2"></i> WhatsApp
                </a>
            </div>
        </div>
    </section>

    <!-- News & Events -->
     
    <section class="py-20">
        <div class="container mx-auto px-4">
            <div class="text-center mb-16">
                <span class="text-light-blue font-semibold uppercase tracking-wider">Taarifa Muhimu</span>
                <h2 class="text-4xl font-bold mt-2">Kutoka Kigamboni FDC</h2>
            </div>
            
            <div class="grid md:grid-cols-3 gap-8">
                <article class="news-card group">
                    <div class="relative overflow-hidden rounded-2xl mb-4">
                        <img src="{{ asset('autogarage.webp') }}" alt="News 1" 
                             class="news-image w-full h-48 object-cover transition duration-500">
                    </div>
                    <span class="text-sm text-light-blue font-medium">March 09</span>
                    <h3 class="text-xl font-bold mt-2 mb-2 group-hover:text-light-blue transition">
                        Huduma za Kitaalam za Mechanic
                    </h3>
                    <p style="text-align: justify;" class="text-gray-600">“Ubora wa Kisasa, Huduma ya Uhakika!”
Gari lako lina shida? Linatoa makelele? Linavuta upande? Halina nguvu?
Usihofu – FDC Auto Tech Garage tunarekebisha matatizo yote ya magari kwa haraka, kwa uaminifu na ubora wa hali ya juu!
Tunatoa huduma kwa aina zote za magari, tukitumia teknolojia na mashine za kisasa ili kuhakikisha gari lako linakuwa salama na imara. </p>
                </article>
                
                
                <article class="news-card group">
                    <div class="relative overflow-hidden rounded-2xl mb-4">
                        <img src="{{ asset('bomba.webp') }}" alt="News 2" 
                             class="news-image w-full h-48 object-cover transition duration-500">
                    </div>
                    <span class="text-sm text-light-blue font-medium">March 12</span>
                    <h3 class="text-xl font-bold mt-2 mb-2 group-hover:text-light-blue transition">
                        Huduma za Kitaalam za mabomba
                    </h3>
                    <p style="text-align: justify;" class="text-gray-600">Unahitaji fundi bomba wa uhakika? Karibu PPF Workshop Kigamboni tunatoa huduma zote za ufundi bomba kwa nyumba na viwandani kwa ubora na uaminifu. Huduma zetu ni pamoja na:Ufungaji wa mabomba mapya, Marekebisho ya mabomba yanayovuja, Kufunga sinki, choo na vifaa vya maji
Matengenezo ya mifumo ya maji majumbani na viwandani</p>
                </article>
                
                <article class="news-card group">
                    <div class="relative overflow-hidden rounded-2xl mb-4">
                        <img src="{{ asset('umememajumbani2.webp') }}" alt="News 3" 
                             class="news-image w-full h-48 object-cover transition duration-500">
                    </div>
                    <span class="text-sm text-light-blue font-medium">March 14</span>
                    <h3 class="text-xl font-bold mt-2 mb-2 group-hover:text-light-blue transition">
                        Huduma za Kitaalam za Umeme wa Majumbani 
                    </h3>
                    <p class="text-gray-600">Kwa Uhitaji wa huduma za ukarabati wa Umeme, Usanikishaji wa Taa, Mfumo wa Uwekaji waya/Kubadilisha waya, Mfumo wa Umeme wa Jua,Feni/AC/Mifumo ya Camera Karibu Kigamboni FDC Electrical Workshop </p>
                </article>
            </div>
        </div>
    </section>

    <!-- Footer -->
    <footer class="bg-kigamboni-dark text-white pt-16">
        <div class="container mx-auto px-4">
            <div class="grid md:grid-cols-2 lg:grid-cols-4 gap-8 mb-12">
                <!-- Company Info -->
                <div>
                    <img src="{{ asset('FDClogonow.webp') }}" alt="FDC logo" class="h-16 mb-4">
                    <p class="text-gray-400 mb-4">
                        <strong>Kigamboni FDC </strong> - Ujuzi ni Ajira<br>
                        Official Kigamboni FDC
                    </p>
                    <p class="text-gray-500 text-sm mb-2">
                        <strong>Eng. R.S.Simba</strong><br>
                        Principal
                    </p>
                    <div class="flex space-x-4">
                        <a href="https://www.facebook.com/profile.php?id=61555114508301" target="_blank" class="w-10 h-10 bg-gray-700 rounded-full flex items-center justify-center hover:bg-light-blue transition">
                            <i class="fab fa-facebook-f"></i>
                        </a>
                        <a href="https://www.instagram.com/kigambonifdc/" target="_blank" class="w-10 h-10 bg-gray-700 rounded-full flex items-center justify-center hover:bg-light-blue transition">
                            <i class="fab fa-instagram"></i>
                        </a>
                        <a href="https://wa.me" target="_blank" class="w-10 h-10 bg-gray-700 rounded-full flex items-center justify-center hover:bg-light-blue transition">
                            <i class="fab fa-whatsapp"></i>
                        </a>
                    </div>
                </div>
                
                <!-- Products -->
                <div>
                    <h4 class="font-bold text-lg mb-4">Kozi</h4>
                    <ul class="space-y-2">
                        <li><a href="#" class="text-gray-400 hover:text-white transition">Ufundi Magari</a></li>
                        <li><a href="#" class="text-gray-400 hover:text-white transition">Ufundi Umeme wa Magari</a></li>
                        <li><a href="#" class="text-gray-400 hover:text-white transition">Ufundi Umeme wa Majumbani</a></li>
                        <li><a href="#" class="text-gray-400 hover:text-white transition">Uchomeleaji na Uungaji Vyuma</a></li>
                        <li><a href="#" class="text-gray-400 hover:text-white transition">Ufundi Bomba</a></li>
                        <li><a href="#" class="text-gray-400 hover:text-white transition">ICT </a></li>
                    </ul>
                </div>
                
                <!-- Quick Links -->
                <div>
                    <h4 class="font-bold text-lg mb-4">Viungo vya Haraka</h4>
                    <ul class="space-y-2">
                        <li><a href="#" class="text-gray-400 hover:text-white transition">Ratiba ya Chuo</a></li>
                        <li><a href="#" class="text-gray-400 hover:text-white transition">Historia yetu</a></li>
                        <li><a href="#" class="text-gray-400 hover:text-white transition">Maono na dhamira</a></li>
                        <li><a href="#" class="text-gray-400 hover:text-white transition">Utawala</a></li>
                        <li><a href="#" class="text-gray-400 hover:text-white transition">Sifa za Muombaji</a></li>
                        <li><a href="#" class="text-gray-400 hover:text-white transition">Mahitaji ya Kujiunga</a></li>
                        <li><a href="#" class="text-gray-400 hover:text-white transition">Fomu za Kujiunga</a></li>
                        <li><a href="#" class="text-gray-400 hover:text-white transition">Gallery</a></li>
                    </ul>
                </div>
                
                <!-- Contact -->
                <div>
                    <h4 class="font-bold text-lg mb-4">Contact Kigamboni FDC</h4>
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
                    <p class="text-gray-400 text-sm">&copy; 2026 KIGAMBONI FDC. Haki zote zimehifadhiwa.</p>
                    <div class="flex space-x-6 mt-4 md:mt-0">
                        <a href="#" class="text-gray-400 hover:text-white text-sm transition">Sera ya faragha</a>
                        <a href="#" class="text-gray-400 hover:text-white text-sm transition">Sera ya Vidakuzi</a>
                        <a href="#" class="text-gray-400 hover:text-white text-sm transition">Masharti ya Matumizi</a>
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
        
        // Floating Social Tooltips
        document.addEventListener('DOMContentLoaded', () => {
            document.querySelectorAll('.social-btn[data-tooltip]').forEach(btn => {
                const tooltip = btn.querySelector('.social-tooltip');
                if (tooltip) {
                    tooltip.textContent = btn.dataset.tooltip;
                }
            });
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
        <!-- Tafuta/Support -->
        <div class="group relative">
            <a href="#" class="social-btn">
                <i class="fas fa-headset"></i>
            </a>
            <span class="absolute right-14 top-1/2 -translate-y-1/2 scale-0 group-hover:scale-100 transition-all duration-200 origin-right bg-[#4ca8cd]/90 text-white px-4 py-2 rounded-lg text-sm whitespace-nowrap shadow-lg">Tafuta</span>
        </div>
        
        <!-- Chat -->
        <div class="group relative">
            <a href="#" class="social-btn">
                <i class="fas fa-comment"></i>
            </a>
            <span class="absolute right-14 top-1/2 -translate-y-1/2 scale-0 group-hover:scale-100 transition-all duration-200 origin-right bg-[#4ca8cd]/90 text-white px-4 py-2 rounded-lg text-sm whitespace-nowrap shadow-lg">Chat</span>
        </div>
        
        <!-- Kiswahili (TZ) -->
        <div class="group relative">
            <a href="#" class="social-btn">
                <img src="{{ asset('tzflag.webp') }}" alt="Kiswahili" class="h-9 w-9 object-contain">
            </a>
            <span class="absolute right-14 top-1/2 -translate-y-1/2 scale-0 group-hover:scale-100 transition-all duration-200 origin-right bg-[#4ca8cd]/90 text-white px-4 py-2 rounded-lg text-sm whitespace-nowrap shadow-lg">Kiswahili</span>
        </div>
        
        <!-- English (GB) -->
        <div class="group relative">
            <a href="#" class="social-btn">
                <img src="{{ asset('gbflag.webp') }}" alt="English" class="h-9 w-9 object-contain">
            </a>
            <span class="absolute right-14 top-1/2 -translate-y-1/2 scale-0 group-hover:scale-100 transition-all duration-200 origin-right bg-[#4ca8cd]/90 text-white px-4 py-2 rounded-lg text-sm whitespace-nowrap shadow-lg">English</span>
        </div>
    </div>

        <div class="floating-group">
  <a href="#" class="icon-link">
    <img src="{{ asset('dira2050.png') }}" class="w-1/2 md:w-1/3 h-auto" alt ="Dira 2050">
</a>
</div>


</body>
</html>
