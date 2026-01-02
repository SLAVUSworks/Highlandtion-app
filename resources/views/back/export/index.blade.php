@extends('back.layouts.app')

@section('title', 'Rekapitulasi Data')

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

@if(session('error'))
<script>
Swal.fire({
    icon: 'error',
    title: 'Gagal',
    text: '{{ session('error') }}',
});
</script>
@endif

@if(session('success'))
<script>
Swal.fire({
    icon: 'success',
    title: 'Berhasil',
    text: '{{ session('success') }}',
});
</script>
@endif

<div class="mb-6 rounded-lg bg-white/60 backdrop-blur px-6 py-4 shadow-sm border border-gray-200">
    <h1 class="flex items-center gap-3 text-3xl font-semibold text-gray-800">
        <span class="h-8 w-1.5 rounded-full bg-teal-500"></span>
        Rekap Data Pendaftaran Peserta
    </h1>
    <p class="mt-1 text-sm text-gray-500">
        Unduh rekapitulasi data pendaftaran peserta dalam format Excel
    </p>
</div>

<div class="space-y-6">

    <div class="p-5 bg-white rounded-lg shadow border border-gray-200">
        <h1 class="text-xl font-semibold text-gray-800 mb-2 flex items-center">
            <i class="fa-solid fa-file-export text-green-600 mr-2"></i>
            Standard Export
        </h1>
        <p class="text-gray-600 mb-4">
            Unduh Rekapitulasi Data secara keseluruhan tanpa parameter tambahan.
        </p>

        <button id="downloadCsv"
            class="flex items-center bg-green-500 hover:bg-green-600 transition text-white font-semibold py-2 px-4 rounded-md shadow">
            <i class="fa-solid fa-file-excel mr-2"></i>
            Standard Export
        </button>
    </div>

    <div class="p-5 bg-white rounded-lg shadow border border-gray-200">
        <h1 class="text-xl font-semibold text-gray-800 mb-2 flex items-center">
            <i class="fa-solid fa-sliders text-blue-600 mr-2"></i>
            Advance Export
        </h1>
        <p class="text-gray-600 mb-4">
            Unduh Rekapitulasi Data dengan Parameter Pilihan untuk hasil yang lebih terperinci. Data akan terpisah per-sheet berdasarkan parameter yang dipilih.
        </p>

        <button type="button" id="openAdvanceExport"
            class="flex items-center bg-blue-500 hover:bg-blue-600 transition text-white font-semibold py-2 px-4 rounded-md shadow">
            <i class="fa-solid fa-gear mr-2"></i>
            Advance Export
        </button>
    </div>
</div>

<div class="mb-6 rounded-lg bg-white/60 backdrop-blur px-6 py-4 shadow-sm border border-gray-200 mt-6">
    <h1 class="flex items-center gap-3 text-3xl font-semibold text-gray-800">
        <span class="h-8 w-1.5 rounded-full bg-red-500"></span>
        Reset Data Event
    </h1>
    <p class="mt-1 text-sm text-gray-500">
        Zona bahaya, harap melakukan backup data sebelum melakukan reset database.
    </p>
</div>

<div class="space-y-6">
    <div class="p-5 bg-white rounded-lg shadow border border-gray-200 mt-4">
        <h1 class="text-xl font-semibold text-gray-800 mb-2 flex items-center">
            <i class="fa-solid fa-database text-red-600 mr-2"></i>
            Reset Database
        </h1>
        <p class="text-gray-600 mb-4">
            Menghapus seluruh data dari tabel tertentu dan meresetnya ke kondisi awal. 
            Tindakan ini tidak dapat dibatalkan.
        </p>

        <form id="resetDBForm" action="{{ route('back.resetdb') }}" method="POST">
            @csrf
            <input type="hidden" name="password" id="passwordInput">
            <button type="button" id="resetDBButton"
                class="flex items-center bg-red-500 hover:bg-red-600 transition text-white font-semibold py-2 px-4 rounded-md shadow">
                <i class="fa-solid fa-triangle-exclamation mr-2"></i>
                Reset Database
            </button>
        </form>
    </div>
