@extends('back.layouts.app')

@section('title', 'Access Forbidden')

@section('content')
<div class="flex items-center justify-center" style="height: calc(100vh - 10rem);">
    <div class="text-center flex flex-col items-center">
        <div class="box">
            <img id="image" src="https://media.tenor.com/4gWUZrDARQ8AAAAi/strike-witches-world-witches-series.gif" alt="">
        </div>
        <p class="text-xl text-gray-800">403 - Akun Anda Tidak Berwenang Mengakses Laman Ini.</p>
    </div>
</div>

<style>
#image {
    width: inherit;
    border: 3px solid white;
}

.box {
    width: 240px;
    float: left;
    margin: 3px;
    padding: 3px;
}
</style>
@endsection
