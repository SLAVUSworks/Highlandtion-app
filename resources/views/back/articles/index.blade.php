@extends('back.layouts.app')

@section('title', 'Daftar Artikel')

@section('content')
<div class="container mx-auto px-4 py-6">
    <h1 class="text-2xl font-bold mb-4">Daftar Artikel</h1>
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
                <td class="px-4 py-2">{{ Str::limit($article->desc, 50) }}</td>
                <td class="px-4 py-2">{{ ucfirst($article->status) }}</td>
                <td class="px-4 py-2">{{ $article->publish_date }}</td>
                <td class="px-4 py-2 text-center">
                    <div class="flex justify-center space-x-2">
                        <a href="{{ route('back.articles.edit', $article) }}" class="bg-yellow-500 hover:bg-yellow-600 text-white px-3 py-1 rounded-lg transition">Edit</a>
                        <form action="{{ route('back.articles.destroy', $article) }}" method="POST" class="inline-block">
                            @csrf
                            @method('DELETE')
                            <button type="submit" class="bg-red-600 hover:bg-red-700 text-white px-3 py-1 rounded-lg transition" onclick="return confirm('Hapus artikel ini?')">
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
