@extends('back.layouts.app')

@section('title', 'Status Kartu Registrasi')

@section('content')

<div class="container mx-auto">
    <div class="mb-6 rounded-lg bg-white/60 backdrop-blur px-6 py-4 shadow-sm border border-gray-200">
        <h1 class="flex items-center gap-3 text-3xl font-semibold text-gray-800">
            <span class="h-8 w-1.5 rounded-full bg-teal-500"></span>
            Kartu Peserta
        </h1>
        <p class="mt-1 text-sm text-gray-500">
            Tabel peserta ter-registrasi dan status kartu peserta
        </p>
    </div>

    <div class="mt-4 rounded-lg bg-white p-5 shadow-sm border border-gray-100">

        <div class="grid grid-cols-1 sm:grid-cols-3 gap-4 mb-6">
            <div class="bg-blue-100 border border-blue-300 rounded-lg p-4">
                <h2 class="text-lg font-semibold text-blue-800">Terverifikasi</h2>
                <p id="total-terdaftar" class="text-2xl font-bold text-blue-900">0</p>
            </div>
            <div class="bg-green-100 border border-green-300 rounded-lg p-4">
                <h2 class="text-lg font-semibold text-green-800">Terkirim</h2>
                <p id="total-true" class="text-2xl font-bold text-green-900">0</p>
            </div>
            <div class="bg-red-100 border border-red-300 rounded-lg p-4">
                <h2 class="text-lg font-semibold text-red-800">Tertunda</h2>
                <p id="total-false" class="text-2xl font-bold text-red-900">0</p>
            </div>
        </div>

        <div class="overflow-x-auto">
            <div class="flex items-center gap-4 mb-4">
                <input
                type="text"
                id="search-input"
                class="border border-gray-300 rounded-lg px-4 py-2 h-10 w-full"
                placeholder="Cari berdasarkan nama atau asal sekolah..."
                />
                <select id="filter-status" class="border border-gray-300 rounded-lg px-4 py-2 h-10">
                <option value="">Semua Status</option>
                <option value=TRUE>Terkirim</option>
                <option value=FALSE>Tertunda</option>
                </select>
                <select id="filter-menu" class="border border-gray-300 rounded-lg px-4 py-2 h-10">
                <option value="">Semua Menu</option>
                @foreach($menus as $menu)
                    <option value="{{ $menu->id }}">{{ $menu->short_code }}</option>
                @endforeach
                </select>
            </div>

            <div class="overflow-x-auto bg-white shadow-md rounded-lg mt-6">
            <table class="w-full border-collapse rounded">
                <thead>
                    <tr class="bg-gray-200 text-gray-700">
                        <th class="px-4 py-2 text-left">No</th>
                        <th class="px-4 py-2 text-left">Nama</th>
                        <th class="px-4 py-2 text-left">Asal Sekolah</th>
                        <th class="px-4 py-2 text-left">Menu</th>
                        <th class="px-4 py-2 text-left">Status Pesan</th>
                        <th class="px-4 py-2 text-center">Aksi</th>
                    </tr>
                </thead>
                <tbody>
                    @foreach($registrasis as $registrasi)
                    <tr class="border-t hover:bg-gray-100 transition">
                        <td class="px-4 py-2">{{ $loop->iteration }}</td>
                        <td class="px-4 py-2">{{ $registrasi->nama }}</td>
                        <td class="px-4 py-2">{{ $registrasi->asal_sekolah }}</td>
                        <td class="px-4 py-2">{{ $registrasi->menu->menuCategory->name }} - {{ $registrasi->menu->short_code}}</td>
                        <td class="px-4 py-2">
                            <span class="{{ $registrasi->is_notified == TRUE ? 'text-green-600' : 'text-red-600' }}">
                                @if ($registrasi->is_notified == TRUE)
                                    Terkirim
                                @else
                                    Tertunda
                                @endif
                            </span>
                        </td>
                        <td class="px-4 py-2 text-center">
                            <a href="{{ route('back.registrasis.card', $registrasi->id) }}" class="bg-green-500 text-white px-3 py-1 rounded-lg hover:bg-green-600 transition">
                                Kartu
                            </a>
                        </td>
                    </tr>
                    @endforeach
                </tbody>
            </table>
            </div>
        </div>
    </div>
</div>
<script src="https://code.jquery.com/jquery-3.6.4.min.js"></script>
<script>
    $(document).ready(function () {
        const tableBody = $("tbody");
        const searchInput = $("#search-input");
        const statusFilter = $("#filter-status");
        const menuFilter = $("#filter-menu");
        const totalTerdaftar = $("#total-terdaftar");
        const totalTerkirim = $("#total-true");
        const totalTertunda = $("#total-false");

        function fetchApprovedData() {
            const query = searchInput.val();
            const menu = menuFilter.val();
            const status = statusFilter.val();

            $.ajax({
                url: "{{ url('back/registrasi-approved-data') }}",
                method: "GET",
                data: { search: query, menu: menu },
                success: function (data) {
                    let tableRows = "";
                    let terdaftarCount = 0;
                    let terkirimCount = 0;
                    let tertundaCount = 0;

                    data.forEach((registrasi, index) => {
                        const statusPesan = registrasi.is_notified ? "Terkirim" : "Tertunda";
                        const statusClass = registrasi.is_notified ? "text-green-600" : "text-red-600";

                        if (status && ((status === "TRUE" && !registrasi.is_notified) || (status === "FALSE" && registrasi.is_notified))) {
                            return;
                        }

                        tableRows += `
                            <tr class="border-t hover:bg-gray-100 transition">
                                <td class="px-4 py-2">${index + 1}</td>
                                <td class="px-4 py-2">${registrasi.nama}</td>
                                <td class="px-4 py-2">${registrasi.asal_sekolah}</td>
                                <td class="px-4 py-2">${registrasi.menu.menu_category?.name ?? 'Tanpa Kategori'} - ${registrasi.menu.short_code}</td>
                                <td class="px-4 py-2">
                                    <span class="${statusClass}">${statusPesan}</span>
                                </td>
                                <td class="px-4 py-2 text-center">
                                    <a href="/back/registrasis/${registrasi.id}/card" class="bg-green-500 text-white px-3 py-1 rounded-lg hover:bg-green-600 transition">
                                        Kartu
                                    </a>
                                </td>
                            </tr>
                        `;

                        terdaftarCount++;
                        registrasi.is_notified ? terkirimCount++ : tertundaCount++;
                    });

                    tableBody.html(tableRows);
                    totalTerdaftar.text(terdaftarCount);
                    totalTerkirim.text(terkirimCount);
                    totalTertunda.text(tertundaCount);
                },
                error: function (xhr, status, error) {
                    console.error("Error fetching data:", error);
                },
            });
        }

        searchInput.on("input", fetchApprovedData);
        menuFilter.on("change", fetchApprovedData);
        statusFilter.on("change", fetchApprovedData);

        fetchApprovedData();

        setInterval(() => {
            fetchApprovedData();
        }, 5000);
    });
</script>


@endsection