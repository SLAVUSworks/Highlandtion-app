@extends('back.layouts.app')

@section('title', 'Rekapitulasi Data')

@section('content')

<h1 class="text-2xl font-bold mb-4">Rekapitulasi Data Pendaftar</h1>

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

<button id="downloadCsv" class="bg-green-500 hover:bg-green-700 text-white font-bold py-2 px-4 rounded">
    <i class="fa-solid fa-file-excel mr-3"></i> Unduh Rekap Data
</button>

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
                alert("Pilih minimal satu kolom!");
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
