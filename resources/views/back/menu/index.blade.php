@extends('back.layouts.app')

@section('title', 'Daftar Menu')

@section('content')
<div class="container mx-auto px-4 py-6">
    <h1 class="text-2xl font-bold mb-4">Daftar Event</h1>
    @if ($errors->any())
    <div class="alert alert-danger">
        <ul>
            @foreach ($errors->all() as $error)
                <li>{{ $error }}</li>
            @endforeach
        </ul>
    </div>
    @endif
    <div class="swal" data-swal="{{ session('success') }}"></div>
    <table class="min-w-full bg-white border border-gray-200">
        <thead>
            <tr>
                <th class="py-2 px-4 border-b">No</th>
                <th class="py-2 px-4 border-b">Icon</th>
                <th class="py-2 px-4 border-b">Thumbnail</th>
                <th class="py-2 px-4 border-b">Mata Pelajaran</th>
                <th class="py-2 px-4 border-b">Tingkat</th>
                <th class="py-2 px-4 border-b">Harga</th>
                <th class="py-2 px-4 border-b">Kuota</th>
                <th class="py-2 px-4 border-b">Aksi</th>
            </tr>
        </thead>
        <tbody>
            @foreach ($menus as $menu)
            <tr>
                <td class="py-2 px-4 border-b">{{ $loop->iteration }}</td>
                <td class="py-2 px-4 border-b"><img src="{{ asset('storage/' . $menu->icon) }}" alt="Icon for {{ $menu->mata_pelajaran }}" class="w-12"></td>
                <td class="py-2 px-4 border-b"><img src="{{ asset('storage/' . $menu->thumbnail) }}" alt="Thumbnail for {{ $menu->mata_pelajaran }}" class="w-12"></td>
                <td class="py-2 px-4 border-b">{{ $menu->mata_pelajaran }}</td>
                <td class="py-2 px-4 border-b">{{ $menu->tingkat }}</td>
                <td class="py-2 px-4 border-b">Rp.{{ number_format($menu->harga, 0, ',', '.') }}</td>
                <td class="py-2 px-4 border-b">{{ $menu->kuota }}</td>
                <td class="py-2 px-4 border-b">
                    <div class="flex justify-center space-x-2">
                        <a href="{{ route('back.menu.edit', $menu) }}" class="btn btn-warning btn-sm bg-yellow-500 hover:bg-yellow-700 text-white font-bold py-1 px-2 rounded">Edit</a>
                        <form action="{{ route('back.menu.destroy', $menu) }}" method="POST" class="inline-block">
                            @csrf
                            @method('DELETE')
                            <button type="submit" class="btn btn-danger btn-sm bg-red-500 hover:bg-red-700 text-white font-bold py-1 px-2 rounded" onclick="return confirm('Hapus menu ini?')">Hapus</button>
                        </form>
                    </div>
                </td>
            </tr>
            @endforeach
        </tbody>
    </table>
</div>
<script src="https://cdn.tailwindcss.com"></script>
@endsection
