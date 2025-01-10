@extends('back.layouts.app')

@section('title', 'Review Registrasi')

@section('content')
<div class="container mx-auto px-4 py-6">
    <h1 class="text-2xl font-bold mb-4">Verifikasi Registrasi</h1>
    <form action="{{ route('back.registrasis.update', $registrasi->id) }}" method="POST">
        @csrf
        @method('PUT')

        <div class="mb-4">
            <label for="nama" class="block text-gray-700 font-bold mb-2">Nama Peserta</label>
            <input type="text" id="nama" name="nama" value="{{ $registrasi->nama }}" disabled
                class="w-full px-4 py-2 border border-gray-300 rounded-lg bg-gray-100">
        </div>

        <div class="mb4">
            <label for="asal_sekolah" class="block text-gray-700 font-bold mb-2">Asal Sekolah</label>
            <input type="text" id="asal_sekolah" name="asal_sekolah" value="{{ $registrasi->asal_sekolah }}" disabled
                class="w-full px-4 py-2 border border-gray-300 rounded-lg bg-gray-100">
        </div>

        <div class="mb4">
            <label for="email" class="block text-gray-700 font-bold mb-2">Email</label>
            <input type="email" id="email" name="email" value="{{ $registrasi->email }}" disabled
                class="w-full px-4 py-2 border border-gray-300 rounded-lg bg-gray-100">
        </div>

        <div class="mb4">
            <label for="nomor_hp" class="block text-gray-700 font-bold mb-2">Nomer HP</label>
            <input type="number" id="nomor_hp" name="nomor_hp" value="{{ $registrasi->nomor_hp }}" disabled
                class="w-full px-4 py-2 border border-gray-300 rounded-lg bg-gray-100">
        </div>

        <div class="mb4">
            <label for="bukti_pembayaran" class="block text-gray-700 font-bold mb-2">Bukti Pembayaran</label>
            <img 
                src="{{ asset('storage/' . $registrasi->bukti_transfer) }}" 
                alt="Bukti Pembayaran" 
                class="w-14 cursor-pointer"
                onclick="openModal(this)"
            >
        </div>
        
        <!-- Modal -->
        <div id="imageModal" class="fixed inset-0 bg-black bg-opacity-75 flex items-center justify-center hidden">
            <div class="relative">
                <img id="modalImage" src="" alt="Modal View" class="max-w-full max-h-screen rounded">
                <button 
                    class="absolute top-2 right-2 text-black text-4xl font-bold cursor-pointer text-black"
                    onclick="closeModal()"
                >×</button>
            </div>
        </div>

        <script>
            function openModal(image) {
                const modal = document.getElementById('imageModal');
                const modalImage = document.getElementById('modalImage');
                modalImage.src = image.src;
                modal.classList.remove('hidden');
            }
        
            function closeModal() {
                const modal = document.getElementById('imageModal');
                modal.classList.add('hidden');
            }
        </script>

        <div class="mb4">
            <label for="menu_id" class="block text-gray-700 font-bold mb-2">Menu</label>
            <input type="text" id="menu_id" name="menu_id" value="{{ $registrasi->menu->mata_pelajaran }} - {{ $registrasi->menu->tingkat }}" disabled
                class="w-full px-4 py-2 border border-gray-300 rounded-lg bg-gray-100">
        </div>

        <div class="mb-4">
            <label for="ruangan_id" class="block text-gray-700 font-bold mb-2">Pilih Ruangan</label>
            <select id="ruangan_id" name="ruangan_id" required
                class="w-full px-4 py-2 border border-gray-300 rounded-lg">
                <option value="">-- Pilih Ruangan --</option>
                @foreach($ruangans as $ruangan)
                <option value="{{ $ruangan->id }}">{{ $ruangan->nama_ruangan }}</option>
                @endforeach
            </select>
        </div>

        <button type="submit" class="bg-green-500 text-white px-4 py-2 rounded-lg hover:bg-green-600">
            Setujui dan Tempatkan
        </button>
    </form>
    
    <script>
        document.querySelector('form').addEventListener('submit', function(event) {
            event.preventDefault();  // Mencegah form untuk langsung submit
    
            var form = this;
    
            // Submit form menggunakan fetch API untuk menghindari reload
            fetch(form.action, {
                method: form.method,
                body: new FormData(form)
            })
            .then(response => {
                // Setelah submit berhasil, arahkan ke halaman showCard
                if (response.ok) {
                    window.location.href = "{{ route('back.registrasis.showCard', $registrasi->id) }}";
                } else {
                    alert('Terjadi kesalahan saat mengirim data');
                }
            })
            .catch(error => {
                console.error('Error:', error);
                alert('Terjadi kesalahan');
            });
        });
    </script>
        {{-- <button type="button" class="bg-red-500 text-white px-4 py-2 rounded-lg hover:bg-red-600" onclick="rejectRegistration()">Tolak</button> --}}
        <button type="reset" class="bg-gray-500 text-white px-4 py-2 rounded-lg hover:bg-green-600"><a href="{{ route('back.registrasis.index') }}">Kembali</a></button>
{{-- 
        <script>
            function rejectRegistration() {
                if (confirm('Apakah Anda yakin ingin menolak registrasi ini?')) {
                    document.querySelector('form').action = "{{ route('back.registrasis.reject', $registrasi->id) }}";
                    document.querySelector('form').submit();
                }
            }
        </script> --}}
        </form>
</div>
@endsection
