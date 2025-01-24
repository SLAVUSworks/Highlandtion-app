@extends('back.layouts.app')

@section('title', 'Rekapitulasi Data')

@section('content')

<h1 class="text-2xl font-bold mb-4">Rekapitulasi Data Pendaftar</h1>

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

    document.getElementById('downloadCsv').addEventListener('click', function () {
        const url = "{{ route('back.export.csv') }}";
        const link = document.createElement('a');
        link.href = url;
        link.download = 'registrasi_data.csv';
        document.body.appendChild(link);
        link.click();
        link.remove();
    });
</script>

@endsection