</div>

<script>
document.getElementById('resetDBButton').addEventListener('click', function() {

    Swal.fire({
        title: 'Masukkan Password',
        text: 'Untuk melanjutkan reset database, masukkan password akun Anda.',
        input: 'password',
        inputPlaceholder: 'Password...',
        icon: 'warning',
        showCancelButton: true,
        confirmButtonText: 'Lanjut',
        cancelButtonText: 'Batal'
    }).then((result) => {

        if (!result.isConfirmed) return;

        document.getElementById('passwordInput').value = result.value;

        fetch("{{ route('back.resetdb') }}", {
            method: "POST",
            headers: {
                "X-CSRF-TOKEN": "{{ csrf_token() }}",
                "Content-Type": "application/json"
            },
            body: JSON.stringify({
                password: result.value,
                checkOnly: true
            })
        })
        .then(res => res.json())
        .then(data => {

            if (!data.valid) {
                Swal.fire({
                    title: 'Password Salah',
                    text: 'Password yang Anda masukkan tidak sesuai.',
                    icon: 'error'
                });
                return;
            }
            Swal.fire({
                title: 'Yakin ingin reset database?',
                html:
                    "Semua riwayat data dari:<br>" +
                    "<b>Kategori</b><br>" +
                    "<b>Event</b><br>" +
                    "<b>Ruangan</b><br>" +
                    "<b>Pendaftar</b><br>" +
                    "Akan dihapus dan dikembalikan ke kondisi awal.<br><br>" +
                    "<span class='text-red-600 font-semibold'>Perubahan ini tidak dapat dikembalikan!</span>",
                icon: 'warning',
                showCancelButton: true,
                confirmButtonColor: '#e02424',
                cancelButtonColor: '#6b7280',
                confirmButtonText: 'Ya, Reset!',
                cancelButtonText: 'Batal'
            }).then((konfirmasi) => {
                if (konfirmasi.isConfirmed) {
                    document.getElementById('resetDBForm').submit();
                }
            });

        });

    });

});
</script>


