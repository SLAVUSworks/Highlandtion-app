<style>
    .nav-watermark::after {
        content: "";
        position: absolute;
        bottom: 1px;
        left: 50%;
        transform: translateX(-50%);

        width: 250px;
        height: 250px;

        background: url('{{ asset('digimark/slapus-0.png') }}') center / contain no-repeat;
        opacity: 0.1;

        pointer-events: none;
        z-index: 0;
    }
</style>

<nav id="nav-dash" class="fixed top-0 left-0 z-40 w-64 h-screen pt-20 bg-gray-800 text-white overflow-y-auto nav-watermark">
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
                                    Kartu Peserta
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
                        <a href="{{ route('back.users.index') }}" class="flex items-center gap-3 p-2 text-gray-200 hover:bg-gray-700 rounded-lg w-full text-left 
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
                    <li>
                        <a href="{{ route('back.server.stats') }}" class="flex items-center gap-3 p-2 text-gray-200 hover:bg-gray-700 rounded-lg w-full text-left 
                                    {{ request()->routeIs('back.server.stats') ? 'bg-gray-700' : '' }}">
                            <i class="fa-solid fa-server text-gray-400 w-[24px] text-center shrink-0"></i>
                            <span class="truncate">Server Manager</span>
                        </a>
                    </li>
            </li>
        </ul>
        </ul>
    </div>
</nav>