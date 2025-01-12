@extends('back.layouts.app')

@section('title', 'Daftar Artikel')

@section('content')
<div class="container mx-auto px-4 py-6">
    <h1 class="text-2xl font-bold mb-4">Daftar Artikel</h1>
    <a href="{{ route('back.articles.create') }}" class="bg-blue-500 hover:bg-blue-700 text-white font-bold py-2 px-4 rounded mb-4 inline-block">
        Tambah Artikel
    </a>
    <table class="table-auto w-full border-collapse border border-gray-300">
        <thead class="bg-gray-200">
            <tr>
                <th class="border border-gray-300 px-4 py-2">Judul</th>
                <th class="border border-gray-300 px-4 py-2">Deskripsi</th>
                <th class="border border-gray-300 px-4 py-2">Status</th>
                <th class="border border-gray-300 px-4 py-2">Tanggal Publikasi</th>
                <th class="border border-gray-300 px-4 py-2">Aksi</th>
            </tr>
        </thead>
        <tbody>
            @foreach($articles as $article)
            <tr class="hover:bg-gray-100">
                <td class="border border-gray-300 px-4 py-2">{{ $article->title }}</td>
                <td class="border border-gray-300 px-4 py-2">{{ Str::limit($article->desc, 50) }}</td>
                <td class="border border-gray-300 px-4 py-2">{{ ucfirst($article->status) }}</td>
                <td class="border border-gray-300 px-4 py-2">{{ $article->publish_date }}</td>
                <td class="border border-gray-300 px-4 py-2 text-center">
                    <a href="{{ route('back.articles.edit', $article) }}" class="inline-block bg-yellow-500 text-white py-1 px-3 rounded hover:bg-yellow-600">
                        Edit
                    </a>
                    <form action="{{ route('back.articles.destroy', $article) }}" method="POST" class="inline-block">
                        @csrf
                        @method('DELETE')
                        <button type="submit" class="inline-block bg-red-500 text-white py-1 px-3 rounded hover:bg-red-600" onclick="return confirm('Hapus artikel ini?')">
                            Hapus
                        </button>
                    </form>
                </td>
            </tr>
            @endforeach
        </tbody>
    </table>
    <div class="mt-4">
        {{ $articles->links() }}
    </div>
</div>
@endsection
