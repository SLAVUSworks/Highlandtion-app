@extends('layouts.app')
@section('content')
<div class="container">
    <h1>Form Pendaftaran</h1>
    <form action="{{ route('registrasi.store') }}" method="POST" enctype="multipart/form-data">
        @csrf
        <input type="hidden" name="menu_id" value="{{ $menu->id }}">

        <div class="mb-3">
            <label for="nama" class="form-label">Nama Lengkap</label>
            <input type="text" class="form-control" id="nama" name="nama" required>
        </div>

        <div class="mb-3">
            <label for="asal_sekolah" class="form-label">Asal Sekolah</label>
            <input type="text" class="form-control" id="asal_sekolah" name="asal_sekolah" required>
        </div>

        <div class="mb-3">
            <label for="email" class="form-label">Email</label>
            <input type="email" class="form-control" id="email" name="email" required>
        </div>

        <div class="mb-3">
            <label for="nomor_hp" class="form-label">Nomor HP</label>
            <input type="text" class="form-control" id="nomor_hp" name="nomor_hp" required>
        </div>

        <div class="mb-3">
            <label for="bukti_transfer" class="form-label">Bukti Transfer</label>
            <input type="file" class="form-control" id="bukti_transfer" name="bukti_transfer" required>
        </div>

        <button type="submit" class="btn btn-primary">Kirim Pendaftaran</button>
    </form>
</div>
@endsection