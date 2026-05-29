<!DOCTYPE html>
<html lang="{{ str_replace('_', '-', app()->getLocale()) }}">
    <head>
       <meta charset="utf-8">
    <meta name="viewport" content="width=device-width, initial-scale=1">
    <title>Kigamboni FDC - Usajili</title>

    <!-- Fonts -->
    <link rel="preconnect" href="https://bunny.net">
    <link href="https://bunny.net/css?family=figtree:400,500,600&display=swap" rel="stylesheet" />

    <!-- Link ya Tailwind (Hii ni muhimu sana, nimeiongezea 'cdn') -->
    <script src="https://cdn.tailwindcss.com"></script>
    
    <script>
        tailwind.config = {
            theme: {
                extend: {
                    colors: {
                        'kigamboni-red': '#E31E24',
                        'ocean-blue': '#4ca8cd',
                    }
                }
            }
        }
    </script>

    </head>
    <body class="font-sans text-gray-900 antialiased bg-[#f0f9ff]"> <!-- Rangi ya background iliyofifia -->
    <div class="min-h-screen flex flex-col sm:justify-center items-center pt-6 sm:pt-0">
        <div>
            <a href="/">
                <!-- Hapa tumeweka maandishi yenye rangi zako badala ya logo ya Laravel -->
                <h1 class="text-3xl font-black tracking-tighter">
                    <span class="text-kigamboni-red">KIGAMBONI</span> 
                    <span class="text-ocean-blue">FDC</span>
                </h1>
            </a>
        </div>

        <!-- Tumeongeza border ya Ocean Blue juu ya box -->
        <div class="w-full sm:max-w-md mt-6 px-6 py-8 bg-white shadow-xl overflow-hidden sm:rounded-lg border-t-4 border-ocean-blue">
            {{ $slot }}
        </div>
    </div>
</body>

</html>
