@extends('back.layouts.app')

@section('title', 'Kartu Registrasi')

@section('content')
<div class="container mx-auto px-4 py-6">
    <h1 class="text-2xl font-bold mb-4">Kartu Peserta</h1>
    @if (session('error'))
    <script>
        Swal.fire({
            icon: 'error',
            title: 'Gagal',
            text: '{{ session('error') }}',
        });
    </script>
    @endif
    @if (session('success'))
    <script>
        Swal.fire({
            icon: 'success',
            title: 'Berhasil',
            text: '{{ session('success') }}',
        });
    </script>
@endif
    <div class="border border-gray-300 rounded-lg p-6 bg-white">
                <div id="HANYA INI YANG DIJADIKAN PDF" class="flex-auto justify-evenly">
                    <div class="flex items-center justify-between">
                        <div class="flex items-center my-1">
                            <span class="mr-3 rounded-full bg-white w-8 h-8">
                                <img src="https://github.com/SLAVUSworks/HL-Web-ICON/blob/master/hl2.png?raw=true" class="h-8 p-1">
                            </span>
                            <h2 class="font-medium">Highlandtion</h2>
                        </div>
                        <div class="ml-auto text-blue-800">2.1</div>
                    </div>
                    <div class="border-b border-dashed border-b-2 my-5"></div>
                    <div class="flex items-center">
                        <div class="flex flex-col">
                            <div class="flex-auto text-xs text-gray-400 my-1">
                                <span class="mr-1">HL</span><span>2.1</span>
                            </div>
                            <div class="w-full flex-none text-lg text-blue-800 font-bold leading-none">SMAN 1 LANDBOUW</div>
                            <div class="text-xs">Bukittinggi</div>
                        </div>
                        <div class="flex flex-col mx-auto">
                            <img src="https://github.com/SLAVUSworks/HL-Web-ICON/blob/master/hl2.png?raw=true" class="w-20 p-1">
                        </div>
                        <div class="flex flex-col items-end">
                            <div class="flex-auto text-xs text-gray-400 my-1">
                                <span class="mr-1">HL</span><span>2.1</span>
                            </div>
                            <div class="w-full flex-none text-lg text-blue-800 font-bold leading-none">SMAN 1 LANDBOUW</div>
                            <div class="text-xs">Bukittinggi</div>
                        </div>
                    </div>
                    <div class="border-b border-dashed border-b-2 my-5 pt-5">
                    </div>
                    <div class="flex items-center mb-5 p-5 text-sm">
                        <div class="flex flex-col">
                            <span class="text-sm">Tiket</span>
                            <div class="font-semibold">{{ $registrasi->menu->mata_pelajaran }}</div>
                        </div>
                        <div class="flex flex-col ml-auto items-end">
                            <span class="text-sm">Tingkat</span>
                            <div class="font-semibold">{{ $registrasi->menu->tingkat }}</div>
                        </div>
                    </div>
                    <div class="flex items-center mb-4 px-5">
                        <div class="flex flex-col text-sm">
                            <span class="">Nama Peserta</span>
                            <div class="font-semibold">{{ $registrasi->nama }}</div>
                        </div>
                        <div class="flex flex-col mx-auto text-sm items-center justify-center">
                            <span class=""></span>
                            <div class="font-semibold"></div>
                        </div>
                        <div class="flex flex-col text-sm items-end">
                            <span class="">Sekolah Asal</span>
                            <div class="font-semibold">{{ $registrasi->asal_sekolah }}</div>
                        </div>
                    </div>
                    <div class="border-b border-dashed border-b-2 my-5 pt-5">
                    </div>
                    <div class="flex items-center px-5 pt-3 text-sm">
                        <div class="flex flex-col">
                            <span class="">Tanggal Pendaftaran</span>
                            <div class="font-semibold">{{ $registrasi->created_at }}</div>
                        </div>
                        <div class="flex flex-col mx-auto items-center">
                            <span class="">Ruang Ujian/Lokasi Acara</span>
                            <div class="font-semibold">{{ $registrasi->ruangan->nama_ruangan }}</div>
                        </div>
                        <div class="flex flex-col items-end">
                            <span class="">Tanggal Diverivikasi</span>
                            <div class="font-semibold">{{ $registrasi->updated_at }}</div>
                        </div>
                    </div>
                    <div class="flex flex-col py-5 justify-center items-center text-sm">
                        <span class="">Nomor Registrasi</span>
                        <h6 class="font-bold text-center">{{ $registrasi->registration_code }}</h6>
                    </div>
                </div>
            </div>
        </div>
        <a href="{{ route('back.registrasis.kirimPesan', $registrasi->id) }}" 
            class="mt-4 px-4 py-2 bg-blue-500 text-white rounded hover:bg-blue-600">
            Kirim ke WhatsApp
        </a>
        <a target="_blank" 
        href="https://wa.me/{{ preg_replace('/^0/', '62', $registrasi->nomor_hp) }}?text=Halo%2C%0A%0APendaftaran%20anda%20sudah%20diverifikasi%20oleh%20sektretariat%20Highlandtion%202.1%0A%0AAtas%20nama%20{{ $registrasi->nama }}%0AAsal%20sekolah%20{{ $registrasi->asal_sekolah }}%0ATerdaftar%20pada%20{{ $registrasi->menu->mata_pelajaran }}%0ANomor%20Registrasi%20{{ $registrasi->registration_code }}%0A%0AKartu%20dapat%20di%20unduh%20melalui%20{{ route('registrasis.pdf', $registrasi->id) }}%0A%0AKami%20tunggu%20kehadiran%20mu%20~" 
        class="mt-4 ml-4 px-4 py-2 bg-green-500 text-white rounded hover:bg-green-600">
        Kirim Manual ke WhatsApp
        </a>     
        <a href="{{ route('registrasis.pdf', $registrasi->id) }}" 
            target="_blank" 
            class="mt-4 ml-4 px-4 py-2 bg-red-500 text-white rounded hover:bg-red-600">
            Show PDF
         </a>                       
        <a href="{{ route('back.registrasis.index') }}" 
            class="mt-4 ml-4 px-4 py-2 bg-gray-500 text-white rounded hover:bg-gray-600">
            Kembali
        </a>
    </div>
</div>
<script src="https://cdn.tailwindcss.com"></script>
@endsection
