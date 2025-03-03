@extends('back.layouts.app')

@section('title', 'Access Forbidden')

@section('content')
<div class="flex items-center justify-center" style="height: calc(100vh - 10rem);">
    <div class="text-center flex flex-col items-center">
        <h1 class="text-4xl font-bold text-red-600 mb-4">(・×・)</h1>
        <p class="text-xl text-gray-800">403 - Akun Anda Tidak Berwenang Mengakses Laman Ini.</p>
    </div>
</div>
@endsection
