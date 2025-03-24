<!DOCTYPE html>
<html lang="en">

<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <meta name="csrf-token" content="{{ csrf_token() }}">
    <title>@yield('title', 'Admin Panel')</title>
    <script src="https://cdn.tailwindcss.com"></script>

    @vite(['resources/css/app.css', 'resources/js/app.js'])
    <link rel="stylesheet" href="https://cdnjs.cloudflare.com/ajax/libs/font-awesome/6.7.1/css/all.min.css"
        integrity="sha512-5Hs3dF2AEPkpNAR7UiOHba+lRSJNeM2ECkwxUIxC1Q/FLycGTbNapWXB4tP889k5T5Ju8fs4b1P5z/iB4nMfSQ=="
        crossorigin="anonymous" referrerpolicy="no-referrer" />
    <link rel="icon" type="image/x-icon" href="{{ $config['app_favicon'] }}">
    <link rel="stylesheet" href="https://cdn.ckeditor.com/ckeditor5/44.1.0/ckeditor5.css" crossorigin>
    <script src="https://cdn.jsdelivr.net/npm/sweetalert2@11"></script>
    <script src="https://cdnjs.cloudflare.com/ajax/libs/jquery/3.7.1/jquery.min.js"></script>
    <link rel="stylesheet" href="{{ asset('css/admin.css') }}">
</head>

