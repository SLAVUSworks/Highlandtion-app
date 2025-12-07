@extends('front.layouts.app')

@section('content')

<div class="flex justify-center items-center min-h-screen">
    <div class="w-full max-w-md p-6 bg-white rounded-lg shadow-md">
        <h2 class="text-2xl font-semibold text-center text-gray-700 mb-4">Track Registrasi</h2>

        @if (session('error'))
            <div class="mb-4 p-3 text-sm text-red-700 bg-red-100 rounded-lg">
                {{ session('error') }}
            </div>
        @endif

        <form action="{{ route('registrasi.track') }}" method="POST">
            @csrf
            <div class="mb-4">
                <label for="nama" class="block text-left text-sm font-medium text-gray-700">Nama</label>
                <input type="text" id="nama" name="nama" required
                    class="mt-1 w-full p-2 border border-gray-300 rounded-md focus:ring-blue-500 focus:border-blue-500">
            </div>
            <div class="mb-4">
                <label for="nomor_hp" class="block text-left text-sm font-medium text-gray-700">Nomor HP</label>
                <input type="number" id="nomor_hp" name="nomor_hp" required maxlength="13"
                    class="mt-1 w-full p-2 border border-gray-300 rounded-md focus:ring-blue-500 focus:border-blue-500">
            </div>
            <button type="submit"
                class="w-full bg-blue-600 text-white py-2 rounded-md hover:bg-blue-700 transition">
                Track
            </button>
        </form>
    </div>
</div>

@endsection