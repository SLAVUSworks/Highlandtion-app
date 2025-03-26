@extends('back.layouts.app')

@section('title', 'Edit Ruangan')

@section('content')
<div class="container mx-auto px-4 py-6">
    <h3 class="text-xl font-bold mb-4">Edit Ruangan</h3>
    <form action="{{ route('back.ruangan.update', $ruangan) }}" method="POST">
        @csrf
        @method('PUT')
        
        <div class="mb-4">
            <label for="nama_ruangan" class="block text-gray-700 font-medium mb-2">Nama Ruangan</label>
            <input type="text" id="nama_ruangan" name="nama_ruangan" value="{{ old('nama_ruangan', $ruangan->nama_ruangan) }}" 
                   class="block w-full border rounded py-2 px-3 focus:outline-none focus:ring focus:ring-blue-500" required>
        </div>
        
        <div class="mb-4">
            <label for="kuota" class="block text-gray-700 font-medium mb-2">Kuota</label>
            <input type="number" id="kuota" name="kuota" value="{{ old('kuota', $ruangan->kuota) }}" 
                   class="block w-full border rounded py-2 px-3 focus:outline-none focus:ring focus:ring-blue-500" required>
        </div>
        
        <div class="mb-4">
            <label for="menu_id" class="block text-gray-700 font-medium mb-2">Menu</label>
            <select id="menu_id" name="menu_id" 
                    class="block w-full border rounded py-2 px-3 focus:outline-none focus:ring focus:ring-blue-500" required>
                @foreach($menus as $menu)
                    <option value="{{ $menu->id }}" {{ $menu->id == old('menu_id', $ruangan->menu_id) ? 'selected' : '' }}>
                        {{ $menu->menuCategory->name }} - {{ $menu->mata_pelajaran }} - {{ $menu->tingkat }}
                    </option>
                @endforeach
            </select>
        </div>
        
        <button type="submit" class="bg-blue-500 text-white py-2 px-4 rounded hover:bg-blue-600">Simpan</button>
    </form>
</div>
    <script src="https://cdn.tailwindcss.com"></script>

@endsection
