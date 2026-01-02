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