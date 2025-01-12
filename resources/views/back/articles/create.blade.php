@extends('back.layouts.app')

@section('title', 'Tambah Artikel')

@section('content')
<div class="container mx-auto px-4 py-6">
    <h1 class="text-2xl font-bold mb-4">Tambah Artikel</h1>
    <form action="{{ route('back.articles.store') }}" method="POST" enctype="multipart/form-data">
        @csrf
        <div class="mb-4">
            <label for="title" class="block text-gray-700 font-bold mb-2">Judul</label>
            <input type="text" id="title" name="title" class="w-full border-gray-300 rounded-lg px-4 py-2" value="{{ old('title') }}" required>
        </div>
        <div class="mb-4">
            <label for="category" class="block text-gray-700 font-bold mb-2">Kategori</label>
            <input type="text" id="category" name="category" class="w-full border-gray-300 rounded-lg px-4 py-2" value="{{ old('category') }}" required>
        </div>
        <div class="mb-4">
            <label for="desc" class="block text-gray-700 font-bold mb-2">Deskripsi</label>
            <textarea id="desc" name="desc" rows="5" class="w-full border-gray-300 rounded-lg px-4 py-2" required>{{ old('desc') }}</textarea>
        </div>
        <div class="mb-4">
            <label for="img" class="block text-gray-700 font-bold mb-2">Gambar</label>
            <input type="file" id="img" name="img" class="w-full border-gray-300 rounded-lg px-4 py-2" required>
        </div>
        <div class="mb-4">
            <label for="status" class="block text-gray-700 font-bold mb-2">Status</label>
            <select id="status" name="status" class="w-full border-gray-300 rounded-lg px-4 py-2" required>
                <option value="draft">Draft</option>
                <option value="published">Published</option>
            </select>
        </div>
        <div class="mb-4">
            <label for="publish_date" class="block text-gray-700 font-bold mb-2">Tanggal Publikasi</label>
            <input type="date" id="publish_date" name="publish_date" class="w-full border-gray-300 rounded-lg px-4 py-2" value="{{ old('publish_date') }}" required>
        </div>
        <button type="submit" class="bg-green-500 hover:bg-green-700 text-white font-bold py-2 px-4 rounded">
            Simpan
        </button>
    </form>
</div>
@endsection
