@extends('back.layouts.app')

@section('content')
<div class="container mx-auto p-6 bg-white rounded shadow">
    <h3 class="text-xl font-bold mb-4">Tambah Ruangan</h3>
    <form action="{{ route('back.ruangan.store') }}" method="POST">
        @csrf
        <div class="mb-4">
            <label for="nama_ruangan" class="block text-gray-700 font-medium mb-2">Nama Ruangan</label>
            <input type="text" id="nama_ruangan" name="nama_ruangan" 
                   class="block w-full border rounded py-2 px-3 focus:outline-none focus:ring focus:ring-blue-500" required>
        </div>
        <div class="mb-4">
            <label for="kuota" class="block text-gray-700 font-medium mb-2">Kuota</label>
            <input type="number" id="kuota" name="kuota" 
                   class="block w-full border rounded py-2 px-3 focus:outline-none focus:ring focus:ring-blue-500" required>
        </div>
        <div class="mb-4">
            <label for="menu_id" class="block text-gray-700 font-medium mb-2">Menu</label>
            <select id="menu_id" name="menu_id" 
                    class="block w-full border rounded py-2 px-3 focus:outline-none focus:ring focus:ring-blue-500" required>
                @foreach($menus as $menu)
                <option value="{{ $menu->id }}">{{ $menu->mata_pelajaran }} - {{ $menu->tingkat }}</option>
                @endforeach
            </select>
        </div>
        <button type="submit" class="bg-blue-500 text-white py-2 px-4 rounded hover:bg-blue-600">Simpan</button>
    </form>
</div>
@endsection