{{-- Standard Export --}}
<div id="exportModal"
     class="fixed inset-0 z-50 flex items-center justify-center bg-black/50 hidden">
    <div class="w-full max-w-lg rounded-md bg-white shadow-2xl">
        <div class="border-b px-6 py-4">
            <h2 class="text-lg font-semibold text-gray-800">
                Pilih Kolom Export
            </h2>
            <p class="text-sm text-gray-500">
                Centang kolom yang ingin disertakan
            </p>
        </div>
        <form id="exportForm" class="px-6 py-5">
            <div class="grid grid-cols-1 sm:grid-cols-2 gap-3">
                <label class="flex items-center gap-3 rounded-md border p-3 cursor-pointer
                              hover:bg-gray-50 transition">
                    <input type="checkbox" name="columns[]" value="nomor_urut_formatted"
                           checked
                           class="h-5 w-5 text-green-600 rounded-lg focus:ring-green-500">
                    <span class="text-sm font-medium text-gray-700">
                        Nomor Urut
                    </span>
                </label>
                <label class="flex items-center gap-3 rounded-md border p-3 cursor-pointer hover:bg-gray-50 transition">
                    <input type="checkbox" name="columns[]" value="id" checked
                           class="h-5 w-5 text-green-600 rounded-lg focus:ring-green-500">
                    <span class="text-sm font-medium text-gray-700">ID</span>
                </label>
                <label class="flex items-center gap-3 rounded-md border p-3 cursor-pointer hover:bg-gray-50 transition">
                    <input type="checkbox" name="columns[]" value="nama" checked
                           class="h-5 w-5 text-green-600 rounded-lg focus:ring-green-500">
                    <span class="text-sm font-medium text-gray-700">Nama</span>
                </label>
                <label class="flex items-center gap-3 rounded-md border p-3 cursor-pointer hover:bg-gray-50 transition">
                    <input type="checkbox" name="columns[]" value="asal_sekolah" checked
                           class="h-5 w-5 text-green-600 rounded-lg focus:ring-green-500">
                    <span class="text-sm font-medium text-gray-700">Asal Sekolah</span>
                </label>
                <label class="flex items-center gap-3 rounded-md border p-3 cursor-pointer hover:bg-gray-50 transition">
                    <input type="checkbox" name="columns[]" value="nomor_hp"
                           class="h-5 w-5 text-green-600 rounded-lg focus:ring-green-500">
                    <span class="text-sm font-medium text-gray-700">Nomor HP</span>
                </label>
                <label class="flex items-center gap-3 rounded-md border p-3 cursor-pointer hover:bg-gray-50 transition">
                    <input type="checkbox" name="columns[]" value="menu.menu_category.name"
                           class="h-5 w-5 text-green-600 rounded-lg focus:ring-green-500">
                    <span class="text-sm font-medium text-gray-700">Kategori</span>
                </label>
                <label class="flex items-center gap-3 rounded-md border p-3 cursor-pointer hover:bg-gray-50 transition">
                    <input type="checkbox" name="columns[]" value="menu.mata_pelajaran"
                           class="h-5 w-5 text-green-600 rounded-lg focus:ring-green-500">
                    <span class="text-sm font-medium text-gray-700">Event</span>
                </label>
                <label class="flex items-center gap-3 rounded-md border p-3 cursor-pointer hover:bg-gray-50 transition">
                    <input type="checkbox" name="columns[]" value="menu.tingkat"
                           class="h-5 w-5 text-green-600 rounded-lg focus:ring-green-500">
                    <span class="text-sm font-medium text-gray-700">Tingkat</span>
                </label>
                <label class="flex items-center gap-3 rounded-md border p-3 cursor-pointer hover:bg-gray-50 transition">
                    <input type="checkbox" name="columns[]" value="menu.ruangan"
                           class="h-5 w-5 text-green-600 rounded-lg focus:ring-green-500">
                    <span class="text-sm font-medium text-gray-700">Ruangan</span>
                </label>
                <label class="flex items-center gap-3 rounded-md border p-3 cursor-pointer hover:bg-gray-50 transition">
                    <input type="checkbox" name="columns[]" value="status"
                           class="h-5 w-5 text-green-600 rounded-lg focus:ring-green-500">
                    <span class="text-sm font-medium text-gray-700">Status</span>
                </label>
                <label class="flex items-center gap-3 rounded-md border p-3 cursor-pointer hover:bg-gray-50 transition">
                    <input type="checkbox" name="columns[]" value="registration_code"
                           class="h-5 w-5 text-green-600 rounded-lg focus:ring-green-500">
                    <span class="text-sm font-medium text-gray-700">Kode Registrasi</span>
                </label>
                <label class="flex items-center gap-3 rounded-md border p-3 cursor-pointer hover:bg-gray-50 transition">
                    <input type="checkbox" name="columns[]" value="created_at"
                           class="h-5 w-5 text-green-600 rounded-lg focus:ring-green-500">
                    <span class="text-sm font-medium text-gray-700">Tanggal Daftar</span>
                </label>
                <label class="flex items-center gap-3 rounded-md border p-3 cursor-pointer hover:bg-gray-50 transition">
                    <input type="checkbox" name="columns[]" value="updated_at"
                           class="h-5 w-5 text-green-600 rounded-lg focus:ring-green-500">
                    <span class="text-sm font-medium text-gray-700">Tanggal Update</span>
                </label>
            </div>
            <div class="mt-6 flex justify-end gap-3">
                <button type="button" id="cancelExport"
                        class="rounded-md border px-4 py-2 text-sm font-medium text-gray-600 hover:bg-gray-100">
                    Batal
                </button>
                <button type="submit"
                        class="rounded-md bg-green-600 px-5 py-2 text-sm font-semibold text-white hover:bg-green-700">
                    Download CSV
                </button>
            </div>
        </form>
    </div>
