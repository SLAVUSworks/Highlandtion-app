@extends('errors.layouts.base')

@section('title', '102 - Processing')

@section('content')
        <div class="w-56 sm:w-64 border-4 border-white/80 p-2 rounded-xl shadow-xl float">
            <img src="https://pa1.narvii.com/6377/8fd54f5a87043cc3f9192d0d05e579506b2e4223_hq.gif"
                 alt="102 Processing"
                 class="w-full rounded-lg">
        </div>

        <h1 class="mt-6 text-6xl sm:text-7xl font-extrabold tracking-tight drop-shadow-lg">
            102
        </h1>

        <h2 class="text-xl sm:text-2xl font-semibold opacity-90">
            Processing
        </h2>

        <p class="mt-2 text-sm sm:text-base text-white/80 max-w-md">
            Permintaan sedang diproses oleh server.
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