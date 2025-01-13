@extends('back.layouts.app')

@section('content')
    <div class="container mx-auto py-8">
        <div class="text-center mb-8">
            <h1 class="text-3xl font-bold">Edit Halaman Kontak</h1>
        </div>

        @if (session('success'))
            <div class="bg-green-500 text-white p-4 rounded mb-4">
                {{ session('success') }}
            </div>
        @endif

        <form action="{{ route('back.contact.update') }}" method="POST">
            @csrf
            @method('PUT')

            <div class="mb-4">
                <label for="title" class="block text-gray-700">Judul</label>
                <input type="text" id="title" name="title" value="{{ old('title', $contactPage->title) }}" class="w-full px-4 py-2 border border-gray-300 rounded-lg mt-2" required>
            </div>

            <div class="mb-4">
                <label for="description" class="block text-gray-700">Deskripsi</label>
                <textarea id="desc" name="description" class="ckeditor w-full px-4 py-2 border border-gray-300 rounded-lg mt-2" rows="6" required>{{ old('description', $contactPage->description) }}</textarea>
            </div>

            <div class="mb-4 text-center">
                <button type="submit" class="bg-blue-500 text-white px-6 py-2 rounded-lg hover:bg-blue-600">
                    Simpan Perubahan
                </button>
            </div>
        </form>
    </div>

    <!-- CDN CKEditor 4 -->
    <script src="https://cdnjs.cloudflare.com/ajax/libs/ckeditor/4.9.2/ckeditor.js" integrity="sha512-OF6VwfoBrM/wE3gt0I/lTh1ElROdq3etwAquhEm2YI45Um4ird+0ZFX1IwuBDBRufdXBuYoBb0mqXrmUA2VnOA==" crossorigin="anonymous" referrerpolicy="no-referrer"></script>    
    <!-- Script CKEditor dengan Laravel Filemanager -->
    <script>
        var options = {
            filebrowserImageBrowseUrl: '/laravel-filemanager?type=Images',
            filebrowserImageUploadUrl: '/laravel-filemanager/upload?type=Images&_token={{ csrf_token() }}',
            filebrowserBrowseUrl: '/laravel-filemanager?type=Files',
            filebrowserUploadUrl: '/laravel-filemanager/upload?type=Files&_token={{ csrf_token() }}'
        };

        // Inisialisasi CKEditor
        CKEDITOR.replace('desc', options);
    </script>
@endsection
