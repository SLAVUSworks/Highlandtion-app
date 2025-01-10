@extends('front.layouts.app')

@section('content')
<div class="relative min-h-screen flex items-center justify-center py-12 px-4 sm:px-6 lg:px-8 bg-no-repeat bg-cover" style="background-image: url('https://safebooru.org//images/1283/08d1264619f04bcc434f851541abdcdf15c3fee4.jpg'); background-size: cover; background-position: center;">
<div class="w-full max-w-8xl lg:w-8/12 mx-auto bg-white rounded-3xl shadow-2xl z-10 p-6 space-y-4">
    <h1 class="text-3xl font-bold text-gray-800">{{ $menu->mata_pelajaran }}</h1>
    <p class="text-gray-600">{{ $menu->deskripsi }}</p>
    <p class="text-gray-700 font-medium">
        <strong>Tingkat:</strong> {{ $menu->tingkat }}
    </p>
    <p class="text-gray-700 font-medium">
        <strong>Harga:</strong> Rp{{ number_format($menu->harga, 0, ',', '.') }}
    </p>
    <a href="{{ route('registrasi.create', $menu) }}" 
       class="inline-block bg-green-500 text-white text-sm font-medium px-6 py-3 rounded-lg hover:bg-green-600 transition duration-200">
        Daftar Sekarang
    </a>
</div>
</div>
@endsection
