@extends('back.layouts.app')

@section('title', 'Rekapitulasi Data')

@section('content')

<h1 class="text-2xl font-bold mb-4">Statistik Pendaftar</h1>

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


<div class="grid grid-cols-1 md:grid-cols-2 lg:grid-cols-4 gap-4 mb-6">
    <div class="bg-white shadow rounded-lg p-4">
        <h2 class="text-lg font-bold">Total Pendaftar</h2>
        <p class="text-xl">{{ $totalPendaftar }}</p>
    </div>
    <div class="bg-white shadow rounded-lg p-4">
        <h2 class="text-lg font-bold">Total Diverifikasi</h2>
        <p class="text-xl">{{ $totalDiverifikasi }}</p>
    </div>
    <div class="bg-white shadow rounded-lg p-4">
        <h2 class="text-lg font-bold">Pendaftar Pertama</h2>
        <p class="text-sm">{{ $pendaftarPertama }}</p>
    </div>
    <div class="bg-white shadow rounded-lg p-4">
        <h2 class="text-lg font-bold">Terakhir Diperbarui</h2>
        <p class="text-sm">{{ $terakhirDiupdate }}</p>
    </div>
</div>

<canvas id="chart" class="w-full mb-6"></canvas>

<h1 class="text-2xl font-bold mb-4">Rekap Data Pendaftar</h1>

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

<h1 class="text-2xl font-bold my-4">Reset Data Event</h1>

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
                    "<b>Menu</b><br>" +
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
<div id="exportModal" class="fixed inset-0 bg-gray-800 bg-opacity-50 flex justify-center items-center hidden">
    <div class="bg-white p-6 rounded-lg shadow-lg w-96">
        <h2 class="text-xl font-bold mb-4">Pilih Kolom</h2>
        <form id="exportForm">
            <div class="grid grid-cols-2 gap-2">
                <label><input type="checkbox" name="columns[]" value="id" checked> ID</label>
                <label><input type="checkbox" name="columns[]" value="nama" checked> Nama</label>
                <label><input type="checkbox" name="columns[]" value="asal_sekolah" checked> Asal Sekolah</label>
                <label><input type="checkbox" name="columns[]" value="nomor_hp"> Nomor HP</label>
                <label><input type="checkbox" name="columns[]" value="menu.menu_category.name"> Kategori</label>
                <label><input type="checkbox" name="columns[]" value="menu.mata_pelajaran"> Mata Pelajaran</label>
                <label><input type="checkbox" name="columns[]" value="menu.tingkat"> Tingkat</label>
                <label><input type="checkbox" name="columns[]" value="menu.ruangan"> Ruangan</label>
                <label><input type="checkbox" name="columns[]" value="status"> Status</label>
                <label><input type="checkbox" name="columns[]" value="registration_code"> Kode Registrasi</label>
                <label><input type="checkbox" name="columns[]" value="created_at"> Didaftarkan</label>
                <label><input type="checkbox" name="columns[]" value="updated_at"> Diperbarui</label>
            </div>

            <div class="flex justify-end mt-4">
                <button type="button" id="cancelExport" class="mr-2 bg-gray-400 text-white px-3 py-2 rounded-lg hover:bg-gray-500">Batal</button>
                <button type="submit" class="bg-green-500 text-white px-3 py-2 rounded-lg hover:bg-green-600">Download CSV</button>
            </div>
        </form>
    </div>
</div>

{{-- Advance Export --}}
<div id="advanceExportModal" class="fixed inset-0 bg-gray-800 bg-opacity-50 flex justify-center items-center hidden">
    <div class="bg-white p-6 rounded-lg shadow-lg w-96">
        <h2 class="text-xl font-bold mb-4">Advance Export</h2>

        <form id="advanceExportForm">
            <label class="block mb-2 font-semibold">Pilih Parameter Pengelompokan</label>
            <p class="font-thin text-sm mb-2">Data akan dipisah Per-Sheet berdasarkan Parameter dipilih.</p>
            <select id="groupBy" name="groupBy" class="w-full p-2 border rounded">
                <option value="ruangan">Ruangan</option>
                <option value="kategori">Kategori</option>
                <option value="mata_pelajaran">Mata Pelajaran</option>
                <option value="tingkat">Tingkat</option>
                <option value="status">Status</option>
            </select>

            <div class="flex justify-end mt-4">
                <button type="button" id="cancelAdvanceExport" class="mr-2 bg-gray-400 text-white px-3 py-2 rounded-lg hover:bg-gray-500">
                    Batal
                </button>
                <button type="submit" class="bg-green-500 text-white px-3 py-2 rounded-lg hover:bg-green-600">
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


<script src="https://cdn.jsdelivr.net/npm/chart.js"></script>
<script>
    const labels = @json($pendaftarPerTanggal->pluck('tanggal'));
    const data = @json($pendaftarPerTanggal->pluck('jumlah'));

    const chartData = {
        labels: labels,
        datasets: [{
            label: 'Jumlah Pendaftar',
            data: data,
            backgroundColor: 'rgba(75, 192, 192, 0.2)',
            borderColor: 'rgba(75, 192, 192, 1)',
            borderWidth: 1
        }]
    };

    const config = {
        type: 'line',
        data: chartData,
        options: {
            responsive: true,
            plugins: {
                legend: {
                    position: 'top',
                },
                title: {
                    display: true,
                    text: 'Statistik Pendaftar'
                }
            },
            scales: {
                x: {
                    title: {
                        display: true,
                        text: 'Tanggal'
                    }
                },
                y: {
                    title: {
                        display: true,
                        text: 'Jumlah Pendaftar'
                    },
                    beginAtZero: true
                }
            }
        }
    };

    const ctx = document.getElementById('chart').getContext('2d');
    new Chart(ctx, config);
</script>

@endsection
