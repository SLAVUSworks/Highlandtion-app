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
                <label class="block text-sm font-medium text-gray-700 mb-1">Nama Aplikasi</label>
                <input type="text" name="app_name"
                    class="block w-full border rounded-lg py-2 px-3 focus:outline-none focus:ring focus:ring-blue-500"
                    value="{{ $configs['app_name']->value ?? '' }}">
            </div>

            {{-- Deskripsi Aplikasi --}}
            <div class="mb-4">
                <label class="block text-sm font-medium text-gray-700 mb-1">Deskripsi Aplikasi</label>
                <textarea name="app_description"
                    class="block w-full border rounded-lg py-2 px-3 focus:outline-none focus:ring focus:ring-blue-500">{{ $configs['app_description']->value ?? '' }}</textarea>
            </div>

            {{-- Status Aplikasi --}}
            <div>
                <label class="block text-sm font-medium text-gray-700 mb-1">Status Aplikasi</label>
                <select name="app_status"
                    class="block w-full border rounded-lg py-2 px-3 focus:outline-none focus:ring focus:ring-blue-500">
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
            <h3 class="text-lg font-semibold mb-4">Pengaturan Logo & Banner</h3>

            {{-- URL Favicon --}}
            <div class="mb-4">
                <label class="block text-sm font-medium text-gray-700 mb-1">URL Favicon</label>
                <input type="text" name="app_favicon"
                    class="block w-full border rounded-lg py-2 px-3 focus:outline-none focus:ring focus:ring-blue-500"
                    value="{{ $configs['app_favicon']->value ?? '' }}">
            </div>

            {{-- Header Background --}}
            <div class="mb-4">
                <label class="block text-sm font-medium text-gray-700 mb-1">URL Header Background</label>
                <input type="text" name="header-background"
                    class="block w-full border rounded-lg py-2 px-3 focus:outline-none focus:ring focus:ring-blue-500"
                    value="{{ $configs['header-background']->value ?? '' }}">
            </div>
        </div>

        <div class="bg-white shadow-md rounded-lg p-6">

            <div>
                <h3 class="text-lg font-semibold mb-4">Pengaturan Tema Warna</h3>
                <p class="text-sm text-gray-700 mb-1">Klik switch untuk membuka color picker, atau ketik hex code secara langsung.</p>
            </div>

            <div class="space-y-3">

                @php
                    $colorFields = [
                        ['key' => 'primary',       'label' => 'Primary',       'desc' => 'Warna utama tombol & aksen'],
                        ['key' => 'primary-dark',  'label' => 'Primary Dark',  'desc' => 'Hover state tombol utama'],
                        ['key' => 'primary-muted', 'label' => 'Primary Muted', 'desc' => 'Warna teredam untuk badge'],
                        ['key' => 'primary-deep',  'label' => 'Primary Deep',  'desc' => 'Warna gelap untuk kontras tinggi'],
                        ['key' => 'primary-light', 'label' => 'Primary Light', 'desc' => 'Warna terang untuk highlight'],
                    ];
                @endphp

                @foreach ($colorFields as $field)
                @php $val = $configs[$field['key']]->value ?? '#ec1b22'; @endphp

                <div class="flex items-center gap-4 rounded-2xl border bg-slate-800 dark:bg-slate-800 px-4 py-3">

                    {{-- Color swatch / native picker trigger --}}
                    <div class="relative shrink-0">
                        <input type="color"
                            id="picker-{{ $field['key'] }}"
                            value="{{ $val }}"
                            class="absolute inset-0 w-full h-full opacity-0 cursor-pointer rounded-xl"
                            oninput="syncHex('{{ $field['key'] }}', this.value)">
                        <div id="swatch-{{ $field['key'] }}"
                            class="w-12 h-12 rounded-xl border-2 border-white dark:border-slate-700 shadow-md transition-transform hover:scale-105 cursor-pointer"
                            style="background-color: {{ $val }}">
                        </div>
                    </div>

                    {{-- Label + hex input --}}
                    <div class="flex-1 min-w-0">
                        <p class="text-xs font-black text-slate-900 dark:text-white uppercase tracking-widest leading-none mb-0.5">
                            {{ $field['label'] }}
                        </p>
                        <p class="text-xs text-slate-400 mb-2">{{ $field['desc'] }}</p>
                        <div class="flex items-center gap-2">
                            <span class="text-xs font-bold text-slate-400">#</span>
                            <input type="text"
                                id="hex-{{ $field['key'] }}"
                                name="{{ $field['key'] }}"
                                value="{{ $val }}"
                                maxlength="7"
                                placeholder="ec1b22"
                                class="w-28 rounded-lg border border-slate-200 dark:border-slate-700 bg-white dark:bg-slate-800 px-2 py-1.5 text-sm font-black text-slate-900 dark:text-white tracking-widest focus:outline-none focus:ring-2 focus:ring-primary/30 focus:border-primary transition font-mono"
                                oninput="syncPicker('{{ $field['key'] }}', this.value)">
                        </div>
                    </div>

                    {{-- Live preview pill --}}
                    <div class="shrink-0 text-right space-y-1">
                        <p class="text-xs text-slate-400 font-bold uppercase tracking-widest">Preview</p>
                        <span id="preview-{{ $field['key'] }}"
                            class="inline-block px-3 py-1.5 rounded-full text-xs font-black text-white shadow-sm"
                            style="background-color: {{ $val }}">
                            Aa
                        </span>
                    </div>

                </div>
                @endforeach

            </div>

            {{-- Palette preview bar --}}
            <div>
                <p class="text-sm text-gray-700 font-bold uppercase tracking-widest my-2">Palette Preview</p>
                <div class="flex rounded-2xl overflow-hidden h-10">
                    @foreach ($colorFields as $field)
                    @php $val = $configs[$field['key']]->value ?? '#ec1b22'; @endphp
                    <div id="bar-{{ $field['key'] }}"
                        class="flex-1 transition-colors duration-300"
                        style="background-color: {{ $val }}"
                        title="{{ $field['label'] }}">
                    </div>
                    @endforeach
                </div>
            </div>

        </div>

        <script>
            function syncHex(key, hexValue) {
                // Update hex text input
                const hexInput = document.getElementById('hex-' + key);
                hexInput.value = hexValue;

                // Update swatch + preview + bar
                updateVisuals(key, hexValue);
            }

            function syncPicker(key, rawValue) {
                // Ensure it starts with #
                let hex = rawValue.startsWith('#') ? rawValue : '#' + rawValue;

                // Only sync picker when we have a valid full hex
                if (/^#[0-9A-Fa-f]{6}$/.test(hex)) {
                    document.getElementById('picker-' + key).value = hex;
                    updateVisuals(key, hex);
                }
            }

            function updateVisuals(key, hex) {
                document.getElementById('swatch-'  + key).style.backgroundColor = hex;
                document.getElementById('preview-' + key).style.backgroundColor = hex;
                document.getElementById('bar-'     + key).style.backgroundColor = hex;
            }
        </script>

        <div class="bg-white shadow-md rounded-lg p-6">
            <h3 class="text-lg font-semibold mb-4">Typewriter Landing Page & Tagline</h3>

            {{-- Tagline --}}
            <div class="mb-4">
                <label class="block text-sm font-medium text-gray-700 mb-1">Tagline</label>
                <input type="text" name="tagline"
                    class="block w-full border rounded-lg py-2 px-3 focus:outline-none focus:ring focus:ring-blue-500"
                    value="{{ $configs['tagline']->value ?? '' }}">
            </div>

            {{-- Typewriter Text --}}
            <div>
                <label class="block text-sm font-medium text-gray-700 mb-1">Typewriter - Efek Typewriter di Laman Utama, <a href="https://www.npmjs.com/package/typewriter-effect#examples" target="_blank" rel="noopener noreferrer" class="text-blue-600">Cara Kustomisasinya</a></label>
                <textarea cols="20" rows="20" name="typewriter"
                    class="block w-full border rounded-lg py-2 px-3 focus:outline-none focus:ring focus:ring-blue-500">{{ $configs['typewriter']->value ?? '' }}</textarea>
            </div>
        </div>

        <div class="bg-white shadow-md rounded-lg p-6">
            <h3 class="text-lg font-semibold mb-4">Kontak Footer</h3>

            {{-- Kontak Footer --}}
            <div>
                <label class="block text-sm font-medium text-gray-700 mb-1">Kontak Footer - Dapat Menggunakan <a href="https://www.w3schools.com/HTML/html_lists.asp" target="_blank" rel="noopener noreferrer" class="text-blue-600">Tag List HTML</a></label>
                <textarea cols="10" rows="10" name="footer-contact"
                    class="block w-full border rounded-lg py-2 px-3 focus:outline-none focus:ring focus:ring-blue-500">{{ $configs['footer-contact']->value ?? '' }}</textarea>
            </div>
        </div>

        <div class="bg-white shadow-md rounded-lg p-6">
            <h3 class="text-lg font-semibold mb-4">Informasi Bank</h3>

            {{-- Nama Bank --}}
            <div class="mb-4">
                <label class="block text-sm font-medium text-gray-700 mb-1">Nama Bank</label>
                <input type="text" name="nama-bank"
                    class="block w-full border rounded-lg py-2 px-3 focus:outline-none focus:ring focus:ring-blue-500"
                    value="{{ $configs['nama-bank']->value ?? '' }}">
            </div>

            {{-- Nomor Rekening --}}
            <div class="mb-4">
                <label class="block text-sm font-medium text-gray-700 mb-1">Nomor Rekening</label>
                <input type="text" name="nomor-rekening"
                    class="block w-full border rounded-lg py-2 px-3 focus:outline-none focus:ring focus:ring-blue-500"
                    value="{{ $configs['nomor-rekening']->value ?? '' }}">
            </div>

            {{-- Nama Pemilik Rekening --}}
            <div class="mb-4">
                <label class="block text-sm font-medium text-gray-700 mb-1">Nama Pemilik Rekening</label>
                <input type="text" name="nama-pemilik-rekening"
                    class="block w-full border rounded-lg py-2 px-3 focus:outline-none focus:ring focus:ring-blue-500"
                    value="{{ $configs['nama-pemilik-rekening']->value ?? '' }}">
            </div>

            {{-- URL Logo Bank --}}
            <div>
                <label class="block text-sm font-medium text-gray-700 mb-1">URL Logo Bank</label>
                <input type="text" name="logo-bank"
                    class="block w-full border rounded-lg py-2 px-3 focus:outline-none focus:ring focus:ring-blue-500"
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
