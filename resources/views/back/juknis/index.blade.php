@extends('back.layouts.app')

@section('title', 'Daftar Juknis')

@section('content')
<div class="container mx-auto">
    {{-- Header --}}
    <div class="mb-6 rounded-lg bg-white/60 backdrop-blur px-6 py-4 shadow-sm border border-gray-200">
        <h1 class="flex items-center gap-3 text-3xl font-semibold text-gray-800">
            <span class="h-8 w-1.5 rounded-full bg-teal-500"></span>
            Daftar Juknis
        </h1>
        <p class="mt-1 text-sm text-gray-500">Tabel juknis / petunjuk teknis acara</p>
    </div>

    {{-- Card Tabel --}}
    <div class="mt-4 rounded-lg bg-white p-5 shadow-sm border border-gray-100">
        <a href="{{ route('back.juknis.create') }}"
           class="bg-blue-600 hover:bg-blue-700 text-white font-bold py-2 px-4 rounded-lg mb-4 inline-block">
            Tambah Juknis
        </a>

        <div class="overflow-x-auto bg-white shadow-md rounded-lg">
            <table class="w-full border-collapse">
                <thead>
                    <tr class="bg-gray-200 text-gray-700">
                        <th class="px-4 py-2 text-left">No</th>
                        <th class="px-4 py-2 text-left">Nama Event</th>
                        <th class="px-4 py-2 text-left">Keterangan</th>
                        <th class="px-4 py-2 text-left">File PDF</th>
                        <th class="px-4 py-2 text-center">Aksi</th>
                    </tr>
                </thead>
                <tbody>
                    @forelse($juknis as $item)
                    <tr class="border-t hover:bg-gray-100 transition">
                        <td class="px-4 py-2">{{ $loop->iteration }}</td>
                        <td class="px-4 py-2">{{ $item->nama_event }}</td>
                        <td class="px-4 py-2 text-gray-600">{{ Str::limit($item->keterangan, 80) }}</td>
                        <td class="px-4 py-2">
                            <span class="inline-flex items-center gap-1 text-sm text-red-600">
                                {{ $item->nama_file_asli }}
                            </span>
                        </td>
                        <td class="px-4 py-2 text-center">
                            <div class="flex justify-center space-x-2">
                                <a href="{{ route('back.juknis.edit', $item) }}"
                                   class="bg-yellow-500 text-white px-3 py-1 rounded-lg hover:bg-yellow-600 transition text-sm">
                                    Edit
                                </a>
                                <form action="{{ route('back.juknis.destroy', $item) }}" method="POST"
                                      class="inline-block delete-form">
                                    @csrf
                                    @method('DELETE')
                                    <button type="button"
                                            class="bg-red-500 text-white px-3 py-1 rounded-lg hover:bg-red-600 transition text-sm btn-hapus">
                                        Hapus
                                    </button>
                                </form>
                            </div>
                        </td>
                    </tr>
                    @empty
                    <tr>
                        <td colspan="5" class="px-4 py-6 text-center text-gray-400">Belum ada data juknis.</td>
                    </tr>
                    @endforelse
                </tbody>
            </table>
        </div>

        {{-- Pagination --}}
        <div class="mt-4">
            {{ $juknis->links() }}
        </div>
    </div>
</div>
@if(session('success'))
<script>
    Swal.fire({
        icon: 'success',
        title: 'Berhasil',
        text: '{{ session('success') }}',
    });
</script>
@endif

<script>
    document.querySelectorAll('.btn-hapus').forEach(btn => {
        btn.addEventListener('click', function () {
            const form = this.closest('.delete-form');
            Swal.fire({
                title: 'Hapus Juknis?',
                text: 'Data yang dihapus tidak dapat dikembalikan.',
                icon: 'warning',
                showCancelButton: true,
                confirmButtonColor: '#ef4444',
                cancelButtonColor: '#6b7280',
                confirmButtonText: 'Ya, Hapus!',
                cancelButtonText: 'Batal',
            }).then(result => {
                if (result.isConfirmed) form.submit();
            });
        });
    });
</script>
@endsection