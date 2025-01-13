@extends('back.layouts.app')

@section('title', 'Edit Artikel')

@section('content')
<div class="container mx-auto px-4 py-6">
    <h1 class="text-2xl font-bold mb-4">Edit Artikel</h1>
    <form action="{{ route('back.articles.update', $article) }}" method="POST" enctype="multipart/form-data">
        @csrf
        @method('PUT')
        <div class="mb-4">
            <label for="title" class="block text-gray-700 font-bold mb-2">Judul</label>
            <input type="text" id="title" name="title" class="w-full border-gray-300 rounded-lg px-4 py-2" value="{{ old('title', $article->title) }}" required>
        </div>
        <div class="mb-4">
            <label for="category" class="block text-gray-700 font-bold mb-2">Kategori</label>
            <input type="text" id="category" name="category" class="w-full border-gray-300 rounded-lg px-4 py-2" value="{{ old('category', $article->category) }}" required>
        </div>
        <div class="mb-4">
            <label for="desc" class="block text-gray-700 font-bold mb-2">Deskripsi</label>
            <textarea id="desc" name="desc" rows="5" class="w-full border-gray-300 rounded-lg px-4 py-2" required>{{ old('desc', $article->desc) }}</textarea>
        </div>
        <div class="mb-4">
            <label for="img" class="block text-gray-700 font-bold mb-2">Gambar</label>
            <input type="file" id="img" name="img" class="w-full border-gray-300 rounded-lg px-4 py-2">
            @if ($article->img)
            <img src="{{ url('storage/' . $article->img) }}" alt="{{ $article->title }}" class="mt-2 w-32">
            @endif
        </div>
        <div class="mb-4">
            <label for="status" class="block text-gray-700 font-bold mb-2">Status</label>
            <select id="status" name="status" class="w-full border-gray-300 rounded-lg px-4 py-2" required>
                <option value="draft" {{ old('status', $article->status) === 'draft' ? 'selected' : '' }}>Draft</option>
                <option value="published" {{ old('status', $article->status) === 'published' ? 'selected' : '' }}>Published</option>
            </select>
        </div>
        <div class="mb-4">
            <label for="publish_date" class="block text-gray-700 font-bold mb-2">Tanggal Publikasi</label>
            <input type="date" id="publish_date" name="publish_date" class="w-full border-gray-300 rounded-lg px-4 py-2" value="{{ old('publish_date', $article->publish_date) }}" required>
        </div>
        <button type="submit" class="bg-green-500 hover:bg-green-700 text-white font-bold py-2 px-4 rounded">
            Update
        </button>
    </form>
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
