@extends('back.layouts.app')

@section('title', 'Daftar Menu')

@section('content')
<div class="container">
    <h1>Edit Menu</h1>
    <form action="{{ route('back.menu.update', $menu) }}" method="POST" enctype="multipart/form-data">
        @csrf
        @method('PUT')
        <div class="form-group">
            <label for="mata_pelajaran">Mata Pelajaran</label>
            <input type="text" class="form-control" name="mata_pelajaran" id="mata_pelajaran" value="{{ $menu->mata_pelajaran }}" required>
        </div>
        <div class="form-group">
            <label for="tingkat">Tingkat</label>
            <input type="text" class="form-control" name="tingkat" id="tingkat" value="{{ $menu->tingkat }}" required>
        </div>
        <div class="form-group">
            <label for="harga">Harga</label>
            <input type="number" class="form-control" name="harga" id="harga" value="{{ $menu->harga }}" required>
        </div>
        <div class="form-group">
            <label for="kuota">Kuota</label>
            <input type="number" class="form-control" name="kuota" id="kuota" value="{{ $menu->kuota }}" required>
        </div>
        <div class="form-group">
            <label for="icon">Icon</label>
            @if ($menu->icon)
            <img src="{{ asset('storage/' . $menu->icon) }}" alt="Current Icon" width="100" />
            @endif
            <input type="file" class="form-control" name="icon" id="icon" required>
        </div>
        <div class="form-group">
            <label for="thumbnail">Thumbnail</label>
            @if ($menu->thumbnail)
            <img src="{{ asset('storage/' . $menu->thumbnail) }}" alt="Current Thumbnail" width="100" />
            @endif
            <input type="file" class="form-control" name="thumbnail" id="thumbnail" required>
        </div>
        <button type="submit" class="btn btn-primary">Update</button>
    </form>
</div>
@endsection
