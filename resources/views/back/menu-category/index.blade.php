@extends('back.layouts.app')

@section('title', 'Daftar Kategori Menu')

@section('content')
<div class="container mx-auto p-6" x-data="{ openCreateModal: false, openEditModal: false, editId: '', editName: '', editIcon: '' }">
    <h1 class="text-2xl font-bold mb-4">Daftar Kategori Menu</h1>

    <button @click="openCreateModal = true" class="bg-blue-600 text-white px-4 py-2 font-bold rounded-lg hover:bg-blue-700 transition">
        Tambah Kategori
    </button>

    <div x-show="openCreateModal" x-data="{ processing: false }" 
    class="fixed inset-0 bg-black bg-opacity-50 flex items-center justify-center">
        <div class="bg-white p-6 rounded-lg shadow-lg w-1/3">
            <h2 class="text-xl font-bold mb-4">Tambah Kategori</h2>
            <form @submit.prevent="console.log('Form submitted'); processing = true; openCreateModal = false; $el.submit();"
            action="{{ route('back.menu-category.store') }}" 
            method="POST" 
            enctype="multipart/form-data">
                      @csrf
                <div class="mb-4">
                    <label class="block text-gray-700 font-medium">Nama Kategori</label>
                    <input type="text" name="name" class="w-full px-4 py-2 border rounded-lg focus:ring focus:ring-blue-300" required>
                </div>
                <div class="mb-4">
                    <label class="block text-gray-700 font-medium">Upload Icon</label>
                    <input type="file" name="icon" class="w-full px-4 py-2 border rounded-lg focus:ring focus:ring-blue-300" required>
                </div>
                <div class="flex justify-end">
                    <button type="button" @click="openCreateModal = false" class="bg-gray-500 text-white px-4 py-2 rounded-lg mr-2">
                        Batal
                    </button>
                    <button type="submit" class="bg-blue-600 text-white px-4 py-2 rounded-lg">
                        Simpan
                    </button>
                </div>
            </form>
        </div>
    </div>

    <div class="overflow-x-auto bg-white shadow-md rounded-lg mt-6">
        <table class="w-full border-collapse">
            <thead>
                <tr class="bg-gray-200 text-gray-700">
                    <th class="px-4 py-2 text-left">Nama Kategori</th>
                    <th class="px-4 py-2 text-left">Icon</th>
                    <th class="px-4 py-2 text-center">Aksi</th>
                </tr>
            </thead>
            <tbody>
                @foreach($menuCategories as $category)
                <tr class="border-t hover:bg-gray-100 transition">
                    <td class="px-4 py-2">{{ $category->name }}</td>
                    <td class="px-4 py-2">
                        <img src="{{ asset('storage/' . $category->icon) }}" alt="Icon" class="w-12 h-12 object-cover rounded-lg">
                    </td>
                    <td class="px-4 py-2 text-center">
                        <button @click="openEditModal = true; editId = '{{ $category->id }}'; editName = '{{ $category->name }}'; editIcon = '{{ asset('storage/' . $category->icon) }}'"
                            class="bg-yellow-500 text-white px-3 py-1 rounded-lg hover:bg-yellow-600 transition">
                            Edit
                        </button>
                        <form id="delete-form-{{ $category->id }}" action="{{ route('back.menu-category.destroy', $category->id) }}" method="POST" class="inline-block">
                            @csrf
                            @method('DELETE')
                            <button type="button" class="bg-red-600 text-white px-3 py-1 rounded-lg hover:bg-red-700 transition"
                                onclick="confirmDelete({{ $category->id }})">
                                Hapus
                            </button>
                        </form>
                    </td>
                </tr>
                @endforeach
            </tbody>
        </table>
    </div>

    <div x-show="openEditModal" class="fixed inset-0 bg-black bg-opacity-50 flex items-center justify-center">
        <div class="bg-white p-6 rounded-lg shadow-lg w-1/3">
            <h2 class="text-xl font-bold mb-4">Edit Kategori</h2>
            <form :action="'/back/menu-category/' + editId" method="POST" enctype="multipart/form-data">
                @csrf
                @method('PUT')
                <div class="mb-4">
                    <label class="block text-gray-700 font-medium">Nama Kategori</label>
                    <input type="text" name="name" x-model="editName" class="w-full px-4 py-2 border rounded-lg focus:ring focus:ring-blue-300" required>
                </div>
                <div class="mb-4">
                    <label class="block text-gray-700 font-medium">Upload Icon</label>
                    <input type="file" name="icon" class="w-full px-4 py-2 border rounded-lg focus:ring focus:ring-blue-300">
                </div>
                <div class="mb-4">
                    <label class="block text-gray-700 font-medium">Icon Saat Ini</label>
                    <img :src="editIcon" class="w-16 h-16 object-cover rounded-lg">
                </div>
                <div class="flex justify-end">
                    <button type="button" @click="openEditModal = false" class="bg-gray-500 text-white px-4 py-2 rounded-lg mr-2">
                        Batal
                    </button>
                    <button type="submit" class="bg-blue-600 text-white px-4 py-2 rounded-lg">
                        Simpan Perubahan
                    </button>
                </div>
            </form>
        </div>
    </div>
</div>
<script>
    function confirmDelete(id) {
        Swal.fire({
            title: "Yakin mau hapus?",
            text: "Menghapus kategori akan menghapus menu yang terkait.",
            icon: "warning",
            showCancelButton: true,
            confirmButtonColor: "#d33",
            cancelButtonColor: "#3085d6",
            confirmButtonText: "Ya, hapus!",
            cancelButtonText: "Batal"
        }).then((result) => {
            if (result.isConfirmed) {
                document.getElementById(`delete-form-${id}`).submit();
            }
        });
    }
</script>
@endsection
