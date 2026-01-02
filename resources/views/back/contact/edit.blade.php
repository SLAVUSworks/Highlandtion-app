@extends('back.layouts.app')

@section('content')
    <div class="container mx-auto">
        <div class="mb-6 rounded-lg bg-white/60 backdrop-blur px-6 py-4 shadow-sm border border-gray-200">
            <h1 class="flex items-center gap-3 text-3xl font-semibold text-gray-800">
                <span class="h-8 w-1.5 rounded-full bg-teal-500"></span>
                Kontak
            </h1>
            <p class="mt-1 text-sm text-gray-500">
                Edit halaman kontak dengan HTML
            </p>
        </div>
        <div class="mt-4 rounded-lg bg-white p-5 shadow-sm border border-gray-100">

            <form action="{{ route('back.contact.update') }}" method="POST">
                @csrf
                @method('PUT')

                <div class="mb-4">
                    <label for="title" class="block text-gray-700">Judul</label>
                    <input type="text" id="title" name="title" value="{{ old('title', $contactPage->title) }}" 
                        class="w-full px-4 py-2 border border-gray-300 rounded-lg mt-2" required>
                </div>

                <div class="mb-4">
                    <div class="flex items-center">
                        <label for="description" class="block text-gray-700 mr-2">Deskripsi</label>
                        <button type="button" id="undoButton" class="flex items-center text-gray-500 hover:text-red-500 transition text-sm">
                            <i class="fa-solid fa-rotate-left text-base"></i>
                            <span class="ml-1">Undo</span>
                        </button>
                    </div>
                    
                    <textarea id="desc" name="description" class="hidden">{{ old('description', $contactPage->description) }}</textarea>    
                </div>

                <div class="mb-4 text-center">
                    <button type="submit" class="bg-blue-500 text-white px-6 py-2 rounded-lg hover:bg-blue-600">
                        Simpan Perubahan
                    </button>
                </div>
            </form>
        </div>
    </div>

    <!-- Load CodeMirror -->
    <link rel="stylesheet" href="https://cdnjs.cloudflare.com/ajax/libs/codemirror/5.65.5/codemirror.min.css">
    <link rel="stylesheet" href="https://cdnjs.cloudflare.com/ajax/libs/codemirror/5.65.5/theme/material-darker.min.css">
    <script src="https://cdnjs.cloudflare.com/ajax/libs/codemirror/5.65.5/codemirror.min.js"></script>
    <script src="https://cdnjs.cloudflare.com/ajax/libs/codemirror/5.65.5/mode/htmlmixed/htmlmixed.min.js"></script>
    <script src="https://cdnjs.cloudflare.com/ajax/libs/codemirror/5.65.5/mode/xml/xml.min.js"></script>
    <script src="https://cdnjs.cloudflare.com/ajax/libs/codemirror/5.65.5/mode/javascript/javascript.min.js"></script>
    <script src="https://cdnjs.cloudflare.com/ajax/libs/codemirror/5.65.5/mode/css/css.min.js"></script>
    <script src="https://cdnjs.cloudflare.com/ajax/libs/codemirror/5.65.5/addon/edit/matchbrackets.min.js"></script>
    <script src="https://cdnjs.cloudflare.com/ajax/libs/codemirror/5.65.5/addon/edit/closetag.min.js"></script>

    <script>
        document.addEventListener("DOMContentLoaded", function() {
            @if (session('success'))
                Swal.fire({
                    icon: 'success',
                    title: 'Berhasil!',
                    text: '{{ session("success") }}',
                    confirmButtonColor: '#3085d6',
                    confirmButtonText: 'OK'
                });
            @endif
        });
    </script>

    <script>
        document.addEventListener("DOMContentLoaded", function() {
            var textarea = document.getElementById("desc");

            var editor = CodeMirror.fromTextArea(textarea, {
                mode: "htmlmixed",
                lineNumbers: true,
                theme: "material-darker",
                matchBrackets: true,
                autoCloseTags: true,
            });

            editor.setSize("100%", "100%");
            document.querySelector(".CodeMirror").classList.add("rounded-lg", "border", "border-gray-300", "p-2");

            document.querySelector("form").addEventListener("submit", function(event) {
                textarea.value = editor.getValue();
            });

            document.getElementById("undoButton").addEventListener("click", function() {
                editor.setValue(textarea.defaultValue);
            });
        });
    </script>
@endsection
