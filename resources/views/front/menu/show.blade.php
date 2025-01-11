@extends('front.layouts.app')

@section('content')
<div class="w-full max-w-4xl mx-auto bg-white rounded-lg shadow-lg p-8 space-y-6">
    <img src="{{ asset('storage/' . $menu->thumbnail) }}" alt="{{ $menu->mata_pelajaran }}" class="w-full h-64 object-cover rounded-t-lg">
    <h1 class="text-4xl font-bold text-gray-900">{{ $menu->mata_pelajaran }}</h1>
    <p class="text-lg text-gray-700">{{ $menu->deskripsi }}</p>
    <div class="border-t border-gray-200 pt-4">
        <div class="flex justify-between items-center">
            <span class="text-gray-600 font-medium">Tingkat:</span>
            <span class="text-gray-900">{{ $menu->tingkat }}</span>
        </div>
        <div class="flex justify-between items-center mt-2">
            <span class="text-gray-600 font-medium">Harga:</span>
            <span class="text-gray-900">Rp{{ number_format($menu->harga, 0, ',', '.') }}</span>
        </div>
    </div>
    <div class="border-t border-gray-200 pt-4">
        <a href="{{ route('registrasi.create', $menu) }}" 
           class="block w-full bg-blue-600 text-white text-center text-lg font-semibold py-3 rounded-lg hover:bg-blue-700 transition duration-200">
            Daftar Sekarang
        </a>
    </div>
</div>
@endsection
