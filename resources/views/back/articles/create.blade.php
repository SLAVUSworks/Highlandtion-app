@extends('back.layouts.app')

@section('title', 'Tambah Artikel')

@section('content')
<div class="container mx-auto">
    <div class="mb-6 rounded-lg bg-white/60 backdrop-blur px-6 py-4 shadow-sm border border-gray-200">
        <h1 class="flex items-center gap-3 text-3xl font-semibold text-gray-800">
            <span class="h-8 w-1.5 rounded-full bg-teal-500"></span>
            Tambah Artikel
        </h1>
        <p class="mt-1 text-sm text-gray-500">
            Buat artikel baru
        </p>
    </div>
    <div class="mt-4 rounded-lg bg-white p-5 shadow-sm border border-gray-100">
        <form action="{{ route('back.articles.store') }}" method="POST" enctype="multipart/form-data">
            @csrf
            <div class="mb-4">
                <label for="title" class="block text-gray-700 font-bold mb-2">Judul</label>
                <input type="text" id="title" name="title" class="w-full px-4 py-2 border rounded-lg focus:ring focus:ring-blue-300" value="{{ old('title') }}" required>
            </div>
            <div class="mb-4">
                <label for="category" class="block text-gray-700 font-bold mb-2">Kategori</label>
                <input type="text" id="category" name="category" class="w-full px-4 py-2 border rounded-lg focus:ring focus:ring-blue-300" value="{{ old('category') }}" required>
            </div>
            <div class="mb-4">
                <label for="desc" class="block text-gray-700 font-bold mb-2">Deskripsi</label>
                <textarea id="desc" name="desc" rows="5" class="w-full px-4 py-2 border rounded-lg focus:ring focus:ring-blue-300" required>{{ old('desc') }}</textarea>
            </div>
            <div class="mb-4">
                <label for="img" class="block text-gray-700 font-bold mb-2">Gambar</label>
                <input type="file" id="img" name="img" class="w-full text-sm text-gray-600 file:mr-4 file:py-2 file:px-4 file:rounded-lg file:border-0 file:text-sm file:font-semibold file:bg-sky-50 file:text-sky-700 hover:file:bg-sky-100 border border-gray-300 rounded-lg cursor-pointer" required>
            </div>
            <div class="mb-4">
                <label for="status" class="block text-gray-700 font-bold mb-2">Status</label>
                <select id="status" name="status" class="w-full px-4 py-2 border rounded-lg focus:ring focus:ring-blue-300" required>
                    <option value="draft">Draft</option>
                    <option value="published">Published</option>
                </select>
            </div>
            <div class="mb-4">
                <label for="publish_date" class="block text-gray-700 font-bold mb-2">Tanggal Publikasi</label>
                <input type="date" id="publish_date" name="publish_date" class="w-full px-4 py-2 border rounded-lg focus:ring focus:ring-blue-300" value="{{ old('publish_date') }}" required>
            </div>
            <button type="submit" class="bg-green-500 hover:bg-green-700 text-white font-bold py-2 px-4 rounded">
                Simpan
            </button>
        </form>
    </div>
</div>


@endsection

@section('scripts')
<script src="https://cdnjs.cloudflare.com/ajax/libs/ckeditor/4.9.2/ckeditor.js" integrity="sha512-OF6VwfoBrM/wE3gt0I/lTh1ElROdq3etwAquhEm2YI45Um4ird+0ZFX1IwuBDBRufdXBuYoBb0mqXrmUA2VnOA==" crossorigin="anonymous" referrerpolicy="no-referrer"></script>
<script>
    var options = {
        filebrowserImageBrowseUrl: '/laravel-filemanager?type=Images',
        filebrowserImageUploadUrl: '/laravel-filemanager/upload?type=Images&_token=',
        filebrowserBrowseUrl: '/laravel-filemanager?type=Files',
        filebrowserUploadUrl: '/laravel-filemanager/upload?type=Files&_token='
    };
</script>
<script>
    CKEDITOR.replace('desc', options);
</script>
@endsection

