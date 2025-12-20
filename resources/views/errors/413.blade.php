@extends('errors.layouts.base')

@section('title', '413 - Payload Too Large')

@section('content')
        <div class="w-56 sm:w-64 border-4 border-white/80 p-2 rounded-xl shadow-xl float">
            <img src="https://cdn.shopify.com/s/files/1/0318/2649/files/tenor_ef8ea3ac-40cd-42b8-9afd-5ea82e47d745_large.gif?v=1563938313"
                 alt="413 Payload Too Large"
                 class="w-full rounded-lg">
        </div>

        <h1 class="mt-6 text-6xl sm:text-7xl font-extrabold tracking-tight drop-shadow-lg">
            413
        </h1>

        <h2 class="text-xl sm:text-2xl font-semibold opacity-90">
            Payload Too Large
        </h2>

        <p class="mt-2 text-sm sm:text-base text-white/80 max-w-md">
            Ukuran data yang dikirimkan melebihi batas yang diizinkan oleh server.
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