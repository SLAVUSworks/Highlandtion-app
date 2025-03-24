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
            text: '{{ session('
            error ') }}',
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
                        <img src="{{ $config['app_favicon'] }}" class="h-8 p-1">
                    </span>
                    <h2 class="font-medium">{{ $config['app_name'] }}</h2>
                </div>
            </div>
            <div class="border-b border-dashed border-b-2 my-5"></div>
    
            <div class="flex items-center">
                <div class="flex flex-col">
                    <div class="text-xs text-gray-400 my-1">
                        <span class="mr-1">{{ $config['app_name'] }}</span>
                    </div>
                    <div class="w-full flex-none text-lg text-blue-800 font-bold leading-none">SMAN 1 LANDBOUW</div>
                    <div class="text-xs">Bukittinggi</div>
                </div>
                <div class="flex flex-col mx-auto">
                    <img src="{{ $config['app_favicon'] }}" class="w-20 p-1">
                </div>
                <div class="flex flex-col items-end">
                    <div class="text-xs text-gray-400 my-1">
                        <span class="mr-1">{{ $config['app_name'] }}</span>
                    </div>
                    <div class="w-full flex-none text-lg text-blue-800 font-bold leading-none">SMAN 1 LANDBOUW</div>
                    <div class="text-xs">Bukittinggi</div>
                </div>
            </div>
    
            <div class="border-b border-dashed border-b-2 my-5 pt-5"></div>
    
            <div class="flex items-center mb-5 p-5 text-sm">
                <div class="flex flex-col">
                    <span class="text-sm">Tiket</span>
                    <div class="font-semibold">{{ $registrasi->menu->menuCategory->name }} - {{ $registrasi->menu->mata_pelajaran }}</div>
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
                <div class="flex flex-col mx-auto text-sm items-center">
                    <span class=""></span>
                    <div class="font-semibold"></div>
                </div>
                <div class="flex flex-col text-sm items-end">
                    <span class="">Sekolah Asal</span>
                    <div class="font-semibold">{{ $registrasi->asal_sekolah }}</div>
                </div>
            </div>
    
            <div class="border-b border-dashed border-b-2 my-5 pt-5"></div>
    
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
    
    <div class="flex gap-4 pt-6">
        <div class="border border-gray-300 rounded-lg p-6 bg-white flex-1">
            <h2 class="text-lg font-semibold text-gray-800 mb-4">Status Pengiriman Pesan</h2>
    
            <form action="{{ route('back.registrasi.saveNote', $registrasi->id) }}" method="POST" class="space-y-3">
                @csrf
                @method('PUT')
    
                <label for="note" class="block text-sm font-medium text-gray-700">Catatan:</label>
                <textarea id="note" name="note" rows="2"
                    class="w-full p-2 border rounded-md focus:ring-blue-500 focus:border-blue-500">{{ old('note', $registrasi->note) }}</textarea>
    
                <div class="flex gap-2">
                    <button type="submit" class="w-full bg-gray-500 text-white px-4 py-2 rounded-md hover:bg-gray-600 transition">
                        Simpan Catatan
                    </button>
    
                    @if (!$registrasi->is_notified)
                        <button formaction="{{ route('back.registrasi.markAsNotified', $registrasi->id) }}" 
                            class="w-full bg-blue-500 text-white px-4 py-2 rounded-md hover:bg-blue-600 transition">
                            Tandai Sudah Dikirim
                        </button>
                    @endif
                </div>
            </form>
    
            @if ($registrasi->is_notified)
                <p class="text-green-500 font-semibold mt-4">Pesan sudah dikirim.</p>
            @endif
    
            <p class="mt-2 text-sm text-gray-700"><strong>Catatan:</strong> {{ $registrasi->note }}</p>
        </div>
    
        <div class="flex flex-col gap-3">
            <a href="#" data-id="{{ $registrasi->id }}" data-nomor_hp="{{ $registrasi->nomor_hp }}" 
                data-email="{{ $registrasi->email }}" data-bukti="{{ asset('storage/' . $registrasi->bukti_transfer) }}"
                class="detail-btn text-center px-4 py-2 bg-purple-500 text-white rounded-md hover:bg-purple-600 transition">
                Detail
            </a>            
            <a href="{{ route('back.registrasis.kirimPesan', $registrasi->id) }}"
                class="text-center px-4 py-2 bg-blue-500 text-white rounded-md hover:bg-blue-600 transition">
                Kirim ke WhatsApp
            </a>
            <a target="_blank"
                href="https://wa.me/{{ preg_replace('/^0/', '62', '62' . ltrim($registrasi->nomor_hp, '0')) }}?text=Halo%2C%0A%0APendaftaran%20Anda%20Telah%20Diverifikasi%20oleh%20Sektretariat%20{{ $config['app_name'] }}%0A%0AAtas%20nama%20{{ $registrasi->nama }}%0AAsal%20sekolah%20{{ $registrasi->asal_sekolah }}%0ATerdaftar%20pada%20{{ $registrasi->menu->mata_pelajaran }}%0ANomor%20Registrasi%20{{ $registrasi->registration_code }}%0A%0AKartu%20dapat%20di%20unduh%20melalui%20{{ route('registrasis.pdf', $registrasi->id) }}%0A%0AKami%20tunggu%20kehadiran%20mu%20~"
                class="text-center px-4 py-2 bg-green-500 text-white rounded-md hover:bg-green-600 transition">
                Kirim Manual ke WhatsApp
            </a>
            <a href="{{ route('registrasis.pdf', $registrasi->id) }}" target="_blank"
                class="text-center px-4 py-2 bg-red-500 text-white rounded-md hover:bg-red-600 transition">
                Tampilkan PDF
            </a>
            <a href="{{ route('back.registrasis.index') }}"
                class="text-center px-4 py-2 bg-gray-500 text-white rounded-md hover:bg-gray-600 transition">
                Kembali
            </a>
        </div>
    </div>      
</div>
<div id="detailModal" class="fixed inset-0 bg-gray-800 bg-opacity-50 hidden flex justify-center items-center">
    <div class="bg-white p-6 rounded-lg shadow-lg w-200 max-h-[80vh] overflow-y-auto relative">
        <h2 class="text-xl font-bold mb-4">Detail Registrasi</h2>
        <p><strong>Nomor HP:</strong> <span id="modalNomorHp"></span></p>
        <p><strong>Email:</strong> <span id="modalEmail"></span></p>
        <p><strong>Bukti Transfer:</strong></p>
        <img id="modalBukti" class="w-full mt-2 rounded-lg shadow" src="" alt="Bukti Transfer">
        <button id="closeModal" class="mt-4 bg-red-500 text-white px-4 py-2 rounded-lg hover:bg-red-600 transition w-full">
            Tutup
        </button>
    </div>
</div>
<script>
    $(document).ready(function () {
        $(".detail-btn").click(function () {
            let nomorHp = $(this).data("nomor_hp");
            let email = $(this).data("email");
            let bukti = $(this).data("bukti");

            $("#modalNomorHp").text(nomorHp);
            $("#modalEmail").text(email);
            $("#modalBukti").attr("src", bukti);

            $("#detailModal").removeClass("hidden");
        });

        $("#closeModal").click(function () {
            $("#detailModal").addClass("hidden");
        });

        $("#detailModal").click(function (e) {
            if ($(e.target).is("#detailModal")) {
                $(this).addClass("hidden");
            }
        });
    });
</script>
@endsection
