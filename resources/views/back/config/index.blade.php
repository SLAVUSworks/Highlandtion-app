@extends('back.layouts.app')

@section('title', 'Konfigurasi')

@section('content')
<div class="container mx-auto">
    <div class="mb-6 rounded-lg bg-white/60 backdrop-blur px-6 py-4 shadow-sm border border-gray-200">
        <h1 class="flex items-center gap-3 text-3xl font-semibold text-gray-800">
            <span class="h-8 w-1.5 rounded-full bg-teal-500"></span>
            Konfigurasi
        </h1>
        <p class="mt-1 text-sm text-gray-500">
            Atur Konfigurasi dan Tampilan Website
        </p>
    </div>
    @if(session('success'))
    <script>
        Swal.fire({
            icon: 'success',
            title: 'Success',
            text: '{{ session('success') }}',
            timer: 3000,
            showConfirmButton: false
        });

    </script>
    @endif

    <form action="{{ route('back.config.update') }}" method="POST" class="space-y-4">
        @csrf

        <div class="bg-white shadow-md rounded-lg p-6">
            <h3 class="text-lg font-semibold mb-4">Pengaturan Profil dan Status</h3>

            {{-- Nama Aplikasi --}}
            <div class="mb-4">
                <label class="block text-sm font-medium text-gray-700">Nama Aplikasi</label>
                <input type="text" name="app_name"
                    class="mt-1 block w-full rounded-md border-gray-300 shadow-sm focus:ring-blue-500 focus:border-blue-500"
                    value="{{ $configs['app_name']->value ?? '' }}">
            </div>

            {{-- Deskripsi Aplikasi --}}
            <div class="mb-4">
                <label class="block text-sm font-medium text-gray-700">Deskripsi Aplikasi</label>
                <textarea name="app_description"
                    class="mt-1 block w-full rounded-md border-gray-300 shadow-sm focus:ring-blue-500 focus:border-blue-500">{{ $configs['app_description']->value ?? '' }}</textarea>
            </div>

            {{-- Status Aplikasi --}}
            <div>
                <label class="block text-sm font-medium text-gray-700">Status Aplikasi</label>
                <select name="app_status"
                    class="mt-1 block w-full rounded-md border-gray-300 shadow-sm focus:ring-blue-500 focus:border-blue-500">
                    <option value="0" {{ ($configs['app_status']->value ?? '') == 0 ? 'selected' : '' }}>Maintenance -
                        Akses Umum Ditutup</option>
                    <option value="1" {{ ($configs['app_status']->value ?? '') == 1 ? 'selected' : '' }}>Open - Akses
                        Umum Dibuka</option>
                    <option value="2" {{ ($configs['app_status']->value ?? '') == 2 ? 'selected' : '' }}>Ditutup - Akses
                        Dialihkan ke Laman Informasi</option>
                </select>
            </div>
        </div>

        <div class="bg-white shadow-md rounded-lg p-6">
            <h3 class="text-lg font-semibold mb-4">Pengaturan Header & Logo</h3>

            {{-- URL Favicon --}}
            <div class="mb-4">
                <label class="block text-sm font-medium text-gray-700">URL Favicon</label>
                <input type="text" name="app_favicon"
                    class="mt-1 block w-full rounded-md border-gray-300 shadow-sm focus:ring-blue-500 focus:border-blue-500"
                    value="{{ $configs['app_favicon']->value ?? '' }}">
            </div>

            {{-- Header Background --}}
            <div class="mb-4">
                <label class="block text-sm font-medium text-gray-700">URL Header Background</label>
                <input type="text" name="header-background"
                    class="mt-1 block w-full rounded-md border-gray-300 shadow-sm focus:ring-blue-500 focus:border-blue-500"
                    value="{{ $configs['header-background']->value ?? '' }}">
            </div>

            {{-- Header Logo Kiri --}}
            <div class="mb-4">
                <label class="block text-sm font-medium text-gray-700">URL Header Logo Kiri</label>
                <input type="text" name="header-logo-left"
                    class="mt-1 block w-full rounded-md border-gray-300 shadow-sm focus:ring-blue-500 focus:border-blue-500"
                    value="{{ $configs['header-logo-left']->value ?? '' }}">
            </div>

            {{-- Header Logo Kanan --}}
            <div>
                <label class="block text-sm font-medium text-gray-700">URL Header Logo Kanan</label>
                <input type="text" name="header-logo-right"
                    class="mt-1 block w-full rounded-md border-gray-300 shadow-sm focus:ring-blue-500 focus:border-blue-500"
                    value="{{ $configs['header-logo-right']->value ?? '' }}">
            </div>
        </div>

        <div class="bg-white shadow-md rounded-lg p-6">
            <h3 class="text-lg font-semibold mb-4">Typewriter Landing Page & Tagline</h3>

            {{-- Tagline --}}
            <div class="mb-4">
                <label class="block text-sm font-medium text-gray-700">Tagline</label>
                <input type="text" name="tagline"
                    class="mt-1 block w-full rounded-md border-gray-300 shadow-sm focus:ring-blue-500 focus:border-blue-500"
                    value="{{ $configs['tagline']->value ?? '' }}">
            </div>

            {{-- Typewriter Text --}}
            <div>
                <label class="block text-sm font-medium text-gray-700">Typewriter - Efek Typewriter di Laman Utama, <a href="https://www.npmjs.com/package/typewriter-effect#examples" target="_blank" rel="noopener noreferrer" class="text-blue-600">Cara Kustomisasinya</a></label>
                <textarea cols="20" rows="20" name="typewriter"
                    class="mt-1 block w-full rounded-md border-gray-300 shadow-sm focus:ring-blue-500 focus:border-blue-500">{{ $configs['typewriter']->value ?? '' }}</textarea>
            </div>
        </div>

        <div class="bg-white shadow-md rounded-lg p-6">
            <h3 class="text-lg font-semibold mb-4">Kontak Footer</h3>

            {{-- Kontak Footer --}}
            <div>
                <label class="block text-sm font-medium text-gray-700">Kontak Footer - Dapat Menggunakan <a href="https://www.w3schools.com/HTML/html_lists.asp" target="_blank" rel="noopener noreferrer" class="text-blue-600">Tag List HTML</a></label>
                <textarea cols="10" rows="10" name="footer-contact"
                    class="mt-1 block w-full rounded-md border-gray-300 shadow-sm focus:ring-blue-500 focus:border-blue-500">{{ $configs['footer-contact']->value ?? '' }}</textarea>
            </div>
        </div>

        <div class="bg-white shadow-md rounded-lg p-6">
            <h3 class="text-lg font-semibold mb-4">Informasi Bank</h3>

            {{-- Nama Bank --}}
            <div class="mb-4">
                <label class="block text-sm font-medium text-gray-700">Nama Bank</label>
                <input type="text" name="nama-bank"
                    class="mt-1 block w-full rounded-md border-gray-300 shadow-sm focus:ring-blue-500 focus:border-blue-500"
                    value="{{ $configs['nama-bank']->value ?? '' }}">
            </div>

            {{-- Nomor Rekening --}}
            <div class="mb-4">
                <label class="block text-sm font-medium text-gray-700">Nomor Rekening</label>
                <input type="text" name="nomor-rekening"
                    class="mt-1 block w-full rounded-md border-gray-300 shadow-sm focus:ring-blue-500 focus:border-blue-500"
                    value="{{ $configs['nomor-rekening']->value ?? '' }}">
            </div>

            {{-- Nama Pemilik Rekening --}}
            <div class="mb-4">
                <label class="block text-sm font-medium text-gray-700">Nama Pemilik Rekening</label>
                <input type="text" name="nama-pemilik-rekening"
                    class="mt-1 block w-full rounded-md border-gray-300 shadow-sm focus:ring-blue-500 focus:border-blue-500"
                    value="{{ $configs['nama-pemilik-rekening']->value ?? '' }}">
            </div>

            {{-- URL Logo Bank --}}
            <div>
                <label class="block text-sm font-medium text-gray-700">URL Logo Bank</label>
                <input type="text" name="logo-bank"
                    class="mt-1 block w-full rounded-md border-gray-300 shadow-sm focus:ring-blue-500 focus:border-blue-500"
                    value="{{ $configs['logo-bank']->value ?? '' }}">
            </div>
        </div>


        {{-- Tombol Simpan --}}
        <div class="mt-4">
            <button type="submit" class="w-full bg-blue-600 text-white py-2 px-4 rounded-md hover:bg-blue-700">
                Simpan Pengaturan
            </button>
        </div>
    </form>
</div>
@endsection
