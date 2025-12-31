<nav id="nav-dash"
    class="fixed top-0 z-50 w-full bg-white shadow flex items-center justify-between px-6 py-3 h-16">
    <a href="{{ route('back.dashboard.index') }}" class="flex items-center space-x-2">
        <i class="fas fa-cog text-gray-800 text-2xl"></i>
        <h1 class="text-lg font-bold text-white leading-tight">
            {{ $config['app_name'] }}<br>
            <span class="text-l">Web Control Panel</span> <span class="text-xs font-thin">v2.3</span>
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
            <button id="user-menu-button" class="focus:outline-none flex items-center gap-2">
                <img src="{{ url('storage/' . Auth::user()->avatar) }}" alt="Profile Picture"
                    class="rounded-full w-10 h-10 object-cover ring-2 ring-white shadow-md">
            </button>

            <div id="user-menu"
                class="absolute right-0 mt-3 w-72 bg-white rounded-xl shadow-lg border border-gray-100 hidden transition-all duration-150">
                <div class="px-4 py-4 border-b bg-gray-50 rounded-t-xl">
                    <div class="flex items-center gap-3">
                        <div
                            class="w-24 aspect-square rounded-full overflow-hidden flex-shrink-0 ring-2 ring-white shadow-md">
                            <img src="{{ url('storage/' . Auth::user()->avatar) }}"
                                class="w-full h-full object-cover">
                        </div>
                        <div>
                            <p class="text-sm font-semibold text-gray-900 break-all">
                                {{ Auth::user()->nickname }}
                            </p>

                            <p class="text-xs text-gray-600 break-all flex items-center gap-2">
                                <i class="fa-solid fa-envelope text-gray-500"></i>
                                {{ Auth::user()->email }}
                            </p>

                            <p class="text-xs text-gray-600 mt-3 flex items-center gap-2">
                                <i class="fa-solid fa-id-badge text-gray-500"></i>
                                Role:
                                @php
                                $roles = [1 => 'Admin', 2 => 'Moderator', 3 => 'Verifikator'];
                                @endphp
                                <span class="font-medium">{{ $roles[Auth::user()->role] ?? 'Unknown' }}</span>
                            </p>
                        </div>
                    </div>
                </div>
                <form action="{{ route('back.users.index') }}" class="border-b">
                    <button class="flex w-full items-center gap-2 px-4 py-3 text-sm text-gray-600 hover:bg-gray-50 transition-all">
                        <i class="fa-solid fa-user"></i>
                        Atur Profil
                    </button>
                </form>
                <form action="{{ route('logout') }}" method="POST" class="rounded-b-xl">
                    @csrf
                    <button type="submit"
                        class="flex w-full items-center gap-2 px-4 py-3 text-sm text-red-600 hover:bg-red-50 transition-all">
                        <i class="fa-solid fa-right-from-bracket"></i>
                        Logout
                    </button>
                </form>
            </div>
        </div>
    </div>
</nav>
