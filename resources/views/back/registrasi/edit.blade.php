@extends('back.layouts.app')

@section('title', 'Review Registrasi')

@section('content')
@if ($errors->any())
@foreach ($errors->all() as $error)
<script>
    Swal.fire({
        icon: 'error',
        title:'Gagal',
        text: "{{ $error }}",
    });
</script>
@endforeach
@endif
<div class="container mx-auto px-4 py-6">
    <h1 class="text-2xl font-bold mb-4">Verifikasi Registrasi</h1>
    <form id="registrasiForm" action="{{ route('back.registrasis.update', $registrasi->id) }}" method="POST">
        @csrf
        @method('PUT')

        @if ($registrasi->status === 'rejected')
        <div class="mb-4">
            <label for="nama" class="block text-gray-700 font-bold mb-2">Nama Peserta</label>
            <input type="text" id="nama" name="nama" value="{{ $registrasi->nama }}" disabled
                class="w-full px-4 py-2 border border-red-300 rounded-lg bg-red-100">
        </div>

        <div class="mb-4">
            <label for="asal_sekolah" class="block text-gray-700 font-bold mb-2">Asal Sekolah</label>
            <input type="text" id="asal_sekolah" name="asal_sekolah" value="{{ $registrasi->asal_sekolah }}" disabled
                class="w-full px-4 py-2 border border-red-300 rounded-lg bg-red-100">
        </div>

        <div class="mb-4">
            <label for="email" class="block text-gray-700 font-bold mb-2">Email</label>
            <input type="email" id="email" name="email" value="{{ $registrasi->email }}" disabled
                class="w-full px-4 py-2 border border-red-300 rounded-lg bg-red-100">
        </div>

        <div class="mb-4">
            <label for="nomor_hp" class="block text-gray-700 font-bold mb-2">Nomer HP</label>
            <input type="number" id="nomor_hp" name="nomor_hp" value="{{ $registrasi->nomor_hp }}" disabled
                class="w-full px-4 py-2 border border-red-300 rounded-lg bg-red-100">
        </div>
        @else
        <div class="mb-4">
            <label for="nama" class="block text-gray-700 font-bold mb-2">Nama Peserta</label>
            <input type="text" id="nama" name="nama" value="{{ $registrasi->nama }}" disabled
                class="w-full px-4 py-2 border border-gray-300 rounded-lg bg-gray-100">
        </div>

        <div class="mb-4">
            <label for="asal_sekolah" class="block text-gray-700 font-bold mb-2">Asal Sekolah</label>
            <input type="text" id="asal_sekolah" name="asal_sekolah" value="{{ $registrasi->asal_sekolah }}" disabled
                class="w-full px-4 py-2 border border-gray-300 rounded-lg bg-gray-100">
        </div>

        <div class="mb-4">
            <label for="email" class="block text-gray-700 font-bold mb-2">Email</label>
            <input type="email" id="email" name="email" value="{{ $registrasi->email }}" disabled
                class="w-full px-4 py-2 border border-gray-300 rounded-lg bg-gray-100">
        </div>

        <div class="mb-4">
            <label for="nomor_hp" class="block text-gray-700 font-bold mb-2">Nomer HP</label>
            <input type="number" id="nomor_hp" name="nomor_hp" value="{{ $registrasi->nomor_hp }}" disabled
                class="w-full px-4 py-2 border border-gray-300 rounded-lg bg-gray-100">
        </div>            
        @endif
        <div class="mb-4">
            <label for="bukti_pembayaran" class="block text-gray-700 font-bold mb-2">Bukti Pembayaran</label>
            <img 
                src="{{ asset('storage/' . $registrasi->bukti_transfer) }}" 
                alt="Bukti Pembayaran" 
                class="w-14 cursor-pointer"
                onclick="openModal(this)"
            >
        </div>
        
        <!-- Modal -->
        <div id="imageModal" class="fixed inset-0 bg-black bg-opacity-75 flex items-center justify-center hidden" onclick="closeModal(event)">
            <div class="relative" id="modalContent" onclick="event.stopPropagation()">
            <img id="modalImage" src="" alt="Modal View" class="max-w-full max-h-screen rounded transform transition-transform duration-300">
            <button 
            class="absolute top-2 right-2 text-black text-4xl font-bold cursor-pointer text-black"
            onclick="closeModal()"
            >×</button>
            <div class="absolute bottom-2 left-2 flex space-x-2">
            <button 
            class="bg-white text-black px-2 py-1 rounded-lg"
            onclick="zoomIn()"
            >+</button>
            <button 
            class="bg-white text-black px-2 py-1 rounded-lg"
            onclick="zoomOut()"
            >-</button>
            </div>
            </div>
        </div>

        <script>
            let scale = 1;

            function openModal(image) {
            const modal = document.getElementById('imageModal');
            const modalImage = document.getElementById('modalImage');
            modalImage.src = image.src;
            modal.classList.remove('hidden');
            }
        
            function closeModal(event) {
            if (event.target.id === 'imageModal') {
                const modal = document.getElementById('imageModal');
                modal.classList.add('hidden');
                resetZoom();
            }
            }

            function zoomIn() {
            scale += 0.1;
            document.getElementById('modalImage').style.transform = `scale(${scale})`;
            }

            function zoomOut() {
            if (scale > 0.1) {
                scale -= 0.1;
                document.getElementById('modalImage').style.transform = `scale(${scale})`;
            }
            }

            function resetZoom() {
            scale = 1;
            document.getElementById('modalImage').style.transform = `scale(${scale})`;
            }
        </script>
        @if ($registrasi->status === 'rejected')
        <div class="mb-4">
            <label for="menu_id" class="block text-gray-700 font-bold mb-2">Menu</label>
            <input type="text" id="menu_id" name="menu_id" value="{{ $registrasi->menu->mata_pelajaran }} - {{ $registrasi->menu->tingkat }}" disabled
                class="w-full px-4 py-2 border border-red-300 rounded-lg bg-red-100">
        </div>
        @else
        <div class="mb-4">
            <label for="menu_id" class="block text-gray-700 font-bold mb-2">Menu</label>
            <input type="text" id="menu_id" name="menu_id" value="{{ $registrasi->menu->mata_pelajaran }} - {{ $registrasi->menu->tingkat }}" disabled
                class="w-full px-4 py-2 border border-gray-300 rounded-lg bg-gray-100">
        </div>
        @endif
        @if ($registrasi->status === 'rejected')
            
        @else
        <div class="mb-4">
            <label for="ruangan_id" class="block text-gray-700 font-bold mb-2">Pilih Ruangan</label>
            <select id="ruangan_id" name="ruangan_id" required
                class="w-full px-4 py-2 border border-gray-300 rounded-lg">
                <option value="">-- Pilih Ruangan --</option>
                @foreach($ruangans as $ruangan)
                <option value="{{ $ruangan->id }}" 
                        @if($ruangan->kuota_now == $ruangan->kuota) disabled @endif>
                    {{ $ruangan->nama_ruangan }} - @if($ruangan->kuota_now == NULL)0/{{ $ruangan->kuota }}@else{{ $ruangan->kuota_now }}/{{ $ruangan->kuota }}@endif
                </option>
                @endforeach
            </select>
        </div>
        <div class="mb-4">
            <input type="checkbox" id="confirmRuangan" name="confirmRuangan" required>
            <label for="confirmRuangan" class="text-gray-700 font-bold">Saya telah memastikan pembayaran tersebut valid.</label>
        </div>
        @endif
        <div class="flex space-x-4 mt-3">
        </form>
            @if ($registrasi->status === 'rejected')
                <button 
                    type="button" 
                    id="restoreButton" 
                    class="bg-yellow-500 text-white px-4 py-2 rounded-lg hover:bg-yellow-600"
                    data-url="{{ route('back.registrasis.restore', $registrasi->id) }}">
                    Pulihkan
                </button>
                <form action="{{ route('back.registrasis.destroy', $registrasi->id) }}" method="POST" onsubmit="return confirmDelete(event)">
                    @csrf
                    @method('DELETE')
                    <button type="submit" class="bg-red-500 text-white px-4 py-2 rounded-lg hover:bg-red-600">
                        Hapus
                    </button>
                </form>
            @else
                <button type="button" id="confirmButton" class="bg-green-500 text-white px-4 py-2 rounded-lg hover:bg-green-600" disabled>
                    Setuju dan Tempatkan
                </button>
        
                <form id="rejectForm" action="{{ route('back.registrasis.reject', $registrasi->id) }}" method="POST">
                    @csrf
                    @method('PUT')
                    <button type="button" id="rejectButton" class="bg-red-500 text-white px-4 py-2 rounded-lg hover:bg-red-600">
                        Tolak
                    </button>
                </form>
            @endif
        
            <a href="{{ route('back.registrasis.index') }}" class="bg-gray-500 text-white px-4 py-2 rounded-lg hover:bg-gray-600">
                Kembali
            </a>
        </div>
        <script>
            document.getElementById('confirmRuangan').addEventListener('change', function () {
                document.getElementById('confirmButton').disabled = !this.checked;
            });
        
            document.getElementById('confirmButton').addEventListener('click', function () {
                Swal.fire({
                    title: 'Apakah Anda yakin?',
                    text: "Anda menyetujui dan tidak akan dapat mengembalikan ini!",
                    icon: 'warning',
                    showCancelButton: true,
                    confirmButtonColor: '#3085d6',
                    cancelButtonColor: '#d33',
                    confirmButtonText: 'Ya, setuju!',
                }).then((result) => {
                    if (result.isConfirmed) {
                        document.getElementById('registrasiForm').submit();
                    }
                });
            });
        
            document.getElementById('rejectButton').addEventListener('click', function () {
                Swal.fire({
                    title: 'Apakah Anda yakin?',
                    text: "Registrasi ini tidak memenuhi syarat untuk disetujui!",
                    icon: 'warning',
                    showCancelButton: true,
                    confirmButtonColor: '#d33',
                    cancelButtonColor: '#3085d6',
                    confirmButtonText: 'Ya, tolak!',
                    cancelButtonText: 'Batal',
                }).then((result) => {
                    if (result.isConfirmed) {
                        document.getElementById('rejectForm').submit();
                    }
                });
            });
        
            function confirmDelete(event) {
                event.preventDefault();
                Swal.fire({
                    title: 'Apakah Anda yakin?',
                    text: "Data akan dihapus permanen!",
                    icon: 'warning',
                    showCancelButton: true,
                    confirmButtonColor: '#d33',
                    cancelButtonColor: '#3085d6',
                    confirmButtonText: 'Ya, hapus!',
                    cancelButtonText: 'Batal',
                }).then((result) => {
                    if (result.isConfirmed) {
                        event.target.submit();
                    }
                });
            }
        </script>
        <script>
            document.getElementById('restoreButton').addEventListener('click', function () {
                let restoreUrl = this.getAttribute('data-url');
                console.log("Restore URL:", restoreUrl);

                Swal.fire({
                    title: 'Apakah Anda yakin ingin memulihkan registrasi ini?',
                    icon: 'warning',
                    showCancelButton: true,
                    confirmButtonColor: '#3085d6',
                    cancelButtonColor: '#d33',
                    confirmButtonText: 'Ya, Pulihkan!',
                }).then((result) => {
                    if (result.isConfirmed) {
                        fetch(restoreUrl, {
                            method: 'PUT',
                            headers: {
                                'X-CSRF-TOKEN': '{{ csrf_token() }}',
                                'Content-Type': 'application/json'
                            }
                        }).then(response => {
                            if (!response.ok) {
                                throw new Error('Gagal memulihkan registrasi.');
                            }
                            console.log("Registrasi berhasil dipulihkan");
                            Swal.fire('Sukses!', 'Registrasi berhasil dipulihkan.', 'success');
                            setTimeout(() => location.reload(), 1000);
                        }).catch(error => {
                            console.error("Fetch error:", error);
                            Swal.fire('Error!', error.message, 'error');
                        });
                    }
                });
            });
        </script>
    </div>
</div>
@endsection
