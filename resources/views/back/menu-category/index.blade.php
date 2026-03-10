@extends('back.layouts.app')

@section('title', 'Daftar Kategori Event')

@section('content')
<div class="container mx-auto">
    <div class="mb-6 rounded-lg bg-white/60 backdrop-blur px-6 py-4 shadow-sm border border-gray-200">
        <h1 class="flex items-center gap-3 text-3xl font-semibold text-gray-800">
            <span class="h-8 w-1.5 rounded-full bg-teal-500"></span>
            Daftar Kategori Event
        </h1>
        <p class="mt-1 text-sm text-gray-500">
            Tabel Kategori Event
        </p>
    </div>
    <div class="mt-4 rounded-lg bg-white p-5 shadow-sm border border-gray-100">
        <button onclick="showCreateModal()" class="bg-blue-600 text-white px-4 py-2 font-bold rounded-lg hover:bg-blue-700 transition">
            Tambah Kategori
        </button>

        <div id="createModal" class="hidden fixed inset-0 bg-black bg-opacity-50 flex items-center justify-center">
            <div class="bg-white p-6 rounded-lg shadow-lg w-1/3">
                <h2 class="text-xl font-bold mb-4">Tambah Kategori</h2>
                <form action="{{ route('back.menu-category.store') }}" method="POST" enctype="multipart/form-data">
                    @csrf
                    <div class="mb-4">
                        <label class="block text-gray-700 font-medium">Nama Kategori</label>
                        <input type="text" name="name" class="w-full px-4 py-2 border rounded-lg focus:ring focus:ring-blue-300" required>
                    </div>
                    <div class="mb-4">
                        <label class="block text-gray-700 font-medium">Upload Icon</label>
                        <input type="file" name="icon" class="w-full text-sm text-gray-600 file:mr-4 file:py-2 file:px-4 file:rounded-lg file:border-0 file:text-sm file:font-semibold file:bg-sky-50 file:text-sky-700 hover:file:bg-sky-100 border border-gray-300 rounded-lg cursor-pointer" required>
                    </div>
                    <div class="flex justify-end">
                        <button type="button" onclick="hideCreateModal()" class="bg-gray-500 text-white px-4 py-2 rounded-lg mr-2">
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
                            <button onclick="showEditModal('{{ $category->id }}', '{{ $category->name }}', '{{ asset('storage/' . $category->icon) }}')"
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
    </div>
    <div id="editModal" class="hidden fixed inset-0 bg-black bg-opacity-50 flex items-center justify-center">
        <div class="bg-white p-6 rounded-lg shadow-lg w-1/3">
            <h2 class="text-xl font-bold mb-4">Edit Kategori</h2>
            <form id="editForm" method="POST" enctype="multipart/form-data">
                @csrf
                @method('PUT')
                <div class="mb-4">
                    <label class="block text-gray-700 font-medium">Nama Kategori</label>
                    <input type="text" name="name" id="editName" class="w-full px-4 py-2 border rounded-lg focus:ring focus:ring-blue-300" required>
                </div>
                <div class="mb-4">
                    <label class="block text-gray-700 font-medium">Upload Icon</label>
                    <input type="file" name="icon" class="w-full text-sm text-gray-600 file:mr-4 file:py-2 file:px-4 file:rounded-lg file:border-0 file:text-sm file:font-semibold file:bg-sky-50 file:text-sky-700 hover:file:bg-sky-100 border border-gray-300 rounded-lg cursor-pointer">
                </div>
                <div class="mb-4">
                    <label class="block text-gray-700 font-medium">Icon Saat Ini</label>
                    <img id="editIcon" class="w-16 h-16 object-cover rounded-lg">
                </div>
                <div class="flex justify-end">
                    <button type="button" onclick="hideEditModal()" class="bg-gray-500 text-white px-4 py-2 rounded-lg mr-2">
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
    function showCreateModal() {
        document.getElementById("createModal").classList.remove("hidden");
    }

    function hideCreateModal() {
        document.getElementById("createModal").classList.add("hidden");
    }

    function showEditModal(id, name, icon) {
        document.getElementById("editModal").classList.remove("hidden");
        document.getElementById("editName").value = name;
        document.getElementById("editIcon").src = icon;
        document.getElementById("editForm").action = "/back/menu-category/" + id;
    }

    function hideEditModal() {
        document.getElementById("editModal").classList.add("hidden");
    }

    function confirmDelete(id) {
        if (confirm("Apakah Anda yakin ingin menghapus kategori ini?")) {
            document.getElementById("delete-form-" + id).submit();
        }
    }
</script>

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
@if (session('error'))
<script>
    Swal.fire({
        icon: 'error',
        title: 'Gagal',
        text: "{{ session('error') }}",
    });
</script>
@endif
@if (session('success'))
<script>
    Swal.fire({
        icon: 'success',
        title: 'Berhasil',
        text: "{{ session('success') }}",
    });
</script>
@endif
@endsection
