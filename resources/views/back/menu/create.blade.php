@extends('back.layouts.app')

@section('title', 'Daftar Menu')

@section('content')
<div class="container">
    <h1>Tambah Menu</h1>
    <form action="{{ route('back.menu.store') }}" method="POST">
        @csrf
        <div class="form-group">
            <label for="mata_pelajaran">Mata Pelajaran</label>
            <input type="text" class="form-control" name="mata_pelajaran" id="mata_pelajaran" required>
        </div>
        <div class="form-group">
            <label for="tingkat">Tingkat</label>
            <input type="text" class="form-control" name="tingkat" id="tingkat" required>
        </div>
        <div class="form-group">
            <label for="harga">Harga</label>
            <input type="number" class="form-control" name="harga" id="harga" required>
        </div>
        <div class="form-group">
            <label for="kuota">Kuota</label>
            <input type="number" class="form-control" name="kuota" id="kuota" required>
        </div>
        <button type="submit" class="btn btn-primary">Simpan</button>
    </form>
</div>
@endsection
