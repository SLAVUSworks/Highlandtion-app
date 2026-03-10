<header class="sticky top-0 z-50 w-full border-b border-primary/20 bg-background-light/80 dark:bg-background-dark/80 backdrop-blur-md">
    <div class="mx-auto flex max-w-7xl items-center justify-between px-6 py-4">

        {{-- Logo --}}
        <a href="/" class="flex items-center gap-3 shrink-0">
            <div class="flex h-10 w-10 items-center justify-center rounded-lg bg-primary text-white overflow-hidden">
                <img src="{{ $config['app_favicon'] }}" alt="{{ $config['app_name'] }}" class="w-7 h-7 object-contain">
            </div>
            <h2 class="text-xl font-black tracking-tighter text-slate-900 dark:text-white">
                {{ $config['app_name'] }}
            </h2>
        </a>

        {{-- Desktop Nav --}}
        <nav class="hidden md:flex items-center gap-2">
            <a class="text-sm font-semibold px-3 py-1.5 rounded-lg hover:bg-primary/10 hover:text-primary transition-colors" href="/">Pemesanan Tiket</a>
            <a class="text-sm font-semibold px-3 py-1.5 rounded-lg hover:bg-primary/10 hover:text-primary transition-colors" href="{{ route('front.juknis.index') }}">Juknis Acara</a>
            <a class="text-sm font-semibold px-3 py-1.5 rounded-lg hover:bg-primary/10 hover:text-primary transition-colors" href="{{ route('registrasi.track') }}">Track Registrasi</a>
            <a class="text-sm font-semibold px-3 py-1.5 rounded-lg hover:bg-primary/10 hover:text-primary transition-colors" href="{{ route('front.articles.index') }}">Informasi</a>
            <a class="text-sm font-semibold px-3 py-1.5 rounded-lg hover:bg-primary/10 hover:text-primary transition-colors" href="{{ route('contact.show') }}">Kontak</a>
        </nav>

        {{-- Mobile Dropdown Trigger --}}
        <div class="relative md:hidden" id="dropdown-wrapper">
            <button
                onclick="document.getElementById('dropdown-menu').classList.toggle('hidden')"
                class="flex items-center gap-2 px-4 py-2 rounded-xl border border-primary/20 bg-primary/5 text-sm font-semibold hover:bg-primary/10 transition-colors">
                Menu
                <span class="material-symbols-outlined text-base leading-none">expand_more</span>
            </button>

            {{-- Dropdown --}}
            <div id="dropdown-menu"
                class="hidden absolute right-0 top-full mt-2 w-52 rounded-2xl border border-primary/10 bg-background-light dark:bg-background-dark shadow-2xl shadow-black/20 overflow-hidden z-50">
                <a class="flex items-center gap-3 px-4 py-3 text-sm font-semibold hover:bg-primary/10 hover:text-primary transition-colors"
                href="/">
                    <span class="material-symbols-outlined text-base text-primary/60">confirmation_number</span>
                    Pemesanan Tiket
                </a>
                <a class="flex items-center gap-3 px-4 py-3 text-sm font-semibold hover:bg-primary/10 hover:text-primary transition-colors"
                href="{{ route('front.juknis.index') }}">
                    <span class="material-symbols-outlined text-base text-primary/60">description</span>
                    Juknis Acara
                </a>
                <a class="flex items-center gap-3 px-4 py-3 text-sm font-semibold hover:bg-primary/10 hover:text-primary transition-colors"
                href="{{ route('registrasi.track') }}">
                    <span class="material-symbols-outlined text-base text-primary/60">track_changes</span>
                    Track Registrasi
                </a>
                <a class="flex items-center gap-3 px-4 py-3 text-sm font-semibold hover:bg-primary/10 hover:text-primary transition-colors"
                href="{{ route('front.articles.index') }}">
                    <span class="material-symbols-outlined text-base text-primary/60">info</span>
                    Informasi
                </a>
                <a class="flex items-center gap-3 px-4 py-3 text-sm font-semibold hover:bg-primary/10 hover:text-primary transition-colors"
                href="{{ route('contact.show') }}">
                    <span class="material-symbols-outlined text-base text-primary/60">contacts</span>
                    Kontak
                </a>
            </div>
        </div>

    </div>
</header>

@push('scripts')
<script>
    document.addEventListener('click', function (e) {
        const wrapper = document.getElementById('dropdown-wrapper');
        const menu    = document.getElementById('dropdown-menu');
        if (wrapper && !wrapper.contains(e.target)) {
            menu.classList.add('hidden');
        }
    });
</script>
@endpush