<body class="bg-gray-100">
    <div id="app">
        <nav id="nav-dash"
            class="fixed top-0 z-50 w-full bg-white shadow flex items-center justify-between px-6 py-3 h-16">
            <a href="{{ route('back.dashboard.index') }}" class="flex items-center space-x-2">
                <i class="fas fa-cog text-gray-800 text-2xl"></i>
                <h1 class="text-lg font-bold text-white leading-tight">
                    {{ $config['app_name'] }}<br>
                    <span class="text-l">Web Control Panel</span> <span class="text-xs font-thin">v2.1</span>
                </h1>
            </a>

            <div class="flex items-center space-x-4">
                <div class="relative">
                    <button id="notif-button" class="relative focus:outline-none">
                        <i class="fas fa-bell text-gray-800 text-2xl"></i>
                        <span id="notif-count"
                            class="absolute -top-2 -right-2 bg-red-600 text-white text-xs font-bold rounded-full px-1 hidden">0</span>
                    </button>
                    <div id="notif-menu" class="absolute right-0 mt-2 w-64 bg-white rounded shadow-lg hidden">
                        <div id="notif-content" class="p-2 text-sm text-gray-700">
                            <p class="text-gray-500 text-center">Tidak ada notifikasi</p>
                        </div>
                    </div>
                </div>

                <div class="relative">
                    <button id="user-menu-button" class="focus:outline-none flex items-center">
                        <img src="{{ url('storage/' . Auth::user()->avatar) }}" alt="Profile Picture"
                            class="rounded-full w-10 h-10">
                    </button>
                    <div id="user-menu" class="absolute right-0 mt-2 w-48 bg-white rounded shadow-lg hidden">
                        <div class="px-4 py-2 border-b">
                            <p class="text-sm text-gray-700 font-bold">{{ Auth::user()->nickname }}</p>
                            <p class="text-sm text-gray-500">{{ Auth::user()->email }}</p>
                            <p class="text-sm text-gray-500">Role:
                                @php
                                $roles = [1 => 'Admin', 2 => 'Head', 3 => 'Assistant'];
                                @endphp
                                {{ $roles[Auth::user()->role] ?? 'Unknown' }}
                            </p>
                        </div>
                        <form action="{{ route('logout') }}" method="POST">
                            @csrf
                            <button type="submit"
                                class="block w-full text-left px-4 py-2 text-sm text-gray-700 hover:bg-gray-100">Logout</button>
                        </form>
                    </div>
                </div>
            </div>
        </nav>

        <nav id="nav-dash" class="fixed top-0 left-0 z-40 w-64 h-screen pt-20 bg-gray-800 text-white overflow-y-auto">
            <div class="h-full px-3 pb-4 overflow-y-auto">
                <ul class="space-y-1">
                    <li>
                        <a href="{{ route('back.dashboard.index') }}" class="flex items-center gap-3 p-2 text-gray-200 hover:bg-gray-700 rounded-lg w-full text-left 
                               {{ request()->routeIs('back.dashboard.index') ? 'bg-gray-700' : '' }}">
                            <i class="fa-solid fa-desktop text-gray-400 w-[24px] text-center shrink-0"></i>
                            <span class="truncate">Dashboard</span>
                        </a>

                    </li>
                    <li>
                        <button
                            class="submenu-button flex items-center gap-3 p-2 text-gray-200 hover:bg-gray-700 rounded-lg w-full text-left">
                            <i class="fa-solid fa-bars text-gray-400 w-[24px] text-center shrink-0"></i>
                            <span class="truncate">Umum</span>
                        </button>

                        <ul class="submenu space-y-1 ml-6">
                            <li>
                                <button
                                    class="submenu-button flex items-center gap-3 p-2 text-gray-200 hover:bg-gray-700 rounded-lg w-full text-left">
                                    <i
                                        class="fa-solid fa-calendar-days text-gray-400 w-[24px] text-center shrink-0"></i>
                                    <span class="truncate">Menu Event</span>
                                </button>

                                <ul
                                    class="submenu space-y-1 ml-6 {{ request()->routeIs('back.menu*') ? '' : 'hidden' }}">
                                    <li>
                                        <a href="{{ route('back.menu-category.index') }}"
                                            class="block p-1 text-gray-200 hover:bg-gray-700 rounded-lg {{ request()->routeIs('back.menu-category.index') ? 'bg-gray-700' : '' }}">
                                            Daftar Kategori
                                        </a>
                                    </li>
                                    <li>
                                        <a href="{{ route('back.menu.index') }}"
                                            class="block p-1 text-gray-200 hover:bg-gray-700 rounded-lg {{ request()->routeIs('back.menu.index') ? 'bg-gray-700' : '' }}">
                                            Daftar Event
                                        </a>
                                    </li>
                                </ul>
                            </li>
                            <li>
                                <button
                                    class="submenu-button flex items-center gap-3 p-2 text-gray-200 hover:bg-gray-700 rounded-lg w-full text-left">
                                    <i class="fa-solid fa-door-open text-gray-400 w-[24px] text-center shrink-0"></i>
                                    <span class="truncate">Ruangan</span>
                                </button>

                                <ul
                                    class="submenu space-y-1 ml-6 {{ request()->routeIs('back.ruangan.*') ? '' : 'hidden' }}">
                                    <li>
                                        <a href="{{ route('back.ruangan.index') }}"
                                            class="block p-1 text-gray-200 hover:bg-gray-700 rounded-lg {{ request()->routeIs('back.ruangan.index') ? 'bg-gray-700' : '' }}">
                                            Daftar Ruangan
                                        </a>
                                    </li>
                                    <li>
                                        <a href="{{ route('back.ruangan.create') }}"
                                            class="block p-1 text-gray-200 hover:bg-gray-700 rounded-lg {{ request()->routeIs('back.ruangan.create') ? 'bg-gray-700' : '' }}">
                                            Tambah Ruangan
                                        </a>
                                    </li>
                                </ul>
                            </li>
                            <li>
                                <button
                                    class="submenu-button flex items-center gap-3 p-2 text-gray-200 hover:bg-gray-700 rounded-lg w-full text-left">
                                    <i class="fa-solid fa-person text-gray-400 w-[24px] text-center shrink-0"></i>
                                    <span class="truncate">Registrasi</span>
                                </button>

                                <ul
                                    class="submenu space-y-1 ml-6 {{ request()->routeIs('back.registrasis.*') ? '' : 'hidden' }}">
                                    <li>
                                        <a href="{{ route('back.registrasis.index') }}"
                                            class="block p-1 text-gray-200 hover:bg-gray-700 rounded-lg {{ request()->routeIs('back.registrasis.index') ? 'bg-gray-700' : '' }}">
                                            Daftar Registrasi
                                        </a>
                                    </li>
                                    <li>
                                        <a href="{{ route('back.registrasis.indexApproved') }}"
                                            class="block p-1 text-gray-200 hover:bg-gray-700 rounded-lg {{ request()->routeIs('back.registrasis.indexApproved') ? 'bg-gray-700' : '' }}">
                                            Index Kartu Peserta
                                        </a>
                                    </li>
                                </ul>
                            </li>
                            <li>
                                <a href="{{ route('back.articles.index') }}" class="flex items-center gap-3 p-2 text-gray-200 hover:bg-gray-700 rounded-lg w-full text-left 
                                           {{ request()->routeIs('back.articles.index') ? 'bg-gray-700' : '' }}">
                                    <i class="fa-solid fa-file text-gray-400 w-[24px] text-center shrink-0"></i>
                                    <span class="truncate">Informasi</span>
                                </a>
                            </li>
                            <li>
                                <a href="{{ route('back.contact.index') }}" class="flex items-center gap-3 p-2 text-gray-200 hover:bg-gray-700 rounded-lg w-full text-left 
                                           {{ request()->routeIs('back.contact.index') ? 'bg-gray-700' : '' }}">
                                    <i class="fa-solid fa-phone text-gray-400 w-[24px] text-center shrink-0"></i>
                                    <span class="truncate">Kontak</span>
                                </a>
                            </li>
                        </ul>
                    </li>
                    <li>
                        <button
                            class="submenu-button flex items-center gap-3 p-2 text-gray-200 hover:bg-gray-700 rounded-lg w-full text-left">
                            <i class="fa-solid fa-gear text-gray-400 w-[24px] text-center shrink-0"></i>
                            <span class="truncate">Teknis</span>
                        </button>
                        <ul class="submenu space-y-1 ml-6">
                            <li>
                                <a href="{{ route('back.users.index') }}"
                                    class="flex items-center gap-3 p-2 text-gray-200 hover:bg-gray-700 rounded-lg w-full text-left 
                                           {{ request()->routeIs('back.users.index') ? 'bg-gray-700' : '' }}">
                                    <i class="fa-solid fa-users text-gray-400 w-[24px] text-center shrink-0"></i>
                                    <span class="truncate">
                                        @if(auth()->user()->role != 1)
                                            Profil
                                        @else
                                            Daftar Admin
                                        @endif
                                    </span>
                                </a>
                            </li>                            
                            <li>
                                <a href="{{ url('laravel-filemanager') }}"
                                    class="flex items-center gap-3 p-2 text-gray-200 hover:bg-gray-700 rounded-lg w-full text-left"
                                    target="_blank">
                                    <i class="fa-solid fa-folder text-gray-400 w-[24px] text-center shrink-0"></i>
                                    <span class="truncate">Files</span>
                                </a>
                            </li>
                            <li>
                                <a href="{{ route('back.config.index') }}" class="flex items-center gap-3 p-2 text-gray-200 hover:bg-gray-700 rounded-lg w-full text-left 
                                           {{ request()->routeIs('back.config.index') ? 'bg-gray-700' : '' }}">
                                    <i class="fa-solid fa-list text-gray-400 w-[24px] text-center shrink-0"></i>
                                    <span class="truncate">Konfigurasi</span>
                                </a>
                            </li>
                            <li>
                                <a href="{{ route('back.export.index') }}" class="flex items-center gap-3 p-2 text-gray-200 hover:bg-gray-700 rounded-lg w-full text-left 
                                           {{ request()->routeIs('back.export.index') ? 'bg-gray-700' : '' }}">
                                    <i class="fa-solid fa-file-export text-gray-400 w-[24px] text-center shrink-0"></i>
                                    <span class="truncate">Rekap Data</span>
                                </a>
                            </li>
                    </li>
                </ul>
                </ul>
            </div>
        </nav>
        <main class="ml-64 pt-20 p-6 h-screen overflow-y-auto">
            @if ($errors->any())
            @foreach ($errors->all() as $error)
            <script>
                Swal.fire({
                    icon: 'error',
                    title: 'Gagal',
                    text: "{{ $error }}",
                });

            </script>
            @endforeach
            @endif
            <div class="bg-white p-6 rounded shadow">
                @yield('content')
            </div>
        </main>
    </div>
    <footer id="nav-dash" class="relative bg-gray-800 text-white py-6 mt-8 z-50" data-aos="fade-up">
        <div class="container mx-auto">
            <div class="grid grid-cols-1 md:grid-cols-3 gap-4">
                <div>
                    <h3 class="text-2xl font-semibold">SLAVUSworks</h3>
                    <p class="text-xl text-justify">An Productive Community Circle, Specializes in hardware, software, programming, and engineering solutions, delivering innovative and reliable technology for businesses and community.</p>
                </div>
                <div>
                    <h3 class="text-2xl font-bold">Web Control Panel <small class="font-light">v2.1</small></h3>
                    <div class="mapouter">
                        <div class="gmap_canvas">
                            <p class="text-xl text-justify">Simple, precise, and fast. Streamlines management with clarity and efficiency, ensuring seamless control and secure access for effortless administration. By SLAVUSworks Project with ⸜(｡˃ ᵕ ˂ )⸝♡.</p>
                        </div>
                    </div>
                </div>
                <div>
                    <h3 class="text-2xl font-semibold">Font Pack by</h3>
                    <p class="text-6xl font-bold text-right">+Jakarta Sans</p>
                    <h3 class="text-2xl font-semibold">Made With</h3>
                    <p class="text-xl text-right">Laravel v{{ Illuminate\Foundation\Application::VERSION }} (PHP v{{ PHP_VERSION }})</p>
                    <p class="text-xl text-right">{{ exec('npm list tailwindcss | grep tailwindcss') }}</p>
                </div>
            </div>

            <div class="flex justify-end items-center mt-8">
                <p class="text-sm text-right">HL-Web App N Booking System v2.12.4<br>
                    <small class="text-sm">Made & maintained by 
                        <a href="https://github.com/SLAVUSworks" target="_blank" rel="noopener noreferrer" class="text-blue-400">SLAVUSworks</a>
                        with 
                        <a href="https://github.com/terukaze1939" target="_blank" rel="noopener noreferrer" class="text-blue-400">Terukaze</a>
                    </small>
                </p>
                <img src="https://github.com/SLAVUSworks/HL-Web-ICON/blob/master/slavusworks.png?raw=true" 
                     alt="SLAVUSworks" class="w-12 h-12 ml-2">
            </div>
        </div>
    </footer>

    @section('scripts')
    <script src="https://cdn.ckeditor.com/ckeditor5/36.0.1/classic/ckeditor.js"></script>
    @endsection
    <script>
        window.appRoutes = {
            fetchNotifications: "{{ route('back.registrasi.get') }}?status=pending"
        };

    </script>
    <script src="{{ asset('js/admin.js') }}"></script>

    @yield('scripts')
</body>

</html>
