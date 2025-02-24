@extends('back.layouts.app')

@section('title', 'Daftar Menu')

@section('content')
<div class="container mx-auto p-6">
    <h1 class="text-2xl font-bold mb-4">Daftar Event</h1>

    {{-- Alert Error --}}
    @if ($errors->any())
    <div class="bg-red-100 text-red-700 px-4 py-3 rounded mb-4">
        <ul class="list-disc list-inside">
            @foreach ($errors->all() as $error)
                <li>{{ $error }}</li>
            @endforeach
        </ul>
    </div>
    @endif

    {{-- Alert Sukses --}}
    <div class="swal" data-swal="{{ session('success') }}"></div>

    {{-- Tabel Event --}}
    <div class="overflow-x-auto bg-white shadow-md rounded-lg">
        <table class="w-full border-collapse">
            <thead>
                <tr class="bg-gray-200 text-gray-700">
                    <th class="px-4 py-2 text-left">No</th>
                    <th class="px-4 py-2 text-left">Icon</th>
                    <th class="px-4 py-2 text-left">Thumbnail</th>
                    <th class="px-4 py-2 text-left">Mata Pelajaran</th>
                    <th class="px-4 py-2 text-left">Tingkat</th>
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
                    <td class="px-4 py-2">Rp.{{ number_format($menu->harga, 0, ',', '.') }}</td>
                    <td class="px-4 py-2">
                        <span class="px-2 py-1 text-white text-sm font-semibold rounded 
                            {{ $menu->status === 'buka' ? 'bg-green-500' : 'bg-red-500' }}">
                            {{ $menu->status === 'buka' ? 'Menerima' : 'Ditutup' }}
                        </span>
                    </td>
                    <td class="px-4 py-2 text-center">
                        <div class="flex justify-center space-x-2">
                            <a href="{{ route('back.menu.edit', $menu) }}" class="bg-yellow-500 hover:bg-yellow-600 text-white px-3 py-1 rounded-lg transition">
                                Edit
                            </a>
                            <form action="{{ route('back.menu.destroy', $menu) }}" method="POST" class="inline-block">
                                @csrf
                                @method('DELETE')
                                <button type="submit" class="bg-red-600 hover:bg-red-700 text-white px-3 py-1 rounded-lg transition" onclick="return confirm('Hapus menu ini?')">
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
@endsection
