@extends('front.layouts.app')

@section('content')

<div class="min-h-screen flex items-center justify-center px-4 py-12">
    <div class="w-full max-w-sm space-y-6">

        {{-- Header --}}
        <div class="text-center space-y-1">
            <div class="flex h-14 w-14 items-center justify-center rounded-2xl bg-primary mx-auto mb-4">
                <span class="material-symbols-outlined text-white text-3xl">track_changes</span>
            </div>
            <h1 class="text-2xl font-black text-slate-900 dark:text-white">Track Registrasi</h1>
            <p class="text-sm text-slate-400">Masukkan data diri untuk melihat status pendaftaran</p>
        </div>

        {{-- Error --}}
        @if(session('error'))
            <div class="flex items-center gap-3 rounded-2xl border border-red-500/20 bg-red-500/10 px-4 py-3">
                <span class="material-symbols-outlined text-red-500 shrink-0">error</span>
                <p class="text-sm font-semibold text-red-500">{{ session('error') }}</p>
            </div>
        @endif

        {{-- Form Card --}}
        <div class="rounded-3xl border border-primary/10 bg-white dark:bg-slate-900 shadow-xl overflow-hidden divide-y divide-slate-100 dark:divide-slate-800">

            <div class="px-6 py-5 space-y-1">
                <label for="nama" class="text-xs font-bold text-slate-400 uppercase tracking-widest">Nama</label>
                <form id="track-form" action="{{ route('registrasi.track') }}" method="POST">
                @csrf
                <input type="text" id="nama" name="nama" required
                       value="{{ old('nama') }}"
                       class="block w-full rounded-xl border border-primary/20 bg-slate-50 dark:bg-slate-800 px-4 py-3 text-sm font-semibold text-slate-900 dark:text-white placeholder-slate-400 focus:outline-none focus:ring-2 focus:ring-primary/30 focus:border-primary transition mt-1"
                       placeholder="Contoh: Slava Slavus">
            </div>

            <div class="px-6 py-5 space-y-1">
                <label for="nomor_hp" class="text-xs font-bold text-slate-400 uppercase tracking-widest">Nomor WhatsApp</label>
                <div class="flex gap-2 mt-1">
                    <span class="flex items-center px-4 rounded-xl border border-primary/20 bg-primary/5 text-sm font-bold text-slate-500 shrink-0">+62</span>
                    <input type="text" id="nomor_hp" name="nomor_hp" required maxlength="13"
                           value="{{ old('nomor_hp') }}"
                           inputmode="numeric"
                           oninput="this.value = this.value.replace(/[^0-9]/g, '')"
                           class="block w-full rounded-xl border border-primary/20 bg-slate-50 dark:bg-slate-800 px-4 py-3 text-sm font-semibold text-slate-900 dark:text-white placeholder-slate-400 focus:outline-none focus:ring-2 focus:ring-primary/30 focus:border-primary transition"
                           placeholder="81234567890">
                </div>
            </div>

            <div class="px-6 py-5">
                <button type="submit" form="track-form"
                        class="w-full flex items-center justify-center gap-3 rounded-2xl bg-primary py-4 font-bold text-white hover:bg-primary-dark active:scale-[0.98] transition-all shadow-lg shadow-primary/20">
                    Cari Registrasi
                    <span class="w-8 h-8 bg-white text-primary flex items-center justify-center rounded-full">
                        <span class="material-symbols-outlined text-base">search</span>
                    </span>
                </button>
            </div>

            </form>
        </div>

        {{-- Back --}}
        <a href="/"
           class="flex items-center justify-center gap-2 text-sm font-semibold text-slate-400 hover:text-primary transition-colors py-2">
            <span class="material-symbols-outlined text-base">arrow_back</span>
            Kembali ke daftar acara
        </a>

    </div>
</div>

@endsection