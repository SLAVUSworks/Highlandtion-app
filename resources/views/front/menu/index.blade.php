@extends('front.layouts.app')


@section('content')
@if(($config['app_status'] ?? 1) == 0)
    <script>
        window.location.href = "{{ route('maintenance') }}";
    </script>
@elseif(($config['app_status'] ?? 1) == 2)
    <script>
        window.location.href = "{{ route('regs-closed') }}";
    </script>
@else
<header class="relative h-screen bg-fixed bg-center bg-cover flex flex-col justify-center items-center" style="background-image: url('{{ $config['header-background'] }}');">
    <div class="absolute top-0 left-0 m-4">
        <img src="{{ $config['header-logo-left'] }}" alt="Logo 1" class="w-full h-20">
    </div>
    <div class="absolute top-0 right-0 m-4">
        <img src="{{ $config['header-logo-right'] }}" alt="Logo 2" class="w-full h-20">
    </div>
    <span class="text-black text-sm max-w-lg mx-auto mb-2 capitalize flex items-center">{{ $config['tagline'] }}</span>
    <h1 id="app" class="text-white text-4xl md:text-5xl xl:text-6xl font-semibold max-w-8xl mx-auto mb-16 leading-snug text-center"></h1>
    {!! $config['typewriter'] !!}
</header>


<div class="p-5">
    <div class="flex justify-start">
        <h2 class="text-2xl font-semibold mb-4">Kategori</h2>
    </div>
    <div class="flex flex-wrap gap-2 mb-4">
        <button onclick="filterMenus('all')" class="relative inline-flex items-center justify-center p-0.5 mb-2 me-2 overflow-hidden text-sm font-medium text-gray-900 rounded-lg group bg-gradient-to-br from-gray-500 to-gray-700 hover:text-white dark:text-white focus:ring-4 focus:outline-none focus:ring-gray-300 dark:focus:ring-gray-800">
            <span class="relative px-5 py-2.5 transition-all ease-in duration-75 bg-white dark:bg-gray-900 rounded-md group-hover:bg-opacity-0">
                Semua
            </span>
        </button>
    
        @foreach ($categories as $category)
            <button onclick="filterMenus('{{ $category->id }}')" class="relative inline-flex items-center justify-center p-0.5 mb-2 me-2 overflow-hidden text-sm font-medium text-gray-900 rounded-lg group bg-gradient-to-br from-blue-500 to-purple-500 hover:text-white dark:text-white focus:ring-4 focus:outline-none focus:ring-blue-300 dark:focus:ring-blue-800">
                <span class="relative px-5 py-2.5 transition-all ease-in duration-75 bg-white dark:bg-gray-900 rounded-md group-hover:bg-opacity-0">
                    {{ $category->name }}
                </span>
            </button>
        @endforeach
    </div>    
</div>
<div class="grid gap-8 sm:grid-cols-2 lg:grid-cols-3 p-3 md:p-4 xl:p-5" id="menu-container">
    @foreach ($menus as $menu)    
    <div class="bg-white border rounded-lg shadow-md dark:bg-gray-800 dark:border-gray-700 menu-item" 
         data-aos="fade-up"
         data-aos-anchor-placement="top-bottom" 
         data-category="{{ $menu->menu_category_id }}"
         data-mata-pelajaran="{{ $menu->mata_pelajaran }}">
         
        <div class="p-2 flex justify-center">
            <a href="{{ route('menu.show', $menu) }}" class="block w-full h-48">
                <img 
                    class="rounded-lg object-cover w-full h-full {{ $menu->status === 'tutup' ? 'grayscale' : '' }}" 
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
                <p class="text-gray-800 dark:text-gray-200 text-lg font-semibold">Rp.{{ number_format($menu->harga, 0, ',', '.') }}</p>
            </div>
            <div class="mt-2 flex justify-between">
                <div class="flex gap-3 py-2">
                    <a href="#">
                        <img src="{{ asset('storage/' . $menu->icon) }}" 
                             class="object-cover w-12 h-12 rounded-full" 
                             alt="mapel-icon" 
                             loading="lazy">
                    </a>
                    <p class="text-gray-600 dark:text-gray-300 hover:text-violet-800 ">
                        <a href="#" class="text-sm">
                            <small>Kategori</small> <br>
                            {{ $menu->menuCategory->name ?? 'Tanpa Kategori' }}
                        </a>
                    </p>
                </div>
                <div class="flex items-center mt-2.5">
                    <span class="text-sm dark:text-gray-400 mr-1">Pendaftaran</span>
                    <span class="text-xs font-semibold mr-2 px-2.5 py-0.5 rounded 
                        {{ $menu->status === 'tutup' ? 'bg-gray-300 text-red-700' : 'bg-blue-100 text-blue-800 dark:bg-blue-200 dark:text-blue-800 ml-3' }}">
                        @if ($menu->status === 'buka')
                            Dibuka
                        @else
                            Ditutup
                        @endif
                    </span>
                </div>
            </div>
        </div>
    </div>
    @endforeach
</div>
<script>
    function filterMenus(categoryId) {
        document.querySelectorAll('.menu-item').forEach(function (item) {
            let itemCategory = item.getAttribute('data-category');

            if (parseInt(itemCategory) === parseInt(categoryId) || categoryId === 'all') {
                item.style.display = 'block';
                item.setAttribute('data-aos', 'fade-up');
            } else {
                item.style.display = 'none';
                item.removeAttribute('data-aos');
            }
        });

        if (typeof AOS !== 'undefined') {
            AOS.refresh();
        }
    }
</script>
@endsection
@endif