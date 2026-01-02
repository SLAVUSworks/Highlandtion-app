@extends('back.layouts.app')

@section('title', 'Daftar Ruangan')

@section('content')
<div class="container mx-auto">
    <div class="mb-6 rounded-lg bg-white/60 backdrop-blur px-6 py-4 shadow-sm border border-gray-200">
        <h1 class="flex items-center gap-3 text-3xl font-semibold text-gray-800">
            <span class="h-8 w-1.5 rounded-full bg-teal-500"></span>
            Daftar Ruangan
        </h1>
        <p class="mt-1 text-sm text-gray-500">
            Tabel ruangan/lokasi event
        </p>
    </div>
    <div class="mt-4 rounded-lg bg-white p-5 shadow-sm border border-gray-100">
        <a href="{{ route('back.ruangan.create') }}" class="bg-blue-600 hover:bg-blue-700 text-white font-bold py-2 px-4 rounded-lg mb-4 inline-block">
            Tambah Ruangan
        </a>
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


