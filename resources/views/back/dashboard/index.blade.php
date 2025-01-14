@extends('back.layouts.app')

@section('content')
<div class="container mx-auto px-4">
    <h1 class="text-2xl font-bold mb-4">Dashboard Kuota</h1>
    
    <div id="dashboardData" class="space-y-6">
        <div class="grid grid-cols-2 gap-4">
            <div class="p-4 bg-white shadow rounded">
            <h2 class="text-xl font-semibold">Total Kuota</h2>
            <p>Kuota Ruangan: <span id="ruanganKuota">{{ $ruanganKuota }}</span></p>
            <p>Kuota Perlombaan: <span id="menuKuota">{{ $menuKuota }}</span></p>
            </div>
            <div class="p-4 bg-white shadow rounded">
            <h2 class="text-xl font-semibold">Sisa Kuota</h2>
            <p>Kuota Ruangan: <span id="sisaRuanganKuota">{{ $sisaKuotaRuangan }}</span></p>
            <p>Kuota Perlombaan: <span id="sisaMenuKuota">{{ $sisaKuotaMenu }}</span></p>
            </div>
        </div>

        <div class="p-4 bg-white shadow rounded">
            <h2 class="text-xl font-semibold">Kuota Ruangan</h2>
            <table class="min-w-full border-collapse border border-gray-300">
                <thead>
                    <tr>
                        <th class="border px-4 py-2">No</th>
                        <th class="border px-4 py-2">Name</th>
                        <th class="border px-4 py-2">Kuota Total</th>
                        <th class="border px-4 py-2">Kuota Terpakai</th>
                    </tr>
                </thead>
                <tbody id="ruanganTable">
                    @foreach($kuotaPerRuangan as $item)
                        <tr>
                            <td class="border px-4 py-2">{{ $item->id }}</td>
                            <td class="border px-4 py-2">{{ $item->name }}</td>
                            <td class="border px-4 py-2">{{ $item->kuota }}</td>
                            <td class="border px-4 py-2">{{ $item->kuota_now }}</td>
                        </tr>
                    @endforeach
                </tbody>
            </table>
        </div>

        <div class="p-4 bg-white shadow rounded">
            <h2 class="text-xl font-semibold">Kuota Perlombaan</h2>
            <table class="min-w-full border-collapse border border-gray-300">
                <thead>
                    <tr>
                        <th class="border px-4 py-2">No</th>
                        <th class="border px-4 py-2">Name</th>
                        <th class="border px-4 py-2">Kuota Total</th>
                        <th class="border px-4 py-2">Kuota Sisa</th>
                    </tr>
                </thead>
                <tbody id="menuTable">
                    @foreach($kuotaPerMenu as $item)
                        <tr>
                            <td class="border px-4 py-2">{{ $item->id }}</td>
                            <td class="border px-4 py-2">{{ $item->name }} - {{ $item->tingkat }}</td>
                            <td class="border px-4 py-2">{{ $item->kuota }}</td>
                            <td class="border px-4 py-2">{{ $item->kuota_now }}</td>
                        </tr>
                    @endforeach
                </tbody>
            </table>
        </div>
    </div>
</div>
@endsection
