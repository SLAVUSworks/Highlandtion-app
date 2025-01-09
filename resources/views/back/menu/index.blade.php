@extends('back.layouts.app')

@section('title', 'Daftar Menu')

@section('content')
<div class="container">
    <h1>Daftar Menu</h1>
    <a href="{{ route('back.menu.create') }}" class="btn btn-primary mb-3">Tambah Menu</a>

    <table class="table table-bordered">
        <thead>
            <tr>
                <th>No</th>
                <th>Mata Pelajaran</th>
                <th>Tingkat</th>
                <th>Harga</th>
                <th>Kuota</th>
                <th>Aksi</th>
            </tr>
        </thead>
        <tbody>
            @foreach ($menus as $menu)
            <tr>
                <td>{{ $loop->iteration }}</td>
                <td>{{ $menu->mata_pelajaran }}</td>
                <td>{{ $menu->tingkat }}</td>
                <td>{{ $menu->harga }}</td>
                <td>{{ $menu->kuota }}</td>
                <td>
                    <a href="{{ route('back.menu.edit', $menu) }}" class="btn btn-warning btn-sm">Edit</a>
                    <form action="{{ route('back.menu.destroy', $menu) }}" method="POST" style="display: inline-block;">
                        @csrf
                        @method('DELETE')
                        <button type="submit" class="btn btn-danger btn-sm" onclick="return confirm('Hapus menu ini?')">Hapus</button>
                    </form>
                </td>
            </tr>
            @endforeach
        </tbody>
    </table>
</div>
@endsection
