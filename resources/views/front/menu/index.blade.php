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


<div class="p-4">
    <div class="bg-gray-800 border border-gray-700 rounded-lg shadow p-5">
        <div class="flex items-center justify-between mb-4">
            <h2 class="text-xl font-semibold text-gray-200">
                Kategori
            </h2>

            <span class="text-xs text-gray-300">
                Pilih Kategori Event
            </span>
        </div>

        <div class="h-px bg-gray-700 mb-4"></div>

        <div class="flex flex-wrap gap-3">
            <button
                onclick="filterMenus('all')"
                class="flex items-center gap-2 px-4 py-2 rounded-full
                    bg-gray-800 text-blue-600
                    border-2 border-blue-500
                    hover:bg-blue-500 hover:text-white
                    transition duration-200
                    shadow-sm">
                <span class="text-md font-bold">Semua</span>
            </button>

            @foreach ($categories as $category)
                <button
                    onclick="filterMenus('{{ $category->id }}')"
                    class="flex items-center gap-2 px-2 py-2 rounded-full
                        bg-gray-800 text-blue-600
                        border-2 border-blue-500
                        hover:bg-blue-500 hover:text-white
                        transition duration-200
                        shadow-sm group">

                    <span
                        class="w-8 h-8 flex items-center justify-center
                            rounded-full overflow-hidden
                            bg-blue-100
                            group-hover:bg-white
                            transition">
                        @if(!empty($category->icon))
                            <img
                                src="{{ asset('storage/' . $category->icon) }}"
                                alt="{{ $category->name }}"
                                class="w-full h-full object-cover rounded-full">
                        @else
                            <i class="fa-solid fa-layer-group text-md text-blue-600"></i>
                        @endif
                    </span>

                    <span class="text-md font-bold whitespace-nowrap">
                        {{ $category->name }}
                    </span>
                </button>
            @endforeach
        </div>
    </div>
</div>
<div class="mb-4 grid gap-8 sm:grid-cols-2 lg:grid-cols-3 p-3 md:p-4 xl:p-5" id="menu-container">
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
                    <span class="text-xs font-semibold mr-2 px-2.5 py-0.5 rounded-lg 
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