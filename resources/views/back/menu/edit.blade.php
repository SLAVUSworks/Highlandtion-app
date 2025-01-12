@extends('back.layouts.app')

@section('title', 'Edit Menu')

@section('content')
<div class="container mx-auto px-4 py-6">
    <h1 class="text-2xl font-bold mb-6">Edit Menu</h1>
    <form action="{{ route('back.menu.update', $menu) }}" method="POST" enctype="multipart/form-data">
        @csrf
        @method('PUT')
        <div class="mb-4">
            <label for="mata_pelajaran" class="block text-sm font-medium text-gray-700">Mata Pelajaran</label>
            <input type="text" class="mt-1 block w-full border-gray-300 rounded-md shadow-sm focus:border-indigo-500 focus:ring-indigo-500" name="mata_pelajaran" id="mata_pelajaran" value="{{ $menu->mata_pelajaran }}" required>
        </div>
        <div class="mb-4">
            <label for="deskripsi" class="block text-sm font-medium text-gray-700">Deskripsi</label>
            <textarea class="mt-1 block w-full border-gray-300 rounded-md shadow-sm focus:border-indigo-500 focus:ring-indigo-500" name="deskripsi" id="deskripsi" required>{{ $menu->deskripsi }}</textarea>
        </div>
        <div class="mb-4">
            <label for="tingkat" class="block text-sm font-medium text-gray-700">Tingkat</label>
            <select class="mt-1 block w-full border-gray-300 rounded-md shadow-sm focus:border-indigo-500 focus:ring-indigo-500" name="tingkat" id="tingkat" required>
            <option value="SD" {{ $menu->tingkat == 'SD' ? 'selected' : '' }}>SD</option>
            <option value="SMP/MTs" {{ $menu->tingkat == 'SMP/MTs' ? 'selected' : '' }}>SMP/MTs</option>
            <option value="SMA/MA" {{ $menu->tingkat == 'SMA/MA' ? 'selected' : '' }}>SMA/MA</option>
            </select>
        </div>
        <div class="mb-4">
            <label for="harga" class="block text-sm font-medium text-gray-700">Harga</label>
            <input type="number" class="mt-1 block w-full border-gray-300 rounded-md shadow-sm focus:border-indigo-500 focus:ring-indigo-500" name="harga" id="harga" value="{{ $menu->harga }}" required>
        </div>
        <div class="mb-4">
            <label for="kuota" class="block text-sm font-medium text-gray-700">Kuota</label>
            <input type="number" class="mt-1 block w-full border-gray-300 rounded-md shadow-sm focus:border-indigo-500 focus:ring-indigo-500" name="kuota" id="kuota" value="{{ $menu->kuota }}" required>
        </div>
        <div class="mb-4">
            <label for="icon" class="block text-sm font-medium text-gray-700">Icon</label>
            @if ($menu->icon)
            <img src="{{ asset('storage/' . $menu->icon) }}" alt="Current Icon" class="my-2 w-24 h-24 object-cover" />
            @endif
            <input type="file" class="mt-1 block w-full border-gray-300 rounded-md shadow-sm focus:border-indigo-500 focus:ring-indigo-500" name="icon" id="icon">
        </div>
        <div class="mb-4">
            <label for="thumbnail" class="block text-sm font-medium text-gray-700">Thumbnail</label>
            @if ($menu->thumbnail)
            <img src="{{ asset('storage/' . $menu->thumbnail) }}" alt="Current Thumbnail" class="my-2 w-24 h-24 object-cover" />
            @endif
            <input type="file" class="mt-1 block w-full border-gray-300 rounded-md shadow-sm focus:border-indigo-500 focus:ring-indigo-500" name="thumbnail" id="thumbnail">
        </div>
        <button type="submit" class="px-4 py-2 bg-indigo-600 text-white rounded-md shadow-sm hover:bg-indigo-700 focus:outline-none focus:ring-2 focus:ring-offset-2 focus:ring-indigo-500">Update</button>
    </form>
</div>
<script src="https://cdn.tailwindcss.com"></script>
@endsection
