@extends('back.layouts.app')

@section('title', 'Daftar Ruangan')

@section('content')
<div class="container mx-auto px-4 py-6">
    <h1 class="text-2xl font-bold mb-4">Daftar Ruangan</h1>
    <div class="overflow-x-auto bg-white shadow-md rounded-lg">
    <table class="w-full border-collapse">
        <thead>
            <tr class="bg-gray-200 text-gray-700">
                <th class="px-4 py-2 text-left">No</th>
                <th class="px-4 py-2 text-left">Nama Ruangan</th>
                <th class="px-4 py-2 text-left">Kuota</th>
                <th class="px-4 py-2 text-left">Menu</th>
                <th class="px-4 py-2 text-center">Aksi</th>
            </tr>
        </thead>
        <tbody>
            @foreach($ruangans as $ruangan)
            <tr class="border-t hover:bg-gray-100 transition">
                <td class="px-4 py-2">{{ $loop->iteration }}</td>
                <td class="px-4 py-2">{{ $ruangan->nama_ruangan }}</td>
                <td class="px-4 py-2">{{ $ruangan->kuota }}</td>
                <td class="px-4 py-2">{{ $ruangan->menu->menuCategory->name }} - {{ $ruangan->menu->mata_pelajaran }} - {{ $ruangan->menu->tingkat }}</td>
                <td class="px-4 py-2 text-center">
                    <div class="flex justify-center space-x-2">
                    <a href="{{ route('back.ruangan.edit', $ruangan) }}" class="bg-yellow-500 text-white px-3 py-1 rounded-lg hover:bg-yellow-600 transition">Edit</a>
                    <form action="{{ route('back.ruangan.destroy', $ruangan) }}" method="POST" class="inline-block">
                        @csrf
                        @method('DELETE')
                        <button type="submit" class="bg-red-500 text-white px-3 py-1 rounded-lg hover:bg-red-600 transition" onclick="return confirm('Yakin ingin menghapus?')">Hapus</button>
                    </form>
                    </div>
                </td>
            </tr>
            @endforeach
        </tbody>
    </table>
    </div>
</div>
<script src="https://cdn.tailwindcss.com"></script>
<script src="https://cdn.jsdelivr.net/npm/sweetalert2@11"></script>
@if(session('success'))
<script>
   
   Swal.fire({
       icon: 'success',
       title: 'Berhasil',
       text: '{{ session('success') }}',
   });
</script>
@endif
@endsection


