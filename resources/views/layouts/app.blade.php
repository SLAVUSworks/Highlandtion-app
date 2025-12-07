<!DOCTYPE html>
<html lang="id">
    <head>
        <meta charset="UTF-8">
        <meta name="viewport" content="width=device-width, initial-scale=1.0">
        {{-- CDN TAILWIND --}}
        {{-- <script src="https://cdn.tailwindcss.com"></script> --}}

        {{-- LOCAL TAILWIND --}}
        @vite('resources/css/app.css')

        <link rel="stylesheet" href="https://cdnjs.cloudflare.com/ajax/libs/font-awesome/6.7.1/css/all.min.css">
        <link rel="icon" type="image/x-icon" href="{{ $config['app_favicon'] }}">
        <script src="https://cdn.jsdelivr.net/npm/sweetalert2@11"></script>
        <script src="https://unpkg.com/typewriter-effect@latest/dist/core.js"></script>
        <link href="https://unpkg.com/aos@2.3.1/dist/aos.css" rel="stylesheet">
        <link rel="stylesheet" href="{{ asset('css/front.css') }}">
    
        <title>@yield('title', $config['app_name'] )</title>
    </head>

<body class="relative h-screen bg-[#8BBCCC]">
    <div class="bg-pattern"></div>

    <nav class="fixed top-0 left-0 w-full bg-gray-800 p-4 z-50 shadow-lg">
        <div class="container mx-auto flex justify-between items-center">
            <a id="top-title" href="/" class="text-white text-lg font-semibold flex items-center space-x-2">
                <img src="{{ $config['app_favicon'] }}" alt="Logo" class="w-8 mr-2">
                <span>{{ $config['app_name'] }} - IP: {{ request()->ip() }}</span>
            </a>            
            <button id="menu-toggle" class="md:hidden text-gray-300 hover:text-white focus:outline-none">
                <svg class="h-6 w-6" fill="none" stroke="currentColor" viewBox="0 0 24 24" xmlns="http://www.w3.org/2000/svg">
                    <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M4 6h16M4 12h16m-7 6h7"></path>
                </svg>
            </button>
            <div id="menu" class="hidden md:flex space-x-4">
                <a href="/" class="text-gray-300 hover:text-white px-3 py-2 rounded-md text-sm font-medium">Laman Utama</a>
            </div>
        </div>
        <div id="mobile-menu" class="hidden md:hidden mt-2 space-y-2">
            <a href="/" class="block text-gray-300 hover:text-white px-3 py-2 rounded-md text-sm font-medium">Laman Utama</a>
        </div>
    </nav>

    <section class="min-h-screen mt-[4rem] text-center xl:px-0 flex flex-col justify-center">
        @yield('content')
    </section>

    <footer class="bg-gray-800 text-white py-8 rounded-t-3xl" data-aos="fade-up">
        <div class="container mx-auto">
            <div class="grid grid-cols-1 md:grid-cols-3 gap-4">
                <div>
                    <h3 class="text-2xl font-semibold">{{ $config['app_name'] }}</h3>
                    <p class="text-xl text-justify">{{ $config['app_description'] }}</p>
                </div>
                <div>
                    <h3 class="text-2xl font-semibold">Alamat</h3>
                    <div class="mapouter">
                        <div class="gmap_canvas">
                            <iframe width="100%" height="150" id="gmap_canvas" 
                                src="https://maps.google.com/maps?q=sman%201%20bukittinggi&t=&z=13&ie=UTF8&iwloc=&output=embed"
                                frameborder="0" scrolling="no" marginheight="0" marginwidth="0"></iframe>
                        </div>
                    </div>
                </div>
                <div>
                    <h3 class="text-2xl font-semibold">Kontak</h3>
                    <p class="text-xl">{{ $config['footer-contact'] }}</p>
                </div>
            </div>

            <div class="grid grid-cols-1 sm:grid-cols-3 gap-4 mt-8 justify-items-center text-center">
                <img src="https://github.com/SLAVUSworks/HL-Web-ICON/blob/master/mpk.png?raw=true" alt="MPK"
                     class="w-24 h-24 object-contain mx-auto">
                <img src="https://github.com/SLAVUSworks/HL-Web-ICON/blob/master/smansa.png?raw=true" alt="SMAN1BKT"
                     class="w-24 h-24 object-contain mx-auto">
                <img src="https://github.com/SLAVUSworks/HL-Web-ICON/blob/master/osis.PNG?raw=true" alt="OSIS"
                     class="w-24 h-24 object-contain mx-auto">
            </div>

            <div class="flex justify-end items-center mt-8">
                <p class="text-sm text-right">HL-Web App n Booking System v2.12<br>
                    <small class="text-base">Made & maintained by 
                        <a href="https://github.com/SLAVUSworks" target="_blank" rel="noopener noreferrer" class="text-blue-400">SLAVUSworks</a>
                    </small>
                </p>
                <img src="https://github.com/SLAVUSworks/HL-Web-ICON/blob/master/slavusworks.png?raw=true" 
                     alt="SLAVUSworks" class="w-12 h-12 ml-2">
            </div>
        </div>
    </footer>
</body>
</html>

<script src="https://cdn.jsdelivr.net/npm/aos@2.3.4/dist/aos.js"></script>
<script>
    document.addEventListener('DOMContentLoaded', () => {
        AOS.init({
            duration: 1000,
            once: true,
        });
    });
</script>
<script>
    document.getElementById('menu-toggle').addEventListener('click', function () {
        const mobileMenu = document.getElementById('mobile-menu');
        if (mobileMenu.classList.contains('hidden')) {
            mobileMenu.classList.remove('hidden');
        } else {
            mobileMenu.classList.add('hidden');
        }
    });
</script>
</body>
</html>