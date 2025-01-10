@extends('back.layouts.app')

@section('title', 'Buat Menu')

@section('content')
<div class="container mx-auto px-4 py-6">
    <h1>Tambah Menu</h1>
    <form action="{{ route('back.menu.store') }}" method="POST" enctype="multipart/form-data">
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
        <div class="form-group">
            <label for="icon">Icon</label>
            <input type="file" class="form-control" name="icon" id="icon" required>
        </div>
        <div class="form-group">
            <label for="thumbnail">Thumbnail</label>
            <input type="file" class="form-control" name="thumbnail" id="thumbnail" required>
        </div>
        <button type="submit" class="btn btn-primary">Simpan</button>
    </form>
</div>
<script src="https://cdn.tailwindcss.com"></script>
@endsection
