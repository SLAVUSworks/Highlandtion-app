@extends('back.layouts.app')

@section('title', 'Kartu Registrasi')

@section('content')
<div class="container mx-auto px-4 py-6">
    <h1 class="text-2xl font-bold mb-4">Kartu Ujian</h1>
    @if (session('error'))
    <script>
        Swal.fire({
            icon: 'error',
            title: 'Gagal',
            text: '{{ session('error') }}',
        });
    </script>
    @endif
    @if (session('success'))
    <script>
        Swal.fire({
            icon: 'success',
            title: 'Berhasil',
            text: '{{ session('success') }}',
        });
    </script>
@endif
    <div class="border border-gray-300 rounded-lg p-6 bg-white">
        <h2 class="text-xl font-bold mb-2">{{ $registrasi->nama }}</h2>
        <p><strong>Asal Sekolah:</strong> {{ $registrasi->asal_sekolah }}</p>
        <p><strong>Menu:</strong> {{ $registrasi->menu->mata_pelajaran }}</p>
        <p><strong>Ruangan:</strong> {{ $registrasi->ruangan->nama_ruangan }}</p>
        <p><strong>Nomor Registrasi:</strong> {{ $registrasi->registration_code }}</p>
        <p class="pb-5"><strong>Nomor HP:</strong> {{ $registrasi->nomor_hp }}</p>
        <a href="{{ route('back.registrasis.kirimPesan', $registrasi->id) }}" 
            class="mt-4 px-4 py-2 bg-blue-500 text-white rounded hover:bg-blue-600">
            Kirim ke WhatsApp
        </a>
        <a target="_blank" href="https://wa.me/{{ $registrasi->nomor_hp }}?text=Halo%20{{ $registrasi->nama }},%20berikut%20adalah%20detail%20registrasi%20Anda:%0A%0AAsal%20Sekolah:%20{{ $registrasi->asal_sekolah }}%0AMenu:%20{{ $registrasi->menu->mata_pelajaran }}%0ARuangan:%20{{ $registrasi->ruangan->nama_ruangan }}%0ANomor%20Registrasi:%20{{ $registrasi->registration_code }}%0A%0ATerima%20kasih." 
            class="mt-4 ml-4 px-4 py-2 bg-green-500 text-white rounded hover:bg-green-600">
            Kirim Manual ke WhatsApp
        </a>
        <a href="{{ route('back.registrasis.index') }}" 
            class="mt-4 ml-4 px-4 py-2 bg-gray-500 text-white rounded hover:bg-gray-600">
            Kembali
        </a>
    </div>
</div>
<script src="https://cdn.tailwindcss.com"></script>
@endsection
