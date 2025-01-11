<!DOCTYPE html>
<html lang="en">
    <head>
        <meta charset="UTF-8">
        <meta name="viewport" content="width=device-width, initial-scale=1.0">
        <script src="https://cdn.tailwindcss.com"></script>
        <link rel="stylesheet" href="https://cdnjs.cloudflare.com/ajax/libs/font-awesome/6.7.1/css/all.min.css" integrity="sha512-5Hs3dF2AEPkpNAR7UiOHba+lRSJNeM2ECkwxUIxC1Q/FLycGTbNapWXB4tP889k5T5Ju8fs4b1P5z/iB4nMfSQ==" crossorigin="anonymous" referrerpolicy="no-referrer" />
        <script src="https://unpkg.com/typewriter-effect@latest/dist/core.js"></script>
        <link rel="stylesheet" href="{{ asset('css/front.css') }}">
    
        <title>@yield('title', 'Highlandtion')</title>
    </head>

<body>
    <nav class="bg-gray-800 p-4">
        <div class="container mx-auto flex justify-between items-center">
            <a href="/" class="text-white text-lg font-semibold">Highlandtion</a>
            <div>
                <a href="#" class="text-gray-300 hover:text-white px-3 py-2 rounded-md text-sm font-medium">Home</a>
                <a href="#" class="text-gray-300 hover:text-white px-3 py-2 rounded-md text-sm font-medium">About</a>
                <a href="#" class="text-gray-300 hover:text-white px-3 py-2 rounded-md text-sm font-medium">Contact</a>
            </div>
        </div>
    </nav>
    <section class="min-h-screen text-center py-20 px-8 xl:px-0 flex flex-col justify-center">
    
    @yield('content')

    </section>
    <footer class="bg-gray-800 text-white py-8">
        <div class="container mx-auto">
            <div class="grid grid-cols-1 md:grid-cols-3 gap-4">
                <div>
                    <h3 class="text-lg font-semibold">Highlandtion</h3>
                    <p class="text-sm">Lorem ipsum dolor sit amet consectetur adipisicing elit. Quisquam, voluptates.</p>
                </div>
                <div>
                    <h3 class="text-lg font-semibold">Links</h3>
                    <ul class="mt-2">
                        <li><a href="#" class="text-sm hover:text-gray-300">Home</a></li>
                        <li><a href="#" class="text-sm hover:text-gray-300">About</a></li>
                        <li><a href="#" class="text-sm hover:text-gray-300">Contact</a></li>
                    </ul>
                </div>
                <div>
                    <h3 class="text-lg font-semibold">Contact</h3>
                    <p class="text-sm">Jl. Lorem ipsum dolor sit amet consectetur adipisicing elit. Quisquam, voluptates.</p>
                </div>
            </div>
</body>
</html>