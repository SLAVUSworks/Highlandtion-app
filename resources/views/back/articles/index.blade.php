@extends('back.layouts.app')

@section('title', 'Daftar Artikel')

@section('content')
<div class="container mx-auto">
    <div class="mb-6 rounded-lg bg-white/60 backdrop-blur px-6 py-4 shadow-sm border border-gray-200">
        <h1 class="flex items-center gap-3 text-3xl font-semibold text-gray-800">
            <span class="h-8 w-1.5 rounded-full bg-teal-500"></span>
            Daftar Artikel
        </h1>
        <p class="mt-1 text-sm text-gray-500">
            Tabel artikel yang telah diposting
        </p>
    </div>
    <div class="mt-4 rounded-lg bg-white p-5 shadow-sm border border-gray-100">
    <a href="{{ route('back.articles.create') }}" class="bg-blue-600 hover:bg-blue-700 text-white font-bold py-2 px-4 rounded-lg mb-4 inline-block">
        Tambah Artikel
    </a>
    <table class="w-full border-collapse">
        <thead>
            <tr class="bg-gray-200 text-gray-700">
                <th class="px-4 py-2 text-left">Judul</th>
                <th class="px-4 py-2 text-left">Deskripsi</th>
                <th class="px-4 py-2 text-left">Status</th>
                <th class="px-4 py-2 text-left">Tanggal Publikasi</th>
                <th class="px-4 py-2 text-center">Aksi</th>
            </tr>
        </thead>
        <tbody>
            @foreach($articles as $article)
            <tr class="border-t hover:bg-gray-100 transition">
                <td class="px-4 py-2">{{ $article->title }}</td>
                <td class="px-4 py-2">{!! Str::limit($article->desc, 25) !!}</td>
                <td class="px-4 py-2">{{ ucfirst($article->status) }}</td>
                <td class="px-4 py-2">{{ $article->publish_date }}</td>
                <td class="px-4 py-2 text-center">
                    <div class="flex justify-center space-x-2">
                        <a href="{{ route('back.articles.edit', $article) }}" class="bg-yellow-500 hover:bg-yellow-600 text-white px-3 py-1 rounded-lg transition">Edit</a>
                        <form action="{{ route('back.articles.destroy', $article) }}" method="POST" class="inline-block">
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
    <div class="mt-4">
        {{ $articles->links() }}
    </div>
    </div>
</div>
<script src="https://cdn.jsdelivr.net/npm/sweetalert2@11"></script>
<script>
function confirmDelete(button) {
    const form = button.closest('form');

    Swal.fire({
        title: 'Hapus artikel?',
        text: 'Data yang dihapus tidak dapat dikembalikan!',
        icon: 'warning',
        showCancelButton: true,
        confirmButtonColor: '#dc2626',
        cancelButtonColor: '#9ca3af',
        confirmButtonText: 'Ya, hapus',
        cancelButtonText: 'Batal'
    }).then((result) => {
        if (result.isConfirmed) {
            form.submit();
        }
    });
}
</script>
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
