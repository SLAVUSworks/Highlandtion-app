@extends('front.layouts.app')

@section('content')
<div class="relative min-h-screen flex items-center justify-center py-12 px-4 sm:px-6 lg:px-8 bg-no-repeat bg-cover" style="background-image: url('https://safebooru.org//images/1283/08d1264619f04bcc434f851541abdcdf15c3fee4.jpg'); background-size: cover; background-position: center;">
<div class="w-full max-w-8xl lg:w-8/12 mx-auto bg-white rounded-3xl shadow-2xl z-10 p-6 space-y-4">
    <h1 class="text-2xl font-bold text-gray-800 mb-6">Form Pendaftaran</h1>
    <form action="{{ route('registrasi.store') }}" method="POST" enctype="multipart/form-data" class="space-y-6">
        @csrf
        <input type="hidden" name="menu_id" value="{{ $menu->id }}">

        <div>
            <label for="nama" class="block text-sm font-medium text-gray-700">Nama Lengkap</label>
            <input type="text" id="nama" name="nama" required 
                   class="mt-1 block w-full border-gray-300 rounded-lg shadow-sm focus:ring-blue-500 focus:border-blue-500">
        </div>

        <div>
            <label for="asal_sekolah" class="block text-sm font-medium text-gray-700">Asal Sekolah</label>
            <input type="text" id="asal_sekolah" name="asal_sekolah" required 
                   class="mt-1 block w-full border-gray-300 rounded-lg shadow-sm focus:ring-blue-500 focus:border-blue-500">
        </div>

        <div>
            <label for="email" class="block text-sm font-medium text-gray-700">Email</label>
            <input type="email" id="email" name="email" required 
                   class="mt-1 block w-full border-gray-300 rounded-lg shadow-sm focus:ring-blue-500 focus:border-blue-500">
        </div>

        <div>
            <label for="nomor_hp" class="block text-sm font-medium text-gray-700">Nomor HP</label>
            <input type="text" id="nomor_hp" name="nomor_hp" required 
                   class="mt-1 block w-full border-gray-300 rounded-lg shadow-sm focus:ring-blue-500 focus:border-blue-500">
        </div>

        <div>
            <label for="bukti_transfer" class="block text-sm font-medium text-gray-700">Bukti Transfer</label>
            <input type="file" id="bukti_transfer" name="bukti_transfer" required 
                   class="mt-1 block w-full border-gray-300 rounded-lg shadow-sm focus:ring-blue-500 focus:border-blue-500">
        </div>

        <button type="submit" 
                class="w-full bg-blue-500 text-white text-sm font-medium px-6 py-3 rounded-lg hover:bg-blue-600 transition duration-200">
            Kirim Pendaftaran
        </button>
    </form>
</div>
@endsection
