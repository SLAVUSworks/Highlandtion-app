@extends('front.layouts.app')

@section('content')


<div class="border border-gray-300 m-5 rounded-lg p-6 bg-white">
        <div class="text-center mb-6">
            <h1 class="text-xl font-bold text-blue-800">Informasi dan Status Registrasi</h1>
            <p class="text-sm text-gray-600">
                Hubungi panitia melalui 
                <a href="/contact" class="text-blue-500 underline">Kontak</a> 
                jika ada yang ingin ditanyakan.
            </p>
        </div>
    <div class="flex-auto justify-evenly">
        <div class="flex items-center justify-between">
            <div class="flex items-center my-1">
                <span class="mr-3 rounded-full bg-white w-8 h-8">
                    <img src="{{ $config['app_favicon'] }}" class="h-8 p-1">
                </span>
                <h2 class="font-medium">{{ $config['app_name'] }}</h2>
            </div>
        </div>
        <div class="border-b border-dashed border-b-2 my-5"></div>
        <div class="flex items-center">
            <div class="flex flex-col text-left">
                <div class="flex-auto text-xs text-gray-400 my-1">
                    <span class="mr-1">{{ $config['app_name'] }}</span>
                </div>
                <div class="w-full flex-none text-lg text-blue-800 font-bold leading-none">SMAN 1 LANDBOUW</div>
                <div class="text-xs">Bukittinggi</div>
            </div>
            <div class="flex flex-col ml-auto">
                <img src="{{ $config['app_favicon'] }}" class="w-20 p-1">
            </div>
        </div>        
        <div class="border-b border-dashed border-b-2 my-5 pt-5">
        </div>
        <div class="flex items-center mb-5 text-sm text-left">
            <div class="flex flex-col">
                <span class="text-sm">Tiket</span>
                <div class="font-semibold">{{ $registrasi->menu->mata_pelajaran }}</div>
            </div>
            <div class="flex flex-col ml-auto items-end">
                <span class="text-sm">Tingkat</span>
                <div class="font-semibold">{{ $registrasi->menu->tingkat }}</div>
            </div>
        </div>
        <div class="flex items-center mb-4">
            <div class="flex flex-col text-sm text-left">
                <span class="">Nama Peserta</span>
                <div class="font-semibold">{{ $registrasi->nama }}</div>
            </div>
            <div class="flex flex-col mx-auto text-sm items-center justify-center">
                <span class=""></span>
                <div class="font-semibold"></div>
            </div>
            <div class="flex flex-col text-sm text-right">
                <span class="">Sekolah Asal</span>
                <div class="font-semibold">{{ $registrasi->asal_sekolah }}</div>
            </div>
        </div>
        <div class="border-b border-dashed border-b-2 my-5 pt-5">
        </div>
        <div class="flex items-center justify-between pt-3 text-sm">
            <div class="flex flex-col items-start">
                <span class="">Status</span>
                <div class="font-semibold 
                    {{ $registrasi->status === 'pending' ? 'text-red-500' : '' }} 
                    {{ $registrasi->status === 'approved' ? 'text-green-500' : '' }}">
                    {{ ucfirst($registrasi->status) }}
                </div>
            </div>
            <div class="flex flex-col items-end">
                <span class="">Tanggal Pendaftaran</span>
                <div class="font-semibold">{{ $registrasi->created_at }}</div>
            </div>
        </div>
        
    </div>
</div>

@endsection