@extends('back.layouts.app')

@section('content')
<div class="container mx-auto px-4 py-6">
    <h1 class="text-2xl font-bold mb-4">Verifikasi Registrasi</h1>
    <form action="{{ route('back.registrasis.update', $registrasi->id) }}" method="POST">
        @csrf
        @method('PUT')

        <div class="mb-4">
            <label for="nama" class="block text-gray-700 font-bold mb-2">Nama Peserta</label>
            <input type="text" id="nama" name="nama" value="{{ $registrasi->nama }}" disabled
                class="w-full px-4 py-2 border border-gray-300 rounded-lg bg-gray-100">
        </div>

        <div class="mb-4">
            <label for="ruangan_id" class="block text-gray-700 font-bold mb-2">Pilih Ruangan</label>
            <select id="ruangan_id" name="ruangan_id" required
                class="w-full px-4 py-2 border border-gray-300 rounded-lg">
                <option value="">-- Pilih Ruangan --</option>
                @foreach($ruangans as $ruangan)
                <option value="{{ $ruangan->id }}">{{ $ruangan->nama_ruangan }}</option>
                @endforeach
            </select>
        </div>

        <button type="submit" class="bg-green-500 text-white px-4 py-2 rounded-lg hover:bg-green-600">Setujui dan Tempatkan</button>
    </form>
</div>
@endsection
