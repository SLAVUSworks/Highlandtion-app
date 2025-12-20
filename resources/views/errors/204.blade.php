@extends('errors.layouts.base')

@section('title', '204 - No Content')

@section('content')
        <div class="w-56 sm:w-64 border-4 border-white/80 p-2 rounded-xl shadow-xl float">
            <img src="https://i.pinimg.com/originals/9f/13/e3/9f13e3e67e7382a2c9f8db02180d2b61.jpg"
                 alt="204 No Content"
                 class="w-full rounded-lg">
        </div>

        <h1 class="mt-6 text-6xl sm:text-7xl font-extrabold tracking-tight drop-shadow-lg">
            204
        </h1>

        <h2 class="text-xl sm:text-2xl font-semibold opacity-90">
            No Content
        </h2>

        <p class="mt-2 text-sm sm:text-base text-white/80 max-w-md">
            Server telah berhasil memproses permintaan, tetapi tidak ada konten yang dikembalikan.
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