<div class="p-4 bg-white shadow rounded-lg">
    <div class="mb-4 flex items-center justify-between">
        <div>
            <h2 class="text-xl font-semibold">Kuota Event</h2>
            <p class="text-xs text-gray-500">
                Jumlah kuota per event dan status penerimaan
            </p>
        </div>
        <span class="rounded-full bg-gray-100 px-3 py-1 text-xs font-medium text-gray-600">
            Keseluruhan
        </span>
    </div>
    <div class="overflow-x-auto bg-white shadow-md rounded-lg mt-2">
    <table class="w-full border-collapse">
        <thead>
            <tr class="bg-gray-200 text-gray-700">
                <th class="px-4 py-2 text-left">No</th>
                <th class="px-4 py-2 text-left">Name</th>
                <th class="px-4 py-2 text-left">Tingkat</th>
                <th class="px-4 py-2 text-left">Status</th>
                <th class="px-4 py-2 text-left">Kuota</th>
            </tr>
        </thead>
        <tbody id="menuTable">
            @foreach($kuotaPerMenu as $item)
            <tr class="border-t hover:bg-gray-100 transition">
                <td class="px-4 py-2">{{ $loop->iteration }}</td>
                <td class="px-4 py-2">{{ $item->name }}</td>
                <td class="px-4 py-2">{{ $item->tingkat }}</td>
                <td class="px-4 py-2">
                    <span class="px-2 py-1 rounded-lg text-white text-sm
                        {{ $item->status === 'buka' ? 'bg-green-600' : 'bg-red-600' }}">
                        {{ $item->status === 'buka' ? 'Menerima' : 'Ditutup' }}
                    </span>
                </td>
                <td class="px-4 py-2">{{ $item->kuota_now }}/{{ $item->kuota }}</td>
            </tr>
            @endforeach
        </tbody>
    </table>
    </div>
</div>

<div class="p-4 bg-white shadow rounded-lg">
    <div class="mb-4 flex items-center justify-between">
        <div>
            <h2 class="text-xl font-semibold">Kuota Ruangan</h2>
            <p class="text-xs text-gray-500">
                Jumlah kuota dan sisa kuota per ruangan
            </p>
        </div>
        <span class="rounded-full bg-gray-100 px-3 py-1 text-xs font-medium text-gray-600">
            Keseluruhan
        </span>
    </div>
    <div class="overflow-x-auto bg-white shadow-md rounded-lg mt-2">
    <table class="w-full border-collapse">
        <thead>
            <tr class="bg-gray-200 text-gray-700">
                <th class="px-4 py-2 text-left">No</th>
                <th class="px-4 py-2 text-left">Name</th>
                <th class="px-4 py-2 text-left">Kuota</th>
            </tr>
        </thead>
        <tbody id="ruanganTable">
            @foreach($kuotaPerRuangan as $item)
            <tr class="border-t hover:bg-gray-100 transition">
                <td class="px-4 py-2">{{ $loop->iteration }}</td>
                <td class="px-4 py-2">{{ $item->name }}</td>
                <td class="px-4 py-2">{{ $item->kuota_now }}/{{ $item->kuota }}</td>
            </tr>
            @endforeach
        </tbody>
    </table>
    </div>
</div>