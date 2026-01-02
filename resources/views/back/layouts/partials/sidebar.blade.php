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

<nav id="nav-dash" class="fixed top-0 left-0 z-40 w-64 h-screen pt-20 bg-[#6EA6E6] text-white overflow-y-auto nav-watermark">
    <div class="h-full px-3 pb-4 overflow-y-auto">
        <ul class="space-y-1">
            <li>
                <a href="{{ route('back.dashboard.index') }}" class="flex items-center gap-3 p-2 text-gray-200 hover:bg-[#8BB9F0] rounded-lg w-full text-left 
                        {{ request()->routeIs('back.dashboard.index') ? 'bg-[#4F8ED6]' : '' }}">
                    <i class="fa-solid fa-desktop text-[#FFFFFF] w-[24px] text-center shrink-0"></i>
                    <span class="truncate text-[#FFFFFF]">Dashboard</span>
                </a>

            </li>
            <li>
                <button
                    class="submenu-button flex items-center gap-3 p-2 text-gray-200 hover:bg-[#8BB9F0] rounded-lg w-full text-left">
                    <i class="fa-solid fa-bars text-[#FFFFFF] w-[24px] text-center shrink-0"></i>
                    <span class="truncate text-[#FFFFFF]">Umum</span>
                </button>

                <ul class="submenu space-y-1 ml-6">
                    <li>
                        <button
                            class="submenu-button flex items-center gap-3 p-2 text-gray-200 hover:bg-[#8BB9F0] rounded-lg w-full text-left">
                            <i
                                class="fa-solid fa-calendar-days text-[#FFFFFF] w-[24px] text-center shrink-0"></i>
                            <span class="truncate text-[#FFFFFF]">Menu Event</span>
                        </button>

                        <ul
                            class="submenu space-y-1 ml-6 mt-1 {{ request()->routeIs('back.menu*') ? '' : 'hidden' }}">
                            <li>
                                <a href="{{ route('back.menu-category.index') }}"
                                    class="block p-1 text-gray-200 hover:bg-[#8BB9F0] rounded-lg {{ request()->routeIs('back.menu-category.index') ? 'bg-[#4F8ED6]' : '' }}">
                                    Daftar Kategori
                                </a>
                            </li>
                            <li>
                                <a href="{{ route('back.menu.index') }}"
                                    class="block p-1 text-gray-200 hover:bg-[#8BB9F0] rounded-lg {{ request()->routeIs('back.menu.index') ? 'bg-[#4F8ED6]' : '' }}">
                                    Daftar Event
                                </a>
                            </li>
                        </ul>
                    </li>
                    <li>
                    <li>
                        <a href="{{ route('back.ruangan.index') }}" class="flex items-center gap-3 p-2 text-gray-200 hover:bg-[#8BB9F0] rounded-lg w-full text-left 
                                    {{ request()->routeIs('back.ruangan.index') ? 'bg-[#4F8ED6]' : '' }}">
                            <i class="fa-solid fa-file text-[#FFFFFF] w-[24px] text-center shrink-0"></i>
                            <span class="truncate text-[#FFFFFF]">Ruangan</span>
                        </a>
                    </li>
                    <li>
                        <button
                            class="submenu-button flex items-center gap-3 p-2 text-gray-200 hover:bg-[#8BB9F0] rounded-lg w-full text-left">
                            <i class="fa-solid fa-person text-[#FFFFFF] w-[24px] text-center shrink-0"></i>
                            <span class="truncate text-[#FFFFFF]">Registrasi</span>
                        </button>

                        <ul
                            class="submenu space-y-1 ml-6 mt-1 {{ request()->routeIs('back.registrasis.*') ? '' : 'hidden' }}">
                            <li>
                                <a href="{{ route('back.registrasis.index') }}"
                                    class="block p-1 text-gray-200 hover:bg-[#8BB9F0] rounded-lg {{ request()->routeIs('back.registrasis.index') ? 'bg-[#4F8ED6]' : '' }}">
                                    Daftar Registrasi
                                </a>
                            </li>
                            <li>
                                <a href="{{ route('back.registrasis.indexApproved') }}"
                                    class="block p-1 text-gray-200 hover:bg-[#8BB9F0] rounded-lg {{ request()->routeIs('back.registrasis.indexApproved') ? 'bg-[#4F8ED6]' : '' }}">
                                    Kartu Peserta
                                </a>
                            </li>
                        </ul>
                    </li>
                    <li>
                        <a href="{{ route('back.articles.index') }}" class="flex items-center gap-3 p-2 text-gray-200 hover:bg-[#8BB9F0] rounded-lg w-full text-left 
                                    {{ request()->routeIs('back.articles.index') ? 'bg-[#4F8ED6]' : '' }}">
                            <i class="fa-solid fa-file text-[#FFFFFF] w-[24px] text-center shrink-0"></i>
                            <span class="truncate text-[#FFFFFF]">Informasi</span>
                        </a>
                    </li>
                    <li>
                        <a href="{{ route('back.contact.index') }}" class="flex items-center gap-3 p-2 text-gray-200 hover:bg-[#8BB9F0] rounded-lg w-full text-left 
                                    {{ request()->routeIs('back.contact.index') ? 'bg-[#4F8ED6]' : '' }}">
                            <i class="fa-solid fa-phone text-[#FFFFFF] w-[24px] text-center shrink-0"></i>
                            <span class="truncate text-[#FFFFFF]">Kontak</span>
                        </a>
                    </li>
                </ul>
            </li>
            <li>
                <button
                    class="submenu-button flex items-center gap-3 p-2 text-gray-200 hover:bg-[#8BB9F0] rounded-lg w-full text-left">
                    <i class="fa-solid fa-gear text-[#FFFFFF] w-[24px] text-center shrink-0"></i>
                    <span class="truncate text-[#FFFFFF]">Teknis</span>
                </button>
                <ul class="submenu space-y-1 ml-6">
                    <li>
                        <a href="{{ route('back.users.index') }}" class="flex items-center gap-3 p-2 text-gray-200 hover:bg-[#8BB9F0] rounded-lg w-full text-left 
                                    {{ request()->routeIs('back.users.index') ? 'bg-[#4F8ED6]' : '' }}">
                            <i class="fa-solid fa-users text-[#FFFFFF] w-[24px] text-center shrink-0"></i>
                            <span class="truncate text-[#FFFFFF]">
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
                            class="flex items-center gap-3 p-2 text-gray-200 hover:bg-[#8BB9F0] rounded-lg w-full text-left"
                            target="_blank">
                            <i class="fa-solid fa-folder text-[#FFFFFF] w-[24px] text-center shrink-0"></i>
                            <span class="truncate text-[#FFFFFF]">Files</span>
                        </a>
                    </li>
                    <li>
                        <a href="{{ route('back.config.index') }}" class="flex items-center gap-3 p-2 text-gray-200 hover:bg-[#8BB9F0] rounded-lg w-full text-left 
                                    {{ request()->routeIs('back.config.index') ? 'bg-[#4F8ED6]' : '' }}">
                            <i class="fa-solid fa-list text-[#FFFFFF] w-[24px] text-center shrink-0"></i>
                            <span class="truncate text-[#FFFFFF]">Konfigurasi</span>
                        </a>
                    </li>
                    <li>
                        <a href="{{ route('back.export.index') }}" class="flex items-center gap-3 p-2 text-gray-200 hover:bg-[#8BB9F0] rounded-lg w-full text-left 
                                    {{ request()->routeIs('back.export.index') ? 'bg-[#4F8ED6]' : '' }}">
                            <i class="fa-solid fa-file-export text-[#FFFFFF] w-[24px] text-center shrink-0"></i>
                            <span class="truncate text-[#FFFFFF]">Rekap Data</span>
                        </a>
                    </li>
                    <li>
                        <a href="{{ route('back.server.stats') }}" class="flex items-center gap-3 p-2 text-gray-200 hover:bg-[#8BB9F0] rounded-lg w-full text-left 
                                    {{ request()->routeIs('back.server.stats') ? 'bg-[#4F8ED6]' : '' }}">
                            <i class="fa-solid fa-server text-[#FFFFFF] w-[24px] text-center shrink-0"></i>
                            <span class="truncate text-[#FFFFFF]">Server Manager</span>
                        </a>
                    </li>
            </li>
        </ul>
    </div>
</nav>