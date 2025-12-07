@extends('front.layouts.app')

@section('content')
<div class="w-full max-w-4xl mx-auto bg-white rounded-3xl shadow-lg p-8 space-y-6 mb-80 mt-5">
    <img src="{{ asset('storage/' . $menu->thumbnail) }}" alt="{{ $menu->mata_pelajaran }}" class="w-full h-64 object-cover rounded-t-lg">
    
    <h1 class="text-4xl font-bold text-gray-900">{{ $menu->mata_pelajaran }}</h1>
    <p class="text-lg text-gray-700">{{ $menu->deskripsi }}</p>
    
    <div class="border-t border-gray-200 pt-4">
        <div class="flex justify-between items-center">
            <span class="text-gray-600 font-medium">Tingkat</span>
            <span class="text-gray-900">{{ $menu->tingkat }}</span>
        </div>
        <div class="flex justify-between items-center mt-2">
            <span class="text-gray-600 font-medium">Kategori</span>
            <span class="text-gray-900">{{ $menu->menuCategory->name }}</span>
        </div>
        <div class="flex justify-between items-center mt-2">
            <span class="text-gray-600 font-medium">Harga</span>
            <span class="text-gray-900">Rp{{ number_format($menu->harga, 0, ',', '.') }}</span>
        </div>
    </div>
</div>
<div class="border-t border-gray-200 p-4 bg-white fixed bottom-0 left-0 w-full shadow-lg rounded-t-3xl">
    <div class="container mx-auto px-4">
        <div class="flex items-center justify-between gap-4">
            <div class="flex-1 min-w-0">
                <p class="text-gray-800 text-sm text-left sm:text-base md:text-lg font-semibold truncate">
                    <span class="text-xs">Harga:</span> <br><span class="text-blue-600 text-xl">Rp.{{ number_format($menu->harga, 0, ',', '.') }}</span>
                </p>
            </div>

            <div class="flex-1 max-w-sm">
                @if ($menu->status === 'tutup')
                    <a href="/" 
                       class="flex items-center justify-between w-full bg-gray-400 text-gray-700 text-sm sm:text-base md:text-lg font-semibold py-3 px-4 rounded-lg cursor-not-allowed">
                        <span>Pendaftaran Ditutup</span>
                        <span class="w-9 h-9 sm:w-10 sm:h-10 bg-gray-500 text-white flex items-center justify-center rounded-full">
                            <i class="fa-solid fa-ticket"></i>
                        </span>
                    </a>
                @else
                    <a href="{{ route('registrasi.create', $menu) }}" 
                       class="flex items-center justify-between w-full bg-blue-600 text-white text-sm sm:text-base md:text-lg font-semibold py-3 px-4 rounded-lg hover:bg-blue-700 transition duration-200">
                        <span>Daftar Sekarang</span>
                        <span class="w-9 h-9 sm:w-10 sm:h-10 aspect-square bg-white text-blue-600 flex items-center justify-center rounded-full">
                            <i class="fa-solid fa-ticket"></i>
                        </span>                        
                    </a>
                @endif
            </div>
        </div>
    </div>
</div>



@endsection
