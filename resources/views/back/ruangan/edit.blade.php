@extends('back.layouts.app')

@section('content')
<div class="container">
    <h3>Edit Ruangan</h3>
    <form action="{{ route('back.ruangan.update', $ruangan) }}" method="POST">
        @csrf
        @method('PUT')  <!-- Menggunakan PUT untuk update -->
        
        <div class="mb-3">
            <label for="nama_ruangan" class="form-label">Nama Ruangan</label>
            <input type="text" class="form-control" id="nama_ruangan" name="nama_ruangan" value="{{ old('nama_ruangan', $ruangan->nama_ruangan) }}" required>
        </div>
        
        <div class="mb-3">
            <label for="kuota" class="form-label">Kuota</label>
            <input type="number" class="form-control" id="kuota" name="kuota" value="{{ old('kuota', $ruangan->kuota) }}" required>
        </div>
        
        <div class="mb-3">
            <label for="menu_id" class="form-label">Menu</label>
            <select class="form-control" id="menu_id" name="menu_id" required>
                @foreach($menus as $menu)
                    <option value="{{ $menu->id }}" 
                        {{ $menu->id == old('menu_id', $ruangan->menu_id) ? 'selected' : '' }}>
                        {{ $menu->mata_pelajaran }} - {{ $menu->tingkat }}
                    </option>
                @endforeach
            </select>
        </div>
        
        <button type="submit" class="btn btn-primary">Simpan</button>
    </form>
</div>
@endsection
