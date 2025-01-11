@extends('front.layouts.app')

@section('content')

    <span class="text-black text-sm max-w-lg mx-auto mb-2 capitalize flex items-center">Ini Tagline <svg xmlns="http://www.w3.org/2000/svg" fill="none" viewBox="0 0 24 24" stroke-width="1.5" stroke="currentColor" class="text-indigo-600 ml-2 w-5 h-5">
        <path stroke-linecap="round" stroke-linejoin="round" d="M17.25 8.25 21 12m0 0-3.75 3.75M21 12H3" />
    </svg>
    </span>
    <h1 id="app" class="text-white text-4xl md:text-5xl xl:text-6xl font-semibold max-w-8xl mx-auto mb-16 leading-snug"></h1>
    <script src="{{ asset('js/typewriter.js') }}"></script>

    <div class="grid gap-8 sm:grid-cols-2 lg:grid-cols-3 p-3 md:p-4 xl:p-5">
    @foreach ( $menus as $menu )    
    <div class="bg-white border rounded-lg shadow-md dark:bg-gray-800 dark:border-gray-700 ">
        <div class="p-2 flex justify-center">
            <a href="{{ route('menu.show', $menu) }}" class="block w-full h-48">
                <img 
                    class="rounded-lg object-cover w-full h-full"
                    src="{{ 'storage/' . $menu->thumbnail }}"
                    alt="Thumbnail"
                    loading="lazy">
            </a>
        </div>
        
        <div class="px-4 pb-3">
            <div>
                <a href="{{ route('menu.show', $menu) }}">
                    <h5 class="text-xl font-semibold tracking-tight hover:text-violet-800 dark:hover:text-violet-300 text-gray-900 dark:text-white ">
                    {{ $menu->mata_pelajaran }}
                </h5>
            </a>
            <p class="text-gray-600 dark:text-gray-400 text-sm break-all">{{ Str::limit($menu->deskripsi,50),'. . .'  }}</p>
        </div>
        <div class="mt-2 flex justify-between">
            <div class="flex gap-3 py-2">
                    <a href="#">
                        <img src="{{ asset('storage/' . $menu->icon) }}"
                        class="object-cover w-12 h-12 rounded-full" alt="mapel-icon" loading="lazy">
                    </a>
                    <p class="text-gray-600 dark:text-gray-300 hover:text-violet-800 ">
                        <a href="#" class="text-sm">
                            <small>Tingkat</small> <br>
                            {{ $menu->tingkat }}
                        </a>
                    </p>
                </div>
                <div class="flex items-center mt-2.5">
                    <span class="text-sm dark:text-gray-400">Sisa Kuota</span>
                    <span class="bg-blue-100 text-blue-800 text-xs font-semibold mr-2 px-2.5 py-0.5 rounded dark:bg-blue-200 dark:text-blue-800 ml-3">
                        @if ($menu->kuota_now == null)
                            {{ $menu->kuota }}
                        @else
                            {{ $menu->kuota_now }}
                        @endif
                    </span>
                </div>
            <script>
                document.addEventListener('DOMContentLoaded', function () {
                    document.querySelectorAll('.bg-blue-100').forEach(function (element) {
                        let kuotaNow = parseInt(element.textContent.trim());
                        if (kuotaNow <= 5) {
                            element.classList.remove('bg-blue-100', 'dark:bg-blue-200');
                            element.classList.add('bg-red-300');
                        }
                    });
                });
            </script>
            </div>
        </div>
    </div>
    @endforeach
</div>
@endsection