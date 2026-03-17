<div class="grid grid-cols-4 gap-4">
    <div class="p-4 bg-white shadow rounded-lg">
    <h2 class="text-xl font-semibold">Total Kuota</h2>
    <p>Ruangan: <span id="ruanganKuota">{{ $ruanganKuota }}</span></p>
    <p>Event: <span id="menuKuota">{{ $menuKuota }}</span></p>
    </div>
    <div class="p-4 bg-white shadow rounded-lg">
    <h2 class="text-xl font-semibold">Sisa Kuota</h2>
    <p>Ruangan: <span id="sisaRuanganKuota">{{ $sisaKuotaRuangan }}</span></p>
    <p>Event: <span id="sisaMenuKuota">{{ $sisaKuotaMenu }}</span></p>
    </div>
    <div class="bg-white shadow rounded-lg p-4">
        <h2 class="text-xl font-bold">Total Pendaftar</h2>
        <p class="text-xl">{{ $totalPendaftar }}</p>
        <small class="text-xs block text-end">Update {{ $terakhirDiupdateReg }}</small>
    </div>
    <div class="bg-white shadow rounded-lg p-4">
        <h2 class="text-xl font-bold">Total Diverifikasi</h2>
        <p class="text-xl">{{ $totalDiverifikasi }}</p>
        <small class="text-xs block text-end">Update {{ $terakhirDiupdateVer }}</small>
    </div>
</div>

<div class="grid grid-cols-3 gap-3 mt-4">
    <div class="bg-white shadow rounded-lg p-4">
        <h2 class="text-xl font-bold">Total Revenue</h2>
        <p class="text-xl text-green-600">
            Rp {{ number_format($totalRevenue,0,',','.') }}
        </p>
    </div>
    <div class="bg-white shadow rounded-lg p-4">
        <h2 class="text-xl font-bold">Revenue Hari Ini</h2>
        <p class="text-xl text-sky-600">
            Rp {{ number_format($revenueLast24Hours,0,',','.') }}
        </p>
    </div>
    <div class="bg-white shadow rounded-lg p-4">
        <h2 class="text-xl font-bold">Max Revenue</h2>
        <p class="text-xl text-gray-800">
            Rp {{ number_format($maxRevenue,0,',','.') }}
        </p>
    </div>
</div>

<div class="bg-white shadow rounded-lg p-4 mt-4">
    <div class="mb-4 flex items-center justify-between">
        <div>
            <h2 class="text-xl font-bold">
                Analisa Revenue
            </h2>
            <p class="text-xs text-gray-500">
                Statistik pendapatan berdasarkan status pendaftar serta target pendapatan keseluruhan berdasarkan kuota event yang tersedia
            </p>
        </div>

        <span class="rounded-full bg-gray-100 px-3 py-1 text-xs font-medium text-gray-600">
            Statistik
        </span>
    </div>
    <div class="grid grid-cols-2 gap-6">
        <div class="flex items-center justify-center">
            <canvas id="revenueChart" class="max-h-72"></canvas>
        </div>
        <div class="flex flex-col gap-4">
            <div class="flex flex-col gap-4">
                <div class="border rounded-lg p-4 bg-gray-50">
                    <h3 class="text-lg font-semibold mb-2">
                        Revenue Progress
                    </h3>
                    @php
                    $approvedPercent = $maxRevenue > 0 ? ($totalRevenue / $maxRevenue) * 100 : 0;
                    $pendingPercent = $maxRevenue > 0 ? ($revenuePending / $maxRevenue) * 100 : 0;
                    @endphp
                    <p class="text-green-600 font-semibold">
                        Rp {{ number_format($totalRevenue,0,',','.') }}
                        <span class="text-yellow-600 text-sm">
                            (+{{ number_format($revenuePending,0,',','.') }})
                        </span>
                    </p>
                    <p class="text-xs text-gray-500 mb-3">
                        dari Rp {{ number_format($maxRevenue,0,',','.') }}
                    </p>
                    <div class="w-full bg-gray-200 rounded h-3 relative overflow-hidden">
                        <div class="bg-green-500 h-3 absolute left-0 top-0"
                            style="width: {{ $approvedPercent }}%">
                        </div>
                        <div class="bg-yellow-400 h-3 absolute top-0"
                            style="left: {{ $approvedPercent }}%; width: {{ $pendingPercent }}%">
                        </div>
                    </div>
                    <small class="text-sm mt-1 block">
                        {{ number_format($approvedPercent,1) }}%
                        <span class="text-yellow-600 text-xs">
                            ({{ number_format($pendingPercent,1) }}% pending)
                        </span>
                    </small>
                </div>
            </div>
            <div class="border rounded-lg p-4 bg-gray-50">
                <h3 class="text-lg font-semibold mb-2">
                    Rekening Pembayaran
                </h3>
                <div class="flex items-center gap-3">
                    <img 
                        src="{{ $config['logo-bank'] ?? 'N/A' }}" 
                        alt="{{ $config['nama-bank'] ?? 'N/A' }} Logo"
                        class="h-12 w-auto">
                    <div>
                        <p class="text-xs text-gray-500">{{ $config['nama-bank'] ?? 'N/A' }}</p>
                        <p class="font-mono text-lg font-semibold tracking-wider">
                            {{ $config['nomor-rekening'] ?? 'N/A' }}
                        </p>
                        <p class="text-xs text-gray-600">
                            {{ $config['nama-pemilik-rekening'] ?? 'N/A' }}
                        </p>
                    </div>
                </div>
            </div>
        </div>
    </div>
</div>
<script src="https://cdn.jsdelivr.net/npm/chart.js"></script>
<script>
const revenueData = {
    pending: {{ $revenuePie['pending'] ?? 0 }},
    approved: {{ $revenuePie['approved'] ?? 0 }},
    rejected: {{ $revenuePie['rejected'] ?? 0 }}
};

new Chart(document.getElementById('revenueChart'), {
    type: 'pie',
    data: {
        labels: ['Pending','Approved','Rejected'],
        datasets: [{
            data: [
                revenueData.pending,
                revenueData.approved,
                revenueData.rejected
            ],
            backgroundColor: [
                '#facc15',
                '#22c55e',
                '#ef4444'
            ]
        }]
    },
    options: {
        responsive:true,
        plugins:{
            legend:{
                position:'bottom'
            }
        }
    }
});
</script>