@extends('front.layouts.app')

@section('content')
<script src="https://unpkg.com/sweetalert/dist/sweetalert.min.js"></script>
<div class="w-full max-w-8xl lg:w-8/12 mx-auto bg-white rounded-3xl shadow-2xl z-10 p-6 mt-6 mb-6 space-y-4">
    <h1 class="text-2xl font-bold text-gray-800 mb-6 text-center">Form Pendaftaran</h1>
    <form action="{{ route('registrasi.store') }}" method="POST" enctype="multipart/form-data" class="space-y-6">
        <div class="text-center mb-6">
            <img src="{{ asset('storage/' . $menu->icon) }}" alt="{{ $menu->name }}" class="w-32 h-32 mx-auto rounded-full">
            <h1 class="text-2xl font-bold text-gray-800 mt-4">{{ $menu->mata_pelajaran }} - {{ $menu->tingkat }}</h1>
        </div>

        @csrf
        <input type="hidden" name="menu_id" value="{{ $menu->id }}">

        <!-- Personal Information Section -->
        <div class="space-y-4">
            <h2 class="text-xl font-semibold text-gray-800 text-left">Data Diri</h2>
            <div>
                <label for="nama" class="block text-sm font-medium text-gray-700 text-left">Nama Lengkap</label>
                <input type="text" id="nama" name="nama" required 
                       class="mt-1 block w-full border-gray-300 rounded-lg shadow-sm focus:ring-blue-500 focus:border-blue-500 text-lg">
            </div>

            <div>
                <label for="asal_sekolah" class="block text-sm font-medium text-gray-700 text-left">Asal Sekolah</label>
                <input type="text" id="asal_sekolah" name="asal_sekolah" required 
                       class="mt-1 block w-full border-gray-300 rounded-lg shadow-sm focus:ring-blue-500 focus:border-blue-500 text-lg">
            </div>

            <div>
                <label for="email" class="block text-sm font-medium text-gray-700 text-left">Email</label>
                <input type="email" id="email" name="email" required 
                       class="mt-1 block w-full border-gray-300 rounded-lg shadow-sm focus:ring-blue-500 focus:border-blue-500 text-lg">
            </div>

            <div>
                <label for="nomor_hp" class="block text-sm font-medium text-gray-700 text-left">Nomor HP</label>
                <div class="flex">
                    <span class="inline-flex items-center px-3 rounded-l-md border border-r-0 border-gray-300 bg-gray-50 text-gray-500 text-lg">+62</span>
                    <input type="text" id="nomor_hp" name="nomor_hp" required 
                           class="mt-1 block w-full border-gray-300 rounded-r-lg shadow-sm focus:ring-blue-500 focus:border-blue-500 text-lg">
                </div>
            </div>
        </div>

        <!-- Payment Information Section -->
        <div class="space-y-4">
            <h2 class="text-xl font-semibold text-gray-800 text-left">Informasi Pembayaran</h2>
            <div>
                <div class="space-y-4 w-full">
                    <div class="flex items-center space-x-4 w-full">
                        <img src="https://alumni.sv.ugm.ac.id/wp-content/uploads/sites/1262/2016/03/logo-BRI.png" alt="Bank Logo" class="w-32 h-32">
                        <div class="w-full text-left">
                            <h3 class="text-2xl font-bold text-gray-800">Bank BRI</h3>
                            <p class="text-xl font-semibold text-gray-600 copyable" onclick="copyText(this)">
                                001501017539536
                            </p>
                            <p class="text-xl text-gray-600">a.n. Highlandtion</p>
                        </div>
                    </div>
                </div>
                
                <!-- SweetAlert2 -->
                <script src="https://cdn.jsdelivr.net/npm/sweetalert2@11"></script>

                 @if(session('success'))
                <script>
                    
                    Swal.fire({
                        icon: 'success',
                        title: 'Berhasil',
                        text: '{{ session('success') }}',
                    });
                </script>
                @endif
                
                @if(session('error'))
                    <script>
                        Swal.fire({
                            icon: 'error',
                            title:'Gagal',
                            text: "{{session('error')}}",
                        });
                    </script>
                @endif
                <script src="{{ asset('js/registrasi.js') }}"></script>
                
                </div>
                <label for="bukti_transfer" class="block text-sm font-medium text-gray-700 text-left mt-3">Bukti Transfer - <i>Max 2MB</i></label>
                <input type="file" id="bukti_transfer" name="bukti_transfer" required 
                       class="mt-1 block w-full border-gray-300 rounded-lg shadow-sm focus:ring-blue-500 focus:border-blue-500 text-lg"
                       accept="image/*" onchange="validateFileSize(this)">
                <script>
                    function validateFileSize(input) {
                        const file = input.files[0];
                        if (file.size > 2 * 1024 * 1024) {
                            alert('Ukuran File Harus Kecil dari 2MB');
                            input.value = '';
                        }
                    }
                </script>
            </div>
            <button type="submit" class="w-full bg-blue-500 text-white text-sm font-medium px-6 py-3 rounded-lg hover:bg-blue-600 transition duration-200">Kirim Pendaftaran</button>
            <script src="{{ asset('js/registrasi.js') }}"></script>
        </div>
    </form>
</div>
@endsection
