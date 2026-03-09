@extends('front.layouts.app')

@section('content')

<div class="min-h-screen py-6 px-4 pb-16">
    <div class="w-full max-w-2xl mx-auto space-y-6">

        {{-- Page Title --}}
        <div class="text-center space-y-1">
            <h1 class="text-2xl md:text-3xl font-black text-slate-900 dark:text-white">Status Registrasi</h1>
            <p class="text-sm text-slate-400">
                Ada pertanyaan?
                <a href="{{ route('contact.show') }}" class="text-primary font-semibold hover:underline">Hubungi panitia</a>
            </p>
        </div>

        {{-- Ticket Card --}}
        <div class="rounded-3xl border border-primary/10 bg-white dark:bg-slate-900 shadow-xl overflow-hidden">

            {{-- Card Header --}}
            <div class="flex items-center gap-3 md:gap-4 px-5 md:px-8 py-5 md:py-6 border-b border-dashed border-slate-200 dark:border-slate-800">
                <div class="flex h-11 w-11 md:h-14 md:w-14 items-center justify-center rounded-xl bg-primary text-white overflow-hidden shrink-0">
                    <img src="{{ $config['app_favicon'] }}" alt="{{ $config['app_name'] }}" class="w-8 h-8 md:w-10 md:h-10 object-contain">
                </div>
                <div class="min-w-0">
                    <p class="text-xs text-slate-400 font-bold uppercase tracking-widest truncate">{{ $config['app_name'] }}</p>
                    <p class="text-base md:text-xl font-black text-slate-900 dark:text-white leading-tight">SMAN 1 BUKITTINGGI</p>
                    <p class="text-xs md:text-sm text-slate-400">Sekretariat {{ $config['app_name'] }}</p>
                </div>
                <img src="{{ $config['app_favicon'] }}" alt="Logo" class="w-10 h-10 md:w-16 md:h-16 object-contain ml-auto opacity-10 shrink-0">
            </div>

            {{-- Ticket Info --}}
            <div class="px-5 md:px-8 py-5 md:py-6 border-b border-dashed border-slate-200 dark:border-slate-800">
                <div class="flex justify-between items-start gap-3">
                    <div class="space-y-0.5 min-w-0">
                        <p class="text-xs text-slate-400 font-bold uppercase tracking-widest">Tiket</p>
                        <p class="text-base md:text-lg font-black text-slate-900 dark:text-white truncate">
                            {{ $registrasi->menu->menuCategory->name }}
                        </p>
                        <p class="text-sm text-slate-600 dark:text-slate-400 truncate">
                            {{ $registrasi->menu->mata_pelajaran }}
                        </p>
                    </div>
                    <div class="text-right space-y-0.5 shrink-0">
                        <p class="text-xs text-slate-400 font-bold uppercase tracking-widest">Tingkat</p>
                        <p class="text-base md:text-lg font-black text-slate-900 dark:text-white">{{ $registrasi->menu->tingkat }}</p>
                    </div>
                </div>
            </div>

            {{-- Participant Info --}}
            <div class="px-5 md:px-8 py-5 md:py-6 border-b border-dashed border-slate-200 dark:border-slate-800">
                <div class="flex justify-between items-start gap-3">
                    <div class="space-y-0.5 min-w-0">
                        <p class="text-xs text-slate-400 font-bold uppercase tracking-widest">Nama Peserta</p>
                        @php
                            function censorName($name) {
                                if (strlen($name) <= 2) return str_repeat('*', strlen($name));
                                return $name[0] . str_repeat('*', strlen($name) - 2) . $name[strlen($name) - 1];
                            }
                        @endphp
                        <p class="text-xl md:text-2xl font-black text-slate-900 dark:text-white tracking-widest">
                            {{ censorName($registrasi->nama) }}
                        </p>
                    </div>
                </div>
            </div>

            
            {{-- Participant School --}}
            <div class="px-5 md:px-8 py-5 md:py-6 border-b border-dashed border-slate-200 dark:border-slate-800">
                <div class="text-left space-y-0.5 shrink-0 max-w-[45%]">
                    <p class="text-xs text-slate-400 font-bold uppercase tracking-widest">Asal Sekolah</p>
                    <p class="text-sm md:text-lg font-black text-slate-900 dark:text-white break-words">
                        {{ $registrasi->asal_sekolah }}
                    </p>
                </div>
            </div>

            {{-- Status + Date --}}
            <div class="px-5 md:px-8 py-5 md:py-6 flex justify-between items-center gap-3">
                <div class="space-y-1.5">
                    <p class="text-xs text-slate-400 font-bold uppercase tracking-widest">Status</p>
                    <span class="inline-flex items-center gap-1.5 rounded-full px-3 py-1.5 text-xs md:text-sm font-black uppercase tracking-wider
                        {{ $registrasi->status === 'pending'  ? 'bg-yellow-500/10 text-yellow-500' : '' }}
                        {{ $registrasi->status === 'approved' ? 'bg-green-500/10  text-green-500'  : '' }}
                        {{ $registrasi->status === 'rejected' ? 'bg-red-500/10    text-red-500'    : '' }}">
                        <span class="w-1.5 h-1.5 rounded-full shrink-0
                            {{ $registrasi->status === 'pending'  ? 'bg-yellow-500 animate-pulse' : '' }}
                            {{ $registrasi->status === 'approved' ? 'bg-green-500'                : '' }}
                            {{ $registrasi->status === 'rejected' ? 'bg-red-500'                  : '' }}">
                        </span>
                        {{ ucfirst($registrasi->status) }}
                    </span>
                </div>
                <div class="text-right space-y-0.5">
                    <p class="text-xs text-slate-400 font-bold uppercase tracking-widest">Waktu Daftar</p>
                    <p class="text-sm md:text-base font-black text-slate-900 dark:text-white">
                        {{ \Carbon\Carbon::parse($registrasi->created_at)->format('d M Y') }}
                    </p>
                    <p class="text-xs text-slate-400 font-semibold">
                        {{ \Carbon\Carbon::parse($registrasi->created_at)->format('H:i') }} WIB
                    </p>
                </div>
            </div>

            {{-- Barcode strip --}}
            <div class="px-5 md:px-8 py-4 bg-primary/5 border-t border-dashed border-primary/20 flex items-center justify-center gap-0.5 md:gap-1 overflow-hidden">
                @for ($i = 0; $i < 50; $i++)
                    <div class="w-0.5 bg-primary/30 rounded-full shrink-0"
                         style="height: {{ rand(10, 28) }}px"></div>
                @endfor
            </div>

        </div>

        {{-- Back link --}}
        <a href="/"
           class="flex items-center justify-center gap-2 text-sm font-semibold text-slate-400 hover:text-primary transition-colors py-2">
            <span class="material-symbols-outlined text-base">arrow_back</span>
            Kembali ke daftar acara
        </a>

    </div>
</div>

@endsection