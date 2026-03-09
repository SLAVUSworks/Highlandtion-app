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
        <nav class="md:flex items-center gap-2">
            <a class="text-sm font-semibold px-3 py-1.5 rounded-lg hover:bg-primary/10 hover:text-primary transition-colors" href="/">Laman Utama</a>
        </nav>
    </div>
</header>
