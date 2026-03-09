@extends('front.layouts.app')

@section('content')

@if(($config['app_status'] ?? 1) == 0)
    <script>window.location.href = "{{ route('maintenance') }}";</script>
@elseif(($config['app_status'] ?? 1) == 2)
    <script>window.location.href = "{{ route('regs-closed') }}";</script>
@else

{{-- =========================================================
     HERO SECTION
========================================================= --}}
<section class="relative overflow-hidden px-6 py-16 md:py-24">
    <div class="mx-auto max-w-7xl grid grid-cols-1 lg:grid-cols-2 gap-12 items-center">

        {{-- Text --}}
        <div class="z-10" data-aos="fade-up">
            <span class="inline-block px-4 py-1 rounded-full bg-primary/10 text-primary text-xs font-bold uppercase tracking-wider mb-6">
                {{ $config['tagline'] ?? 'Official Platform' }}
            </span>
            <h1 id="app" class="text-5xl md:text-7xl font-black leading-[1.1] tracking-tight mb-6"></h1>
            {!! $config['typewriter'] !!}
            <p class="text-lg text-justify text-slate-600 dark:text-slate-400 max-w-lg mb-8">
                {{ $config['app_description'] }}
            </p>
            <div class="flex flex-wrap gap-4">
                <a href="#events"
                   class="flex items-center gap-2 rounded-xl bg-primary px-8 py-4 font-bold text-white hover:scale-105 transition-transform">
                    Eksplor Sekarang
                    <span class="material-symbols-outlined">arrow_forward</span>
                </a>
                <a href="{{ route('registrasi.track') }}"
                   class="flex items-center gap-2 rounded-xl border-2 border-primary/30 px-8 py-4 font-bold hover:bg-primary/5 transition-colors">
                    Track Registrasi
                </a>
            </div>
        </div>

        {{-- Visual --}}
        <div class="relative" data-aos="fade-up" data-aos-delay="200">
            <div class="absolute -inset-4 bg-primary/20 blur-3xl rounded-full"></div>
            <div class="relative bg-gradient-to-br from-primary/10 to-transparent p-8 rounded-3xl border border-primary/10 aspect-video flex items-center justify-center"
                 style="background-image: url('{{ $config['header-background'] }}'); background-size: cover; background-position: center;">
            </div>
        </div>

    </div>
</section>

