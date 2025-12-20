@extends('errors.layouts.base')

@section('title', '408 - Request Timeout')

@section('content')
        <div class="w-56 sm:w-64 border-4 border-white/80 p-2 rounded-xl shadow-xl float">
            <img src="https://64.media.tumblr.com/39d0f2988bf37dbcbe15e3296cd899b6/d305745d447129dc-5b/s1280x1920/2c5c923836ee66c526a1e9e8c7501cdaf2448657.gif"
                 alt="408"
                 class="w-full rounded-lg">
        </div>

        <h1 class="mt-6 text-6xl sm:text-7xl font-extrabold tracking-tight drop-shadow-lg">
            408
        </h1>

        <h2 class="text-xl sm:text-2xl font-semibold opacity-90">
            Request Timeout
        </h2>

        <p class="mt-2 text-sm sm:text-base text-white/80 max-w-md">
            Permintaan memerlukan waktu terlalu lama untuk diselesaikan oleh server.
        </p>

        <div class="mt-6 flex gap-3">
            <button onclick="window.history.back()"
                class="px-5 py-2 bg-blue-500 hover:bg-blue-600 active:scale-95 transition rounded-lg shadow font-semibold">
                Kembali
            </button>

            <a href="/"
                class="px-5 py-2 bg-white/20 hover:bg-white/30 backdrop-blur rounded-lg shadow font-semibold">
                Beranda
            </a>
        </div>
@endsection