@extends('front.layouts.app')

@section('content')
<div class="relative min-h-screen flex items-center justify-center py-12 px-4 sm:px-6 lg:px-8 bg-no-repeat bg-cover" style="background-image: url('https://safebooru.org//images/1283/08d1264619f04bcc434f851541abdcdf15c3fee4.jpg'); background-size: cover; background-position: center;">
    <div class="w-full max-w-8xl lg:w-8/12 mx-auto bg-blue-200 rounded-3xl shadow-2xl z-10 p-6 space-y-4">
        <div class="z-10 w-full max-w-3xl p-6 mx-auto bg-white rounded-3xl shadow-2xl">
            <h1 class="text-3xl font-bold text-gray-800">Selamat Datang di Aplikasi Perlombaan</h1>
            <p class="text-gray-600 mt-4">Aplikasi ini adalah aplikasi yang digunakan untuk mengelola perlombaan yang diadakan oleh sekolah.</p>
        </div>
    <h1 class="text-2xl font-bold text-gray-800 mb-6">Daftar Perlombaan</h1>
    <div class="grid grid-cols-1 gap-6">
        @foreach($menus as $menu)
        <div class="flex flex-col bg-white shadow-md rounded-2xl overflow-hidden">
            <img src="{{ asset('storage/' . $menu->thumbnail) }}" alt="{{ $menu->mata_pelajaran }}" 
                 class="w-full h-40 object-cover">
            <div class="p-4">
                <h5 class="text-lg font-semibold text-gray-800 truncate">{{ $menu->mata_pelajaran }}</h5>
                <p class="text-sm text-gray-600 mt-2">{{ $menu->deskripsi }}</p>
                <a href="{{ route('menu.show', $menu) }}" 
                   class="mt-4 inline-block bg-blue-500 text-white text-sm font-medium px-4 py-2 rounded-lg hover:bg-blue-600 transition duration-200">
                    Detail
                </a>
            </div>
        </div>
        @endforeach
    </div>
</div>

@endsection