{{-- =========================================================
     FILTERS & EVENT GRID
========================================================= --}}
<section id="events" class="px-6 py-12 bg-white/50 dark:bg-black/20">
    <div class="mx-auto max-w-7xl">

        {{-- Header + Category Filter --}}
        <div class="flex flex-col md:flex-row md:items-center justify-between gap-6 mb-10">
            <div data-aos="fade-right">
                <h2 class="text-3xl font-bold mb-2">Event Mendatang</h2>
                <p class="text-slate-500">Pilih kategori event yang ingin Anda ikuti</p>
            </div>
            <div class="flex gap-3 overflow-x-auto pb-2 md:pb-0" data-aos="fade-left">
                <button
                    onclick="filterMenus('all')"
                    id="filter-all"
                    class="whitespace-nowrap rounded-full bg-primary px-6 py-2 text-sm font-bold text-white transition-colors">
                    Semua
                </button>
                @foreach ($categories as $category)
                    <button
                        onclick="filterMenus('{{ $category->id }}')"
                        id="filter-{{ $category->id }}"
                        class="whitespace-nowrap rounded-full bg-primary/10 px-4 py-2 text-sm font-semibold hover:bg-primary/20 transition-colors flex items-center gap-2">
                        @if(!empty($category->icon))
                            <img src="{{ asset('storage/' . $category->icon) }}"
                                 alt="{{ $category->name }}"
                                 class="w-5 h-5 object-cover rounded-full">
                        @endif
                        <p class="pr-5">{{ $category->name }}</p>
                    </button>
                @endforeach
            </div>
        </div>

        {{-- Event Grid --}}
        <div class="grid grid-cols-1 md:grid-cols-2 xl:grid-cols-3 gap-8" id="menu-container">

            @foreach ($menus as $menu)
            @php $isClosed = $menu->status === 'tutup'; @endphp

            <div class="group overflow-hidden rounded-2xl bg-white dark:bg-slate-900 border border-primary/10 shadow-xl
                        {{ $isClosed ? 'opacity-80' : 'transition-all hover:shadow-2xl hover:shadow-primary/10' }}
                        menu-item"
                 data-aos="fade-up"
                 data-aos-anchor-placement="top-bottom"
                 data-category="{{ $menu->menu_category_id }}"
                 data-mata-pelajaran="{{ $menu->mata_pelajaran }}">

                {{-- Card Image --}}
                <div class="relative h-56 w-full bg-slate-200 dark:bg-slate-800">

                    {{-- Background image --}}
                    <a href="{{ $isClosed ? '#' : route('menu.show', $menu) }}"
                       class="block h-full w-full">
                        <div class="h-full w-full bg-cover bg-center transition-transform duration-500 group-hover:scale-110 {{ $isClosed ? 'grayscale' : '' }}"
                             style="background-image: url('{{ asset('storage/' . $menu->thumbnail) }}')">
                        </div>
                    </a>

                    @if($isClosed)
                        {{-- Closed overlay --}}
                        <div class="absolute inset-0 bg-slate-900/40"></div>
                        <div class="absolute top-4 left-4">
                            <span class="rounded-lg bg-slate-500 px-3 py-1 text-xs font-bold text-white uppercase tracking-wider">
                                Pendaftaran Ditutup
                            </span>
                        </div>
                    @else
                        {{-- Open: gradient + title overlay --}}
                        <div class="absolute inset-0 bg-gradient-to-t from-black/60 to-transparent pointer-events-none"></div>
                        <div class="absolute top-4 left-4">
                            <span class="rounded-lg bg-primary/90 px-3 py-1 text-xs font-bold text-white uppercase tracking-wider backdrop-blur-md">
                                Pendaftaran Dibuka
                            </span>
                        </div>
                        <div class="absolute bottom-4 left-4 text-white pointer-events-none">
                            <span class="text-xs font-medium opacity-80">
                                {{ $menu->menuCategory->name ?? 'Kategori' }}
                            </span>
                            <h3 class="text-xl font-bold">{{ $menu->mata_pelajaran }}</h3>
                        </div>
                    @endif
                </div>

                {{-- Card Body --}}
                <div class="p-6">
                    @if($isClosed)
                        {{-- Ghost state --}}
                        <h3 class="text-xl font-bold mb-4">{{ $menu->mata_pelajaran }}</h3>
                        <div class="h-4 w-3/4 bg-slate-100 dark:bg-slate-800 rounded mb-2"></div>
                        <div class="h-4 w-1/2 bg-slate-100 dark:bg-slate-800 rounded"></div>
                    @else
                        {{-- Active state --}}
                        <div class="mb-6 flex items-center justify-between">
                            <div class="flex flex-col">
                                <span class="text-xs text-slate-500 uppercase font-bold tracking-widest">
                                    Biaya Pendaftaran
                                </span>
                                <span class="text-2xl font-black">
                                    Rp. {{ number_format($menu->harga, 0, ',', '.') }}
                                </span>
                            </div>
                            <div class="flex h-12 w-12 items-center justify-center rounded-xl bg-primary/5 text-primary overflow-hidden">
                                @if(!empty($menu->icon))
                                    <img src="{{ asset('storage/' . $menu->icon) }}"
                                         alt="{{ $menu->mata_pelajaran }}"
                                         class="w-8 h-8 object-cover rounded-full">
                                @else
                                    <span class="material-symbols-outlined">event</span>
                                @endif
                            </div>
                        </div>

                        <div class="space-y-3 mb-6">
                            <div class="flex items-center gap-2 text-sm text-slate-600 dark:text-slate-400">
                                <span class="material-symbols-outlined text-sm">category</span>
                                <span>{{ $menu->menuCategory->name ?? 'Tanpa Kategori' }}</span>
                            </div>
                            @if(!empty($menu->deskripsi))
                            <div class="flex items-center gap-2 text-sm text-slate-600 dark:text-slate-400">
                                <span class="material-symbols-outlined text-sm">info</span>
                                <span>{{ Str::limit($menu->deskripsi, 60) }}</span>
                            </div>
                            @endif
                        </div>

                        <a href="{{ route('menu.show', $menu) }}"
                           class="block w-full text-center rounded-xl bg-primary py-4 font-bold text-white transition-all hover:opacity-90 active:scale-[0.98]">
                            Daftar Sekarang
                        </a>
                    @endif
                </div>

            </div>
            @endforeach

        </div>
        {{-- END Event Grid --}}

    </div>
</section>

@endif
@endsection

@push('scripts')
<script>
    function filterMenus(categoryId) {
        // Toggle button active styles
        document.querySelectorAll('[id^="filter-"]').forEach(btn => {
            btn.classList.remove('bg-primary', 'text-white');
            btn.classList.add('bg-primary/10');
        });
        const activeBtn = document.getElementById(
            categoryId === 'all' ? 'filter-all' : 'filter-' + categoryId
        );
        if (activeBtn) {
            activeBtn.classList.remove('bg-primary/10');
            activeBtn.classList.add('bg-primary', 'text-white');
        }

        // Show/hide cards
        document.querySelectorAll('.menu-item').forEach(item => {
            const cat = item.getAttribute('data-category');
            if (categoryId === 'all' || parseInt(cat) === parseInt(categoryId)) {
                item.style.display = 'block';
                item.setAttribute('data-aos', 'fade-up');
            } else {
                item.style.display = 'none';
                item.removeAttribute('data-aos');
            }
        });

        if (typeof AOS !== 'undefined') AOS.refresh();
    }
</script>
@endpush