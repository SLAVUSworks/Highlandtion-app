@extends('layouts.app')
@section('content')
<div class="container">
    <h1>Daftar Menu</h1>
    <div class="row">
        @foreach($menus as $menu)
        <div class="col-md-4">
            <div class="card">
                <img src="{{ 'storage/' . $menu->thumbnail }}" class="card-img-top" alt="{{ $menu->mata_pelajaran }}">
                <div class="card-body">
                    <h5 class="card-title">{{ $menu->mata_pelajaran }}</h5>
                    <p class="card-text">{{ $menu->deskripsi }}</p>
                    <a href="{{ route('menu.show', $menu) }}" class="btn btn-primary">Detail</a>
                </div>
            </div>
        </div>
        @endforeach
    </div>
</div>
@endsection