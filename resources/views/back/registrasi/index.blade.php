@extends('back.layouts.app')

@section('content')
<div class="container mx-auto px-4 py-6">
    <h1 class="text-2xl font-bold mb-4">Daftar Registrasi</h1>
    <div class="overflow-x-auto">
        <table class="table-auto w-full border-collapse border border-gray-300">
            <thead>
                <tr class="bg-gray-100">
                    <th class="border border-gray-300 px-4 py-2">Nama</th>
                    <th class="border border-gray-300 px-4 py-2">Asal Sekolah</th>
                    <th class="border border-gray-300 px-4 py-2">Email</th>
                    <th class="border border-gray-300 px-4 py-2">Menu</th>
                    <th class="border border-gray-300 px-4 py-2">Status</th>
                    <th class="border border-gray-300 px-4 py-2">Aksi</th>
                </tr>
            </thead>
            <tbody>
                @foreach($registrasis as $registrasi)
                <tr>
                    <td class="border border-gray-300 px-4 py-2">{{ $registrasi->nama }}</td>
                    <td class="border border-gray-300 px-4 py-2">{{ $registrasi->asal_sekolah }}</td>
                    <td class="border border-gray-300 px-4 py-2">{{ $registrasi->email }}</td>
                    <td class="border border-gray-300 px-4 py-2">{{ $registrasi->menu->mata_pelajaran }}</td>
                    <td class="border border-gray-300 px-4 py-2">
                        <span class="{{ $registrasi->status == 'approved' ? 'text-green-600' : 'text-red-600' }}">
                            {{ ucfirst($registrasi->status) }}
                        </span>
                    </td>
                    <td class="border border-gray-300 px-4 py-2">
                        <a href="{{ route('back.registrasis.edit', $registrasi->id) }}" class="text-blue-600 hover:underline">Verifikasi</a>
                    </td>
                </tr>
                @endforeach
            </tbody>
        </table>
    </div>
</div>
@endsection
