@extends('back.layouts.app')

@section('title', 'Buat Event')

@section('content')
<div class="container mx-auto">
    <div class="mb-6 rounded-lg bg-white/60 backdrop-blur px-6 py-4 shadow-sm border border-gray-200">
        <h1 class="flex items-center gap-3 text-3xl font-semibold text-gray-800">
            <span class="h-8 w-1.5 rounded-full bg-teal-500"></span>
            Tambah Event
        </h1>
        <p class="mt-1 text-sm text-gray-500">
            Buat event baru
        </p>
    </div>
    <div class="mt-4 rounded-lg bg-white p-5 shadow-sm border border-gray-100">
        <form action="{{ route('back.menu.store') }}" method="POST" enctype="multipart/form-data">
            @csrf
            <div class="mb-4">
                <label for="mata_pelajaran" class="block text-gray-700">Event</label>
                <input type="text" class="w-full px-4 py-2 border rounded-lg focus:ring focus:ring-blue-300" name="mata_pelajaran" id="mata_pelajaran" required>
            </div>
            <div class="mb-4">
                <label for="menu_category_id" class="block text-gray-700">Kategori Menu</label>
                <select class="w-full px-4 py-2 border rounded-lg focus:ring focus:ring-blue-300" name="menu_category_id" id="menu_category_id" required>
                    <option value="" disabled selected>Pilih Kategori</option>
                    @foreach($menuCategories as $category)
                        <option value="{{ $category->id }}">{{ $category->name }}</option>
                    @endforeach
                </select>
            </div>
            <div class="mb-4">
                <label for="deskripsi" class="block text-gray-700">Deskripsi</label>
                <textarea type="text" class="w-full px-4 py-2 border rounded-lg focus:ring focus:ring-blue-300" name="deskripsi" id="deskripsi" required></textarea>
            </div>
            <div class="mb-4">
                <label for="short_code_1" class="block text-gray-700">Kode Singkat</label>
                <div class="flex space-x-2">
                    <input type="text" maxlength="1" id="short_code_1" 
                        class="w-14 h-14 text-center text-2xl uppercase border-2 border-gray-400 rounded-md focus:border-blue-500 focus:ring-2 focus:ring-blue-300 transition-all" required>
                    <input type="text" maxlength="1" id="short_code_2" 
                        class="w-14 h-14 text-center text-2xl uppercase border-2 border-gray-400 rounded-md focus:border-blue-500 focus:ring-2 focus:ring-blue-300 transition-all" required>
                    <input type="text" maxlength="1" id="short_code_3" 
                        class="w-14 h-14 text-center text-2xl uppercase border-2 border-gray-400 rounded-md focus:border-blue-500 focus:ring-2 focus:ring-blue-300 transition-all" required>
                    <input type="text" maxlength="1" id="short_code_4" 
                        class="w-14 h-14 text-center text-2xl uppercase border-2 border-gray-400 rounded-md focus:border-blue-500 focus:ring-2 focus:ring-blue-300 transition-all" required>
                </div>
                <input type="hidden" name="short_code" id="short_code">
            </div>    
            <div class="mb-4">
                <label for="tingkat" class="block text-gray-700">Tingkat</label>
                <select class="w-full px-4 py-2 border rounded-lg focus:ring focus:ring-blue-300" name="tingkat" id="tingkat" required>
                <option value="SD">SD</option>
                <option value="SMP/MTs">SMP/MTs</option>
                <option value="SMA/MA">SMA/MA</option>
                </select>
            </div>
            <div class="mb-4">
                <label for="harga" class="block text-gray-700">Harga</label>
                <div class="relative">
                    <span class="absolute inset-y-0 left-0 pl-3 flex items-center text-gray-500">Rp</span>
                    <input type="text" class="pl-10 border-gray-300 w-full px-4 py-2 border rounded-lg focus:ring focus:ring-blue-300" id="harga" required>
                    <input type="hidden" name="harga" id="hargaHidden">
                </div>
                
                <script>
                    document.addEventListener("DOMContentLoaded", function () {
                        const priceInput = document.getElementById("harga");
                        const hiddenInput = document.getElementById("hargaHidden");
                
                        priceInput.addEventListener("input", function () {
                            let value = priceInput.value.replace(/\D/g, "");
                            let formattedValue = new Intl.NumberFormat("id-ID").format(value);
                            priceInput.value = formattedValue;
                        });
                
                        priceInput.addEventListener("blur", function () {
                            let cleanValue = priceInput.value.replace(/\D/g, "");
                            hiddenInput.value = cleanValue;
                        });
                    });
                </script>            
            </div>
            <div class="mb-4">
                <label for="kuota" class="block text-gray-700">Kuota</label>
                <input type="number" class="w-full px-4 py-2 border rounded-lg focus:ring focus:ring-blue-300" name="kuota" id="kuota" required>
            </div>
            <div class="mb-4">
                <label for="icon" class="block text-gray-700">Icon</label>
                <input type="file" class="w-full text-sm text-gray-600 file:mr-4 file:py-2 file:px-4 file:rounded-lg file:border-0 file:text-sm file:font-semibold file:bg-sky-50 file:text-sky-700 hover:file:bg-sky-100 border border-gray-300 rounded-lg cursor-pointer" name="icon" id="icon" required>
            </div>
            <div class="mb-4">
                <label for="thumbnail" class="block text-gray-700">Thumbnail</label>
                <input type="file" class="w-full text-sm text-gray-600 file:mr-4 file:py-2 file:px-4 file:rounded-lg file:border-0 file:text-sm file:font-semibold file:bg-sky-50 file:text-sky-700 hover:file:bg-sky-100 border border-gray-300 rounded-lg cursor-pointer" name="thumbnail" id="thumbnail" required>
            </div>
            <div class="mb-4">
                <label for="status" class="block text-gray-700">Status Pendaftaran</label>
                <select class="w-full px-4 py-2 border rounded-lg focus:ring focus:ring-blue-300" name="status" id="status" required>
                <option value="buka">Menerima</option>
                <option value="tutup">Ditutup</option>
                </select>
            </div>
            <button type="submit" class="bg-blue-500 hover:bg-blue-700 text-white font-bold py-2 px-4 rounded">Simpan</button>
        </form>
    </div>
</div>
<script>
    document.addEventListener("DOMContentLoaded", function() {
        const inputs = document.querySelectorAll("[id^=short_code_]");
    
        inputs.forEach((input, index) => {
            input.addEventListener("input", function() {
                this.value = this.value.toUpperCase();
                if (this.value.length === 1 && index < inputs.length - 1) {
                    inputs[index + 1].focus();
                }
                updateShortCode();
            });
    
            input.addEventListener("keydown", function(e) {
                if (e.key === "Backspace" && !this.value && index > 0) {
                    inputs[index - 1].focus();
                }
            });
        });
    
        function updateShortCode() {
            document.getElementById("short_code").value = Array.from(inputs).map(input => input.value).join("").toUpperCase();
        }
    });
</script>
@endsection
