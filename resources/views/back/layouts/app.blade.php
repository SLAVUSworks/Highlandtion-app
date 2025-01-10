<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <meta name="csrf-token" content="{{ csrf_token() }}">
    <title>@yield('title', 'Admin Panel')</title>
    <script src="https://cdn.tailwindcss.com"></script>
    <link rel="stylesheet" href="https://cdnjs.cloudflare.com/ajax/libs/font-awesome/6.7.1/css/all.min.css" integrity="sha512-5Hs3dF2AEPkpNAR7UiOHba+lRSJNeM2ECkwxUIxC1Q/FLycGTbNapWXB4tP889k5T5Ju8fs4b1P5z/iB4nMfSQ==" crossorigin="anonymous" referrerpolicy="no-referrer" />
    <link rel="stylesheet" href="{{ asset('css/admin.css') }}">
</head>
<body class="bg-gray-100">
    <div id="app">
        <!-- Top Navigation -->
        <nav id="nav-dash" class="fixed top-0 z-50 w-full bg-white shadow flex items-center justify-between px-6 py-3">
            <a href="{{ route('back.menu.index') }}" <h1 class="text-lg font-bold text-black">Admin Panel</h1></a>
            <div class="relative">
                <button id="user-menu-button" class="focus:outline-none">
                    <img src="{{ url('storage/' . Auth::user()->avatar) }}" alt="Profile Picture" class="rounded-full w-10 h-10">
                </button>
                <div id="user-menu" class="absolute right-0 mt-2 w-48 bg-white rounded shadow-lg hidden">
                    <div class="px-4 py-2 border-b">
                        <p class="text-sm text-gray-700 font-bold">{{ Auth::user()->nickname }}</p>
                        <p class="text-sm text-gray-500">{{ Auth::user()->email }}</p>
                        <p class="text-sm text-gray-500">Role: 
                            @if(Auth::user()->role == 1) Admin @elseif(Auth::user()->role == 2) Head @else Assistant @endif
                        </p>
                    </div>
                    <a href="#" class="block px-4 py-2 text-sm text-gray-700 hover:bg-gray-100">Profile</a>
                    <form action="{{ route('logout') }}" method="POST">
                        @csrf
                        <button type="submit" class="block w-full text-left px-4 py-2 text-sm text-gray-700 hover:bg-gray-100">Logout</button>
                    </form>
                </div>
            </div>
        </nav>

        <!-- Sidebar -->
        <nav id="nav-dash" class="fixed top-0 left-0 z-40 w-64 h-screen pt-20 bg-gray-800 text-white">
            <div class="h-full px-3 pb-4 overflow-y-auto">
                <ul class="space-y-1">
                    <li>
                        <a href="{{ route('back.dashboard.index') }}" class="grid grid-cols-[24px,1fr] items-center gap-3 p-2 text-gray-200 hover:bg-gray-700 rounded-lg">
                            <i class="fa-solid fa-desktop text-gray-400"></i>
                            <span>Dashboard</span>
                        </a>
                    </li>
                    <li>
                        <a href="{{ route('back.menu.index') }}" class="grid grid-cols-[24px,1fr] items-center gap-3 p-2 text-gray-200 hover:bg-gray-700 rounded-lg">
                            <i class="fa-solid fa-bars text-gray-400"></i>
                            <span>Daftar Menu</span>
                        </a>
                    </li>
                    <li>
                        <a href="{{ route('back.ruangan.index') }}" class="grid grid-cols-[24px,1fr] items-center gap-3 p-2 text-gray-200 hover:bg-gray-700 rounded-lg">
                            <i class="fa-solid fa-door-open text-gray-400"></i>
                            <span>Daftar Ruangan</span>
                        </a>
                    </li>
                    <li>
                        <a href="{{ route('back.registrasis.index') }}" class="grid grid-cols-[24px,1fr] items-center gap-3 p-2 text-gray-200 hover:bg-gray-700 rounded-lg">
                            <i class="fa-solid fa-person text-gray-400"></i>
                            <span>Registrasi</span>
                        </a>
                    </li>
                    <li>
                        <a href="{{ route('back.users.index') }}" class="grid grid-cols-[24px,1fr] items-center gap-3 p-2 text-gray-200 hover:bg-gray-700 rounded-lg">
                            <i class="fa-solid fa-users text-gray-400"></i>
                            <span>Daftar Admin</span>
                        </a>
                    </li>
                </ul>
            </div>
        </nav>


        <!-- Content -->
        <main class="ml-64 pt-20 p-6">
            <div class="bg-white p-6 rounded shadow">
                @yield('content')
            </div>
        </main>
    </div>

    <!-- Scripts -->
    <script>
        const userMenuButton = document.getElementById('user-menu-button');
        const userMenu = document.getElementById('user-menu');

        userMenuButton.addEventListener('click', () => {
            userMenu.classList.toggle('hidden');
        });
    </script>
    <script src="{{ asset('js/admin.js') }}"></script>
</body>
</html>
