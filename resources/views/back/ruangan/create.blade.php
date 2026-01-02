@extends('back.layouts.app')

@section('title', 'Tambah Ruangan')

@section('content')
<div class="container mx-auto">
    <div class="mb-6 rounded-lg bg-white/60 backdrop-blur px-6 py-4 shadow-sm border border-gray-200">
        <h1 class="flex items-center gap-3 text-3xl font-semibold text-gray-800">
            <span class="h-8 w-1.5 rounded-full bg-teal-500"></span>
            Tambah Ruangan
        </h1>
        <p class="mt-1 text-sm text-gray-500">
            Buat ruangan/lokasi event baru
        </p>
    </div>
    <div class="mt-4 rounded-lg bg-white p-5 shadow-sm border border-gray-100">
        <form action="{{ route('back.ruangan.store') }}" method="POST">
            @csrf
            <div class="mb-4">
                <label for="nama_ruangan" class="block text-gray-700 font-medium mb-2">Nama Ruangan</label>
                <input type="text" id="nama_ruangan" name="nama_ruangan" 
                    class="block w-full border rounded-lg py-2 px-3 focus:outline-none focus:ring focus:ring-blue-500" required>
            </div>
            <div class="mb-4">
                <label for="kuota" class="block text-gray-700 font-medium mb-2">Kuota</label>
                <input type="number" id="kuota" name="kuota" 
                    class="block w-full border rounded-lg py-2 px-3 focus:outline-none focus:ring focus:ring-blue-500" required>
            </div>
            <div class="mb-4">
                <label for="menu_id" class="block text-gray-700 font-medium mb-2">Menu</label>
                <select id="menu_id" name="menu_id" 
                        class="block w-full border rounded-lg py-2 px-3 focus:outline-none focus:ring focus:ring-blue-500" required>
                    @foreach($menus as $menu)
                    <option value="{{ $menu->id }}">{{ $menu->menuCategory->name }} - {{ $menu->mata_pelajaran }} - {{ $menu->tingkat }}</option>
                    @endforeach
                </select>
            </div>
            <button type="submit" class="bg-blue-500 text-white py-2 px-4 rounded-lg hover:bg-blue-600">Simpan</button>
        </form>
    </div>    
</div>
<script src="https://cdn.tailwindcss.com"></script>
@endsection
