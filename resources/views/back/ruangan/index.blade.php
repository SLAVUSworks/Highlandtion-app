@extends('back.layouts.app')

@section('title', 'Daftar Ruangan')

@section('content')
<div class="container mx-auto px-4 py-6">
    <h1 class="text-2xl font-bold mb-4">Daftar Ruangan</h1>
    <table class="table-auto w-full border-collapse border border-gray-300">
        <thead class="bg-gray-200">
            <tr>
                <th class="border border-gray-300 px-4 py-2 text-left">No</th>
                <th class="border border-gray-300 px-4 py-2 text-left">Nama Ruangan</th>
                <th class="border border-gray-300 px-4 py-2 text-left">Kuota</th>
                <th class="border border-gray-300 px-4 py-2 text-left">Menu</th>
                <th class="border border-gray-300 px-4 py-2 text-left">Aksi</th>
            </tr>
        </thead>
        <tbody>
            @foreach($ruangans as $ruangan)
            <tr class="hover:bg-gray-100">
                <td class="border border-gray-300 px-4 py-2">{{ $loop->iteration }}</td>
                <td class="border border-gray-300 px-4 py-2">{{ $ruangan->nama_ruangan }}</td>
                <td class="border border-gray-300 px-4 py-2">{{ $ruangan->kuota }}</td>
                <td class="border border-gray-300 px-4 py-2">{{ $ruangan->menu->mata_pelajaran }} - {{ $ruangan->menu->tingkat }}</td>
                <td class="border border-gray-300 px-4 py-2">
                    <a href="{{ route('back.ruangan.edit', $ruangan) }}" class="inline-block bg-yellow-500 text-white py-1 px-3 rounded hover:bg-yellow-600">Edit</a>
                    <form action="{{ route('back.ruangan.destroy', $ruangan) }}" method="POST" class="inline-block">
                        @csrf
                        @method('DELETE')
                        <button type="submit" class="inline-block bg-red-500 text-white py-1 px-3 rounded hover:bg-red-600" onclick="return confirm('Yakin ingin menghapus?')">Hapus</button>
                    </form>
                </td>
            </tr>
            @endforeach
        </tbody>
    </table>
</div>
    <script src="https://cdn.tailwindcss.com"></script>
    <!-- SweetAlert2 -->
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
