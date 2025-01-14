@extends('back.layouts.app')

@section('title', 'Buat Menu')

@section('content')
<div class="container mx-auto px-4 py-6">
    <h1 class="text-2xl font-bold mb-6">Tambah Menu</h1>
    <form action="{{ route('back.menu.store') }}" method="POST" enctype="multipart/form-data">
        @csrf
        <div class="mb-4">
            <label for="mata_pelajaran" class="block text-gray-700">Mata Pelajaran</label>
            <input type="text" class="mt-1 block w-full border-gray-300 rounded-md shadow-sm" name="mata_pelajaran" id="mata_pelajaran" required>
        </div>
        <div class="mb-4">
            <label for="deskripsi" class="block text-gray-700">Deskripsi</label>
            <input type="text" class="mt-1 block w-full border-gray-300 rounded-md shadow-sm" name="deskripsi" id="deskripsi" required>
        </div>
        <div class="mb-4">
            <label for="tingkat" class="block text-gray-700">Tingkat</label>
            <select class="mt-1 block w-full border-gray-300 rounded-md shadow-sm" name="tingkat" id="tingkat" required>
            <option value="SD">SD</option>
            <option value="SMP/MTs">SMP/MTs</option>
            <option value="SMA/MA">SMA/MA</option>
            </select>
        </div>
        <div class="mb-4">
            <label for="harga" class="block text-gray-700">Harga</label>
            <input type="number" class="mt-1 block w-full border-gray-300 rounded-md shadow-sm" name="harga" id="harga" required>
        </div>
        <div class="mb-4">
            <label for="kuota" class="block text-gray-700">Kuota</label>
            <input type="number" class="mt-1 block w-full border-gray-300 rounded-md shadow-sm" name="kuota" id="kuota" required>
        </div>
        <div class="mb-4">
            <label for="icon" class="block text-gray-700">Icon</label>
            <input type="file" class="mt-1 block w-full border-gray-300 rounded-md shadow-sm" name="icon" id="icon" required>
        </div>
        <div class="mb-4">
            <label for="thumbnail" class="block text-gray-700">Thumbnail</label>
            <input type="file" class="mt-1 block w-full border-gray-300 rounded-md shadow-sm" name="thumbnail" id="thumbnail" required>
        </div>
        <div class="mb-4">
            <label for="status" class="block text-gray-700">Pendaftaran</label>
            <select class="mt-1 block w-full border-gray-300 rounded-md shadow-sm" name="status" id="status" required>
            <option value="buka">Menerima</option>
            <option value="tutup">Ditutup</option>
            </select>
        </div>
        <button type="submit" class="bg-blue-500 hover:bg-blue-700 text-white font-bold py-2 px-4 rounded">Simpan</button>
    </form>
</div>
<script src="https://cdn.tailwindcss.com"></script>
@endsection
