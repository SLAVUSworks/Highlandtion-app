@extends('back.layouts.app')

@section('title', 'Kartu Registrasi')

@section('content')
<div class="container mx-auto px-4 py-6">
    <h1 class="text-2xl font-bold mb-4">Kartu Ujian</h1>
    <div class="border border-gray-300 rounded-lg p-6 bg-white">
        <h2 class="text-xl font-bold mb-2">{{ $registrasi->nama }}</h2>
        <p><strong>Asal Sekolah:</strong> {{ $registrasi->asal_sekolah }}</p>
        <p><strong>Menu:</strong> {{ $registrasi->menu->mata_pelajaran }}</p>
        <p><strong>Ruangan:</strong> {{ $registrasi->ruangan->nama_ruangan }}</p>
        <p><strong>Nomor Registrasi:</strong> {{ $registrasi->registration_code }}</p>
        <p class="pb-5"><strong>Nomor HP:</strong> {{ $registrasi->nomor_hp }}</p>
        <a href="{{ route('back.registrasis.kirimPesan', $registrasi->id) }}" 
            class="mt-4 px-4 py-2 bg-blue-500 text-white rounded hover:bg-blue-600">
            Kirim ke WhatsApp (Bot)
         </a>                
    </div>
</div>
<script src="https://cdn.tailwindcss.com"></script>
@endsection
