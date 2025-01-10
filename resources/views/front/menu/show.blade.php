@extends('layouts.app')
@section('content')
<div class="container">
    <h1>{{ $menu->mata_pelajaran }}</h1>
    <p>{{ $menu->deskripsi }}</p>
    <p><strong>Tingkat:</strong> {{ $menu->tingkat }}</p>
    <p><strong>Harga:</strong> Rp{{ number_format($menu->harga, 0, ',', '.') }}</p>
    <a href="{{ route('registrasi.create', $menu) }}" class="btn btn-success">Daftar Sekarang</a>
</div>
@endsection