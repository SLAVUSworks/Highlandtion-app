@extends('back.layouts.app')

@section('title', 'Daftar Event')

@section('content')
<div class="container mx-auto">
    <div class="mb-6 rounded-lg bg-white/60 backdrop-blur px-6 py-4 shadow-sm border border-gray-200">
        <h1 class="flex items-center gap-3 text-3xl font-semibold text-gray-800">
            <span class="h-8 w-1.5 rounded-full bg-teal-500"></span>
            Daftar Event
        </h1>
        <p class="mt-1 text-sm text-gray-500">
            Tabel event
        </p>
    </div>
    <div class="mt-4 rounded-lg bg-white p-5 shadow-sm border border-gray-100">
        <a href="{{ route('back.menu.create') }}" class="bg-blue-600 hover:bg-blue-700 text-white font-bold py-2 px-4 rounded-lg mb-4 inline-block">
            Tambah Event
        </a>
        <div class="overflow-x-auto bg-white shadow-md rounded-lg">
            <table class="w-full border-collapse">
                <thead>
                    <tr class="bg-gray-200 text-gray-700">
                        <th class="px-4 py-2 text-left">No</th>
                        <th class="px-4 py-2 text-left">Icon</th>
                        <th class="px-4 py-2 text-left">Thumbnail</th>
                        <th class="px-4 py-2 text-left">Event</th>
                        <th class="px-4 py-2 text-left">Tingkat</th>
                        <th class="px-4 py-2 text-left">Kategori</th>
                        <th class="px-4 py-2 text-left">Harga</th>
                        <th class="px-4 py-2 text-left">Status</th>
                        <th class="px-4 py-2 text-center">Aksi</th>
                    </tr>
                </thead>
                <tbody>
                    @foreach ($menus as $menu)
                    <tr class="border-t hover:bg-gray-100 transition">
                        <td class="px-4 py-2">{{ $loop->iteration }}</td>
                        <td class="px-4 py-2">
                            <img src="{{ asset('storage/' . $menu->icon) }}" alt="Icon {{ $menu->mata_pelajaran }}" class="w-12 h-12 object-cover rounded-lg">
                        </td>
                        <td class="px-4 py-2">
                            <img src="{{ asset('storage/' . $menu->thumbnail) }}" alt="Thumbnail {{ $menu->mata_pelajaran }}" class="w-12 h-12 object-cover rounded-lg">
                        </td>
                        <td class="px-4 py-2">{{ $menu->mata_pelajaran }}</td>
                        <td class="px-4 py-2">{{ $menu->tingkat }}</td>
                        <td class="px-4 py-2">{{ $menu->menuCategory->name }}</td>
                        <td class="px-4 py-2">Rp.{{ number_format($menu->harga, 0, ',', '.') }}</td>
                        <td class="px-4 py-2">
                            <span class="px-2 py-1 text-white text-sm font-semibold rounded-lg 
                                {{ $menu->status === 'buka' ? 'bg-green-500' : 'bg-red-500' }}">
                                {{ $menu->status === 'buka' ? 'Menerima' : 'Ditutup' }}
                            </span>
                        </td>
                        <td class="px-4 py-2 text-center">
                            <div class="flex justify-center space-x-2">
                                <a href="{{ route('back.menu.edit', $menu) }}" class="bg-yellow-500 hover:bg-yellow-600 text-white px-3 py-1 rounded-lg transition">
                                    Edit
                                </a>
                                <form action="{{ route('back.menu.destroy', $menu->id) }}" method="POST" class="inline">
                                    @csrf
                                    @method('DELETE')

                                    <button
                                        type="button"
                                        class="bg-red-600 hover:bg-red-700 text-white px-3 py-1 rounded-lg transition"
                                        onclick="confirmDelete(this)">
                                        Hapus
                                    </button>
                                </form>
                            </div>
                        </td>
                    </tr>
                    @endforeach
                </tbody>
            </table>
        </div>
    </div>
</div>

<script>
function confirmDelete(button) {
    const form = button.closest('form');

    Swal.fire({
        title: 'Yakin?',
        text: 'Menu ini akan dihapus permanen!',
        icon: 'warning',
        showCancelButton: true,
        confirmButtonColor: '#d33',
        cancelButtonColor: '#3085d6',
        confirmButtonText: 'Ya, hapus!',
        cancelButtonText: 'Batal'
    }).then((result) => {
        if (result.isConfirmed) {
            form.submit();
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