</div>

{{-- Advance Export --}}
<div id="advanceExportModal"
     class="fixed inset-0 z-50 flex items-center justify-center bg-black/50 hidden">
    <div class="w-full max-w-md rounded-md bg-white shadow-2xl">
        <div class="border-b px-6 py-4">
            <h2 class="text-lg font-semibold text-gray-800">
                Advanced Export
            </h2>
            <p class="mt-1 text-sm text-gray-500">
                Data akan dipisahkan ke beberapa sheet berdasarkan parameter pilihan.
            </p>
        </div>
        <form id="advanceExportForm" class="px-6 py-5 space-y-4">
            <div>
                <label for="groupBy" class="block text-sm font-medium text-gray-700 mb-1">
                    Parameter Pengelompokan
                </label>
                <select id="groupBy" name="groupBy"
                        class="w-full rounded-md border px-3 py-2 text-sm
                               focus:border-green-500 focus:ring-green-500">
                    <option value="ruangan">Ruangan</option>
                    <option value="kategori">Kategori</option>
                    <option value="mata_pelajaran">Event</option>
                    <option value="tingkat">Tingkat</option>
                    <option value="status">Status</option>
                </select>
            </div>
            <div class="flex justify-end gap-3 pt-4">
                <button type="button" id="cancelAdvanceExport"
                        class="rounded-md border px-4 py-2 text-sm font-medium text-gray-600 hover:bg-gray-100">
                    Batal
                </button>
                <button type="submit"
                        class="rounded-md bg-green-600 px-5 py-2 text-sm font-semibold text-white hover:bg-green-700">
                    Download XLSX
                </button>
            </div>
        </form>
    </div>
</div>


<script>
    $(document).ready(function () {
        const modal = $("#advanceExportModal");
        const openBtn = $("#openAdvanceExport");
        const cancelBtn = $("#cancelAdvanceExport");
        const exportForm = $("#advanceExportForm");

        openBtn.on("click", function () {
            modal.removeClass("hidden");
        });

        cancelBtn.on("click", function () {
            modal.addClass("hidden");
        });

        exportForm.on("submit", function (e) {
            e.preventDefault();

            const groupBy = $("#groupBy").val();
            const exportUrl = "{{ route('back.export.advance') }}?groupBy=" + encodeURIComponent(groupBy);

            window.location.href = exportUrl;
            modal.addClass("hidden");
        });
    });
</script>

<script>
    $(document).ready(function () {
        const modal = $("#exportModal");
        const downloadBtn = $("#downloadCsv");
        const cancelBtn = $("#cancelExport");
        const exportForm = $("#exportForm");

        downloadBtn.on("click", function () {
            modal.removeClass("hidden");
        });

        cancelBtn.on("click", function () {
            modal.addClass("hidden");
        });

        exportForm.on("submit", function (e) {
            e.preventDefault();

            const selectedColumns = exportForm
                .find("input[name='columns[]']:checked")
                .map(function () {
                    return $(this).val();
                })
                .get();

            if (selectedColumns.length === 0) {
                Swal.fire({
                    icon: 'warning',
                    title: 'Peringatan',
                    text: 'Pilih minimal satu kolom!',
                });
                return;
            }

            const queryString = selectedColumns.map(col => `columns[]=${encodeURIComponent(col)}`).join("&");
            const exportUrl = `{{ url('back/registrasi-export') }}?${queryString}`;

            window.location.href = exportUrl;

            modal.addClass("hidden");
        });
    });
</script>

@endsection
