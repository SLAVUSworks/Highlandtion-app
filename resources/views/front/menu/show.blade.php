@extends('front.layouts.app')

@section('content')

<div class="min-h-screen py-6 px-4 pb-32">
    <div class="max-w-lg mx-auto space-y-4">

        {{-- Back link --}}
        <a href="/" class="flex items-center gap-2 text-xs font-semibold text-slate-400 hover:text-primary transition-colors px-1">
            <span class="material-symbols-outlined text-base">arrow_back</span>
            Kembali ke daftar event
        </a>

        {{-- Main Card --}}
        <div class="rounded-3xl border border-primary/10 bg-white dark:bg-slate-900 shadow-xl overflow-hidden">

            {{-- Thumbnail --}}
            <div class="relative h-56 w-full overflow-hidden">
                <img src="{{ asset('storage/' . $menu->thumbnail) }}"
                     alt="{{ $menu->mata_pelajaran }}"
                     class="w-full h-full object-cover">
                <div class="absolute inset-0 bg-gradient-to-t from-black/80 via-black/20 to-transparent"></div>

                <div class="absolute top-4 left-4">
                    <span class="rounded-lg px-3 py-1 text-xs font-bold text-white uppercase tracking-wider backdrop-blur-md
                        {{ $menu->status === 'tutup' ? 'bg-slate-500' : 'bg-primary/90' }}">
                        {{ $menu->status === 'buka' ? 'Pendaftaran Dibuka' : 'Pendaftaran Ditutup' }}
                    </span>
                </div>

                <div class="absolute bottom-4 left-5 right-5 text-white">
                    <span class="text-xs font-medium opacity-60 uppercase tracking-widest">
                        {{ $menu->menuCategory->name ?? 'Kategori' }}
                    </span>
                    <h1 class="text-2xl font-black leading-tight mt-0.5">{{ $menu->mata_pelajaran }}</h1>
                </div>
            </div>

            {{-- Description --}}
            <div class="px-6 pt-5 pb-2">
                <p class="text-slate-500 text-justify dark:text-slate-400 text-sm leading-relaxed">
                    {{ $menu->deskripsi }}
                </p>
            </div>

            {{-- Details --}}
            <div class="px-6 pb-6">
                <div class="mt-4 rounded-2xl border border-primary/10 overflow-hidden divide-y divide-slate-100 dark:divide-slate-800">
                    <div class="flex justify-between items-center px-4 py-3 bg-slate-50 dark:bg-slate-800/50">
                        <span class="text-xs font-bold text-slate-400 uppercase tracking-widest">Tingkat</span>
                        <span class="text-sm font-bold text-slate-900 dark:text-white">{{ $menu->tingkat }}</span>
                    </div>
                    <div class="flex justify-between items-center px-4 py-3">
                        <span class="text-xs font-bold text-slate-400 uppercase tracking-widest">Kategori</span>
                        <span class="text-sm font-bold text-slate-900 dark:text-white">{{ $menu->menuCategory->name }}</span>
                    </div>
                    <div class="flex justify-between items-center px-4 py-4 bg-primary/5">
                        <span class="text-xs font-bold text-slate-400 uppercase tracking-widest">Biaya</span>
                        <span class="text-2xl font-black">
                            Rp. {{ number_format($menu->harga, 0, ',', '.') }}
                        </span>
                    </div>
                </div>
            </div>

        </div>
    </div>
</div>

{{-- Fixed Bottom Bar --}}
<div class="fixed bottom-0 left-0 w-full z-50 border-t border-primary/10 bg-white/90 dark:bg-[#1a0c0d]/90 backdrop-blur-md shadow-2xl">
    <div class="max-w-lg mx-auto px-5 py-3">
        <div class="flex items-center justify-between gap-4">

            <div class="flex flex-col leading-tight">
                <span class="text-[10px] text-slate-400 uppercase font-bold tracking-widest">Biaya</span>
                <span class="text-xl font-black">
                    Rp. {{ number_format($menu->harga, 0, ',', '.') }}
                </span>
            </div>

            @if ($menu->status === 'tutup')
                <button disabled
                    class="flex items-center gap-2.5 rounded-xl bg-slate-200 dark:bg-slate-800 text-slate-400 font-bold py-3 px-5 cursor-not-allowed shrink-0">
                    <span class="text-sm">Pendaftaran Ditutup</span>
                    <span class="w-7 h-7 bg-slate-400 text-white flex items-center justify-center rounded-full">
                        <i class="fa-solid fa-ticket text-xs"></i>
                    </span>
                </button>
            @else
                <a href="{{ route('registrasi.create', $menu) }}"
                   class="flex items-center gap-2.5 rounded-xl bg-primary text-white font-bold py-3 px-5 hover:bg-primary-dark active:scale-[0.98] transition-all shadow-lg shadow-primary/20 shrink-0">
                    <span class="text-sm">Daftar Sekarang</span>
                    <span class="w-7 h-7 bg-white text-primary flex items-center justify-center rounded-full">
                        <i class="fa-solid fa-ticket text-xs"></i>
                    </span>
                </a>
            @endif

        </div>
    </div>
</div>

@endsection