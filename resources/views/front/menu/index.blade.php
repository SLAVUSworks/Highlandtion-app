@extends('front.layouts.app')

@section('content')
<header class="relative h-screen bg-fixed bg-center bg-cover flex flex-col justify-center items-center" style="background-image: url('{{ $config['header-background'] }}');">
    <div class="absolute top-0 left-0 m-4">
        <img src="{{ $config['header-logo-left'] }}" alt="Logo 1" class="w-20 h-20">
    </div>
    <div class="absolute top-0 right-0 m-4">
        <img src="{{ $config['header-logo-right'] }}" alt="Logo 2" class="w-20 h-20">
    </div>
    <span class="text-black text-sm max-w-lg mx-auto mb-2 capitalize flex items-center">Ini Tagline <svg xmlns="http://www.w3.org/2000/svg" fill="none" viewBox="0 0 24 24" stroke-width="1.5" stroke="currentColor" class="text-indigo-600 ml-2 w-5 h-5">
        <path stroke-linecap="round" stroke-linejoin="round" d="M17.25 8.25 21 12m0 0-3.75 3.75M21 12H3" />
    </svg>
    </span>
    <h1 id="app" class="text-white text-4xl md:text-5xl xl:text-6xl font-semibold max-w-8xl mx-auto mb-16 leading-snug text-center"></h1>
    <script src="{{ asset('js/typewriter.js') }}"></script>
</header>


<div class="p-5">
    <div class="flex justify-start">
        <h2 class="text-2xl font-semibold mb-4">Tingkat</h2>
    </div>
    <div class="flex justify-start flex-wrap">
        <button onclick="filterMenus('all')" class="relative inline-flex items-center justify-center p-0.5 mb-2 me-2 overflow-hidden text-sm font-medium text-gray-900 rounded-lg group bg-gradient-to-br from-purple-600 to-blue-500 group-hover:from-purple-600 group-hover:to-blue-500 hover:text-white dark:text-white focus:ring-4 focus:outline-none focus:ring-blue-300 dark:focus:ring-blue-800">
            <span class="relative px-5 py-2.5 transition-all ease-in duration-75 bg-white dark:bg-gray-900 rounded-md group-hover:bg-opacity-0">
                Semua
            </span>
        </button>
        <button onclick="filterMenus('SD')" class="relative inline-flex items-center justify-center p-0.5 mb-2 me-2 overflow-hidden text-sm font-medium text-gray-900 rounded-lg group bg-gradient-to-br from-cyan-500 to-blue-500 group-hover:from-cyan-500 group-hover:to-blue-500 hover:text-white dark:text-white focus:ring-4 focus:outline-none focus:ring-cyan-200 dark:focus:ring-cyan-800">
            <span class="relative px-5 py-2.5 transition-all ease-in duration-75 bg-white dark:bg-gray-900 rounded-md group-hover:bg-opacity-0">
                Lumi. SD/MI
            </span>
        </button>
        <button onclick="filterMenus('SMP/MTs')" class="relative inline-flex items-center justify-center p-0.5 mb-2 me-2 overflow-hidden text-sm font-medium text-gray-900 rounded-lg group bg-gradient-to-br from-green-400 to-blue-600 group-hover:from-green-400 group-hover:to-blue-600 hover:text-white dark:text-white focus:ring-4 focus:outline-none focus:ring-green-200 dark:focus:ring-green-800">
            <span class="relative px-5 py-2.5 transition-all ease-in duration-75 bg-white dark:bg-gray-900 rounded-md group-hover:bg-opacity-0">
                Lumi. SMP/MTs
            </span>
        </button>
        <button onclick="filterMenus('SMA/MA')" class="relative inline-flex items-center justify-center p-0.5 mb-2 me-2 overflow-hidden text-sm font-medium text-gray-900 rounded-lg group bg-gradient-to-br from-teal-300 to-lime-300 group-hover:from-teal-300 group-hover:to-lime-300 dark:text-white dark:hover:text-gray-900 focus:ring-4 focus:outline-none focus:ring-lime-200 dark:focus:ring-lime-800">
            <span class="relative px-5 py-2.5 transition-all ease-in duration-75 bg-white dark:bg-gray-900 rounded-md group-hover:bg-opacity-0">
                Lumi. SMA/MA
            </span>
        </button>
        <button onclick="filterMenus('LMF (Landbouw Movie Festival)')" class="relative inline-flex items-center justify-center p-0.5 mb-2 me-2 overflow-hidden text-sm font-medium text-gray-900 rounded-lg group bg-gradient-to-br from-red-500 to-yellow-500 group-hover:from-red-500 group-hover:to-yellow-500 hover:text-white dark:text-white focus:ring-4 focus:outline-none focus:ring-yellow-200 dark:focus:ring-yellow-800">
            <span class="relative px-5 py-2.5 transition-all ease-in duration-75 bg-white dark:bg-gray-900 rounded-md group-hover:bg-opacity-0">
                LMF
            </span>
        </button>
        <button onclick="filterMenus('LPC (Landbouw Photography Contest)')" class="relative inline-flex items-center justify-center p-0.5 mb-2 me-2 overflow-hidden text-sm font-medium text-gray-900 rounded-lg group bg-gradient-to-br from-pink-500 to-purple-500 group-hover:from-pink-500 group-hover:to-purple-500 hover:text-white dark:text-white focus:ring-4 focus:outline-none focus:ring-purple-200 dark:focus:ring-purple-800">
            <span class="relative px-5 py-2.5 transition-all ease-in duration-75 bg-white dark:bg-gray-900 rounded-md group-hover:bg-opacity-0">
                LPC
            </span>
        </button>
    </div>       
