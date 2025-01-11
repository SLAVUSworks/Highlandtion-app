<!DOCTYPE html>
<html lang="en">
    <head>
        <meta charset="UTF-8">
        <meta name="viewport" content="width=device-width, initial-scale=1.0">
        <script src="https://cdn.tailwindcss.com"></script>
        <link rel="stylesheet" href="https://cdnjs.cloudflare.com/ajax/libs/font-awesome/6.7.1/css/all.min.css" integrity="sha512-5Hs3dF2AEPkpNAR7UiOHba+lRSJNeM2ECkwxUIxC1Q/FLycGTbNapWXB4tP889k5T5Ju8fs4b1P5z/iB4nMfSQ==" crossorigin="anonymous" referrerpolicy="no-referrer" />
        <link rel="icon" type="image/x-icon" href="{{ $config['app_favicon'] }}">
        <script src="https://unpkg.com/typewriter-effect@latest/dist/core.js"></script>
        <link rel="stylesheet" href="{{ asset('css/front.css') }}">
    
        <title>@yield('title', 'Highlandtion')</title>
    </head>

<body>
    <nav class="bg-gray-800 p-4">
        <div class="container mx-auto flex justify-between items-center">
            <a href="/" class="text-white text-lg font-semibold">{{ $config['app_name'] }}</a>
            <div>
                <a href="#" class="text-gray-300 hover:text-white px-3 py-2 rounded-md text-sm font-medium">Home</a>
                <a href="#" class="text-gray-300 hover:text-white px-3 py-2 rounded-md text-sm font-medium">About</a>
                <a href="#" class="text-gray-300 hover:text-white px-3 py-2 rounded-md text-sm font-medium">Contact</a>
            </div>
        </div>
    </nav>
    @yield('content')
    <section class="min-h-screen text-center py-20 px-8 xl:px-0 flex flex-col justify-center">
    

    </section>
<footer class="bg-gray-800 text-white py-8">
    <div class="container mx-auto">
        <div class="grid grid-cols-1 md:grid-cols-3 gap-4">
            <div>
                <h3 class="text-2xl font-semibold">{{ $config['app_name'] }}</h3>
                <p class="text-xl text-justify">{{ $config['app_description'] }}</p>
            </div>
            <div>
                <h3 class="text-2xl font-semibold">Alamat</h3>
                <div class="mapouter"><div class="gmap_canvas"><iframe width="400" height="150" id="gmap_canvas" src="https://maps.google.com/maps?q=sman%201%20bukittinggi&t=&z=13&ie=UTF8&iwloc=&output=embed" frameborder="0" scrolling="no" marginheight="0" marginwidth="0"></iframe><a href="https://embedgooglemap.net/124/"></a><br><style>.mapouter{position:relative;text-align:right;height:150px;width:400px;}</style><a href="https://www.embedgooglemap.net"></a><style>.gmap_canvas {overflow:hidden;background:none!important;height:150px;width:400px;}</style></div></div>
            </div>
            <div>
                <h3 class="text-2xl font-semibold">Kontak</h3>
                <p class="text-xl">{{ $config['footer-contact'] }}</p>
            </div>
        </div>
        <div class="grid grid-cols-1 sm:grid-cols-2 md:grid-cols-3 gap-4 mt-8 justify-items-center text-center">
            <div class="flex justify-center">
                <img src="https://github.com/SLAVUSworks/HL-Web-ICON/blob/master/mpk.png?raw=true" alt="SMAN1BKT" class="w-32 h-32 object-contain mx-auto">
            </div>
            <div class="flex justify-center">
                <img src="https://github.com/SLAVUSworks/HL-Web-ICON/blob/master/smansa.png?raw=true" alt="SMAN1BKT" class="w-32 h-32 object-contain mx-auto">
            </div>
            <div class="flex justify-center">
                <img src="https://github.com/SLAVUSworks/HL-Web-ICON/blob/master/osis.PNG?raw=true" alt="SMAN1BKT" class="w-32 h-32 object-contain mx-auto">
            </div>
        </div>
        <h3 class="text-lg font-semibold mt-8">Sponsor</h3>
        <div class="grid grid-cols-1 md:grid-cols-8 gap-4 mt-8">

        </div>
        <h3 class="text-lg font-semibold mt-8">Ekstrakurikuler</h3>
        <div class="grid grid-cols-1 md:grid-cols-8 gap-4 mt-8">

        </div>
    </div>
</footer>
</body>
</html>