@extends('back.layouts.app')

@section('title', isset($juknis) ? 'Edit Juknis' : 'Tambah Juknis')

@section('content')
<div class="container mx-auto">
    {{-- Header --}}
    <div class="mb-6 rounded-lg bg-white/60 backdrop-blur px-6 py-4 shadow-sm border border-gray-200">
        <h1 class="flex items-center gap-3 text-3xl font-semibold text-gray-800">
            <span class="h-8 w-1.5 rounded-full bg-sky-500"></span>
            {{ isset($juknis) ? 'Edit Juknis' : 'Tambah Juknis' }}
        </h1>
        <p class="mt-1 text-sm text-gray-500">
            {{ isset($juknis) ? 'Perbarui data juknis acara' : 'Isi form untuk menambah juknis baru' }}
        </p>
    </div>

    {{-- Card Form --}}
    <div class="mt-4 rounded-lg bg-white p-5 shadow-sm border border-gray-100">
        <form action="{{ isset($juknis) ? route('back.juknis.update', $juknis) : route('back.juknis.store') }}"
              method="POST" enctype="multipart/form-data" class="space-y-5">
            @csrf
            @if(isset($juknis)) @method('PUT') @endif

            {{-- Nama Event --}}
            <div>
                <label class="block text-sm font-medium text-gray-700 mb-1">
                    Nama Event <span class="text-red-500">*</span>
                </label>
                <input type="text" name="nama_event"
                       value="{{ old('nama_event', $juknis->nama_event ?? '') }}"
                       required
                       class="w-full rounded-lg border border-gray-300 px-4 py-2 text-sm shadow-sm focus:border-sky-500 focus:ring-1 focus:ring-sky-500 outline-none transition">
            </div>

            {{-- Keterangan --}}
            <div>
                <label class="block text-sm font-medium text-gray-700 mb-1">
                    Keterangan <span class="text-red-500">*</span>
                </label>
                <textarea name="keterangan" rows="4" required
                          class="w-full rounded-lg border border-gray-300 px-4 py-2 text-sm shadow-sm focus:border-sky-500 focus:ring-1 focus:ring-sky-500 outline-none transition resize-none">{{ old('keterangan', $juknis->keterangan ?? '') }}</textarea>
            </div>

            {{-- Upload PDF --}}
            <div>
                <label class="block text-sm font-medium text-gray-700 mb-1">
                    File PDF
                    @if(isset($juknis))
                        <span class="text-gray-400 font-normal">(kosongkan jika tidak diganti)</span>
                    @else
                        <span class="text-red-500">*</span>
                    @endif
                </label>
                <input type="file" name="file_pdf" accept=".pdf"
                       {{ isset($juknis) ? '' : 'required' }}
                       class="w-full text-sm text-gray-600 file:mr-4 file:py-2 file:px-4 file:rounded-lg file:border-0 file:text-sm file:font-semibold file:bg-sky-50 file:text-sky-700 hover:file:bg-sky-100 border border-gray-300 rounded-lg cursor-pointer">

                @isset($juknis)
                <p class="mt-1 text-xs text-gray-500">
                    File saat ini: <span class="font-medium text-gray-700">{{ $juknis->nama_file_asli }}</span>
                </p>
                @endisset
            </div>

            {{-- Tombol --}}
            <div class="flex items-center gap-3 pt-2">
                <button type="submit"
                        class="bg-blue-600 hover:bg-blue-700 text-white font-semibold py-2 px-6 rounded-lg transition">
                    {{ isset($juknis) ? 'Perbarui' : 'Simpan' }}
                </button>
                <a href="{{ route('back.juknis.index') }}"
                   class="bg-gray-100 hover:bg-gray-200 text-gray-700 font-semibold py-2 px-6 rounded-lg transition">
                    Batal
                </a>
            </div>
        </form>
    </div>
</div>
@if($errors->any())
<script>
    Swal.fire({
        icon: 'error',
        title: 'Gagal Menyimpan',
        html: `<ul class="text-left text-sm space-y-1 list-disc list-inside">
            @foreach($errors->all() as $e)
                <li>{{ $e }}</li>
            @endforeach
        </ul>`,
    });
</script>
@endif

@if(session('success'))
<script>
    Swal.fire({
        icon: 'success',
        title: 'Berhasil',
        text: '{{ session('success') }}',
    });
</script>
@endif

@endsection