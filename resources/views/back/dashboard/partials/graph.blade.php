<div class="mt-4 rounded-lg bg-white p-5 shadow-sm border border-gray-100">
    <div class="mb-4 flex items-center justify-between">
        <div>
            <h2 class="text-xl font-bold">
                Statistik Status Pendaftaran
            </h2>
            <p class="text-xs text-gray-500">
                Update pendaftar berdasarkan status
            </p>
        </div>

        <span class="rounded-full bg-gray-100 px-3 py-1 text-xs font-medium text-gray-600">
            Harian
        </span>
    </div>

    <div class="relative h-72">
        <canvas id="chart"></canvas>
    </div>
</div>
<script src="https://cdn.jsdelivr.net/npm/chart.js"></script>
<script>
    const rawLabels = @json($labels);

    const labels = rawLabels.map(dateStr => {
        const date = new Date(dateStr);
        return date.toLocaleDateString('id-ID', {
            day: '2-digit',
            month: 'short'
        });
    });
    const pending  = @json($pending);
    const approved = @json($approved);
    const rejected = @json($rejected);

    const ctx = document.getElementById('chart').getContext('2d');

    const gradientPending = ctx.createLinearGradient(0, 0, 0, 300);
    gradientPending.addColorStop(0, 'rgba(234,179,8,0.35)');
    gradientPending.addColorStop(1, 'rgba(234,179,8,0.05)');

    const gradientApproved = ctx.createLinearGradient(0, 0, 0, 300);
    gradientApproved.addColorStop(0, 'rgba(16,185,129,0.35)');
    gradientApproved.addColorStop(1, 'rgba(16,185,129,0.05)');

    const gradientRejected = ctx.createLinearGradient(0, 0, 0, 300);
    gradientRejected.addColorStop(0, 'rgba(239,68,68,0.35)');
    gradientRejected.addColorStop(1, 'rgba(239,68,68,0.05)');

new Chart(ctx, {
    type: 'line',
    data: {
        labels,
        datasets: [
            {
                label: ' Pending',
                data: pending,
                tension: 0.45,
                fill: true,
                backgroundColor: gradientPending,
                borderColor: '#eab308',
                borderWidth: 3,
                pointRadius: 0,
                pointHoverRadius: 6,
                pointHoverBackgroundColor: '#eab308'
            },
            {
                label: ' Approved',
                data: approved,
                tension: 0.45,
                fill: true,
                backgroundColor: gradientApproved,
                borderColor: '#10b981',
                borderWidth: 3,
                pointRadius: 0,
                pointHoverRadius: 6,
                pointHoverBackgroundColor: '#10b981'
            },
            {
                label: ' Rejected',
                data: rejected,
                tension: 0.45,
                fill: true,
                backgroundColor: gradientRejected,
                borderColor: '#ef4444',
                borderWidth: 3,
                pointRadius: 0,
                pointHoverRadius: 6,
                pointHoverBackgroundColor: '#ef4444'
            }
        ]
    },
    options: {
        responsive: true,
        maintainAspectRatio: false,

        interaction: {
            mode: 'index',
            intersect: false
        },

        plugins: {
            legend: {
                position: 'bottom',
                labels: {
                    usePointStyle: true,
                    boxWidth: 8
                }
            },
            tooltip: {
                backgroundColor: '#111827',
                titleColor: '#fff',
                bodyColor: '#d1d5db',
                cornerRadius: 10,
                padding: 12,
                callbacks: {
                    title: (items) => `Tanggal: ${items[0].label}`,
                    label: (item) => ` ${item.dataset.label}: ${item.formattedValue} pendaftar`
                }
            }
        },

        scales: {
            x: {
                grid: { display: false }
            },
            y: {
                beginAtZero: true,
                grid: { color: 'rgba(0,0,0,0.05)' }
            }
        }
    }
});
</script>