@extends('back.layouts.app')

@section('content')
<div class="container">
    <a href="{{ route('back.ruangan.create') }}" class="btn btn-primary mb-3">Tambah Ruangan</a>
    <table class="table">
        <thead>
            <tr>
                <th>#</th>
                <th>Nama Ruangan</th>
                <th>Kuota</th>
                <th>Menu</th>
                <th>Aksi</th>
            </tr>
        </thead>
        <tbody>
            @foreach($ruangans as $ruangan)
            <tr>
                <td>{{ $loop->iteration }}</td>
                <td>{{ $ruangan->nama_ruangan }}</td>
                <td>{{ $ruangan->kuota }}</td>
                <td>{{ $ruangan->menu->mata_pelajaran }} - {{ $ruangan->menu->tingkat }}</td>
                <td>
                    <a href="{{ route('back.ruangan.edit', $ruangan) }}" class="btn btn-warning">Edit</a>
                    <form action="{{ route('back.ruangan.destroy', $ruangan) }}" method="POST" style="display:inline-block;">
                        @csrf
                        @method('DELETE')
                        <button type="submit" class="btn btn-danger" onclick="return confirm('Yakin ingin menghapus?')">Hapus</button>
                    </form>
                </td>
            </tr>
            @endforeach
        </tbody>
    </table>
</div>
@endsection