</div>
<script>
function filterMenus(filter) {
    const menuItems = document.querySelectorAll('.menu-item');
    menuItems.forEach(function (item) {
        const tingkat = item.getAttribute('data-tingkat');
        const mataPelajaran = item.getAttribute('data-mata-pelajaran');

        // Filter berdasarkan tingkat atau mata pelajaran
        if (tingkat === filter || mataPelajaran === filter || filter === 'all') {
            item.style.display = 'block'; // Tampilkan item
            item.setAttribute('data-aos', 'fade-up'); // Aktifkan AOS
        } else {
            item.style.display = 'none'; // Sembunyikan item
            item.removeAttribute('data-aos'); // Nonaktifkan AOS
        }
    });

    // Refresh AOS jika tersedia
    if (typeof AOS !== 'undefined') {
        AOS.refresh();
    }
}
</script>
<div class="grid gap-8 sm:grid-cols-2 lg:grid-cols-3 p-3 md:p-4 xl:p-5" id="menu-container">
    @foreach ($menus as $menu)    
    <div class="bg-white border rounded-lg shadow-md dark:bg-gray-800 dark:border-gray-700 menu-item" 
         data-aos="fade-up"
         data-aos-anchor-placement="top-bottom" 
         data-tingkat="{{ $menu->tingkat }}"
         data-mata-pelajaran="{{ $menu->mata_pelajaran }}">
         
        <!-- Kondisi untuk menyesuaikan gaya thumbnail -->
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
                            <small>Tingkat</small> <br>
                            {{ $menu->tingkat }}
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
</div>
@endsection
@section('scripts')
<script src="https://cdn.jsdelivr.net/npm/sweetalert2@11"></script>
<script>
    function filterMenus(tingkat) {
        document.querySelectorAll('.menu-item').forEach(function (item) {
            if (item.getAttribute('data-tingkat') === tingkat || tingkat === 'all') {
                item.style.display = 'block';
            } else {
                item.style.display = 'none';
            }
        });
    }
</script>
<script>
    document.addEventListener('DOMContentLoaded', function() {
        const swalElement = document.querySelector('.swal');
        const message = swalElement ? swalElement.getAttribute('data-swal') : null;
        if (message) {
            Swal.fire({
                icon: 'success',
                title: 'Berhasil',
                text: message,
            });
        }
    });
</script>
@endsection