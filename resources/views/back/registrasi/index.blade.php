@extends('back.layouts.app')

@section('title', 'Registrasi')

@section('content')
<div class="container mx-auto px-4 py-6">
    <h1 class="text-2xl font-bold mb-4">Daftar Registrasi</h1>

    <div class="grid grid-cols-1 sm:grid-cols-4 gap-4 mb-6">
        <div class="bg-blue-100 border border-blue-300 rounded-lg p-4">
            <h2 class="text-lg font-semibold text-blue-800">Pendaftar</h2>
            <p id="total-pendaftar" class="text-2xl font-bold text-blue-900">0</p>
        </div>
        <div class="bg-green-100 border border-green-300 rounded-lg p-4">
            <h2 class="text-lg font-semibold text-green-800">Approved</h2>
            <p id="total-terdaftar" class="text-2xl font-bold text-green-900">0</p>
        </div>
        <div class="bg-red-100 border border-red-300 rounded-lg p-4">
            <h2 class="text-lg font-semibold text-red-800">Rejected</h2>
            <p id="total-reject" class="text-2xl font-bold text-red-900">0</p>
        </div>
        <div class="bg-yellow-100 border border-yellow-300 rounded-lg p-4">
            <h2 class="text-lg font-semibold text-yellow-800">Pending</h2>
            <p id="total-pending" class="text-2xl font-bold text-yellow-900">0</p>
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
            <option value="approved">Approved</option>
            <option value="pending">Pending</option>
            <option value="rejected">Rejected</option>
            </select>
            <select id="filter-menu" class="border border-gray-300 rounded-lg px-4 py-2 h-10">
            <option value="">Semua Menu</option>
            @foreach($menus as $menu)
                <option value="{{ $menu->id }}">{{ $menu->mata_pelajaran }} Tingkat {{ $menu->tingkat }}</option>
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
                    <th class="px-4 py-2 text-left">Status</th>
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
                        <span class="{{ $registrasi->status == 'approved' ? 'text-green-600' : 'text-red-600' }}">
                            {{ ucfirst($registrasi->status) }}
                        </span>
                    </td>
                    <td class="px-4 py-2 text-center">
                        @if($registrasi->status == 'pending')
                            <a href="{{ route('back.registrasis.edit', $registrasi->id) }}" class="bg-blue-500 text-white px-3 py-1 rounded-lg hover:bg-blue-600 transition">
                                Verifikasi
                            </a>
                        @elseif($registrasi->status == 'rejected')
                            <a href="{{ route('back.registrasis.edit', $registrasi->id) }}" class="bg-yellow-500 text-white px-3 py-1 rounded-lg hover:bg-yellow-600 transition">
                                Evaluasi
                            </a>
                        @else
                            <a href="{{ route('back.registrasis.card', $registrasi->id) }}" class="bg-green-500 text-white px-3 py-1 rounded-lg hover:bg-green-600 transition">
                                Kartu
                            </a>
                        @endif
                    </td>
                </tr>
                @endforeach
            </tbody>
        </table>
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
        const totalPendaftar = $("#total-pendaftar");
        const totalTerdaftar = $("#total-terdaftar");
        const totalReject = $("#total-reject");
        const totalPending = $("#total-pending");

        function fetchRegistrasiData() {
            const query = searchInput.val();
            const status = statusFilter.val();
            const menu = menuFilter.val();

            $.ajax({
                url: "{{ url('back/registrasi-data') }}",
                method: "GET",
                data: { search: query, status: status, menu: menu },
                success: function (data) {
                    let tableRows = "";
                    let pendaftarCount = 0;
                    let terdaftarCount = 0;
                    let pendingCount = 0;
                    let rejectCount = 0;

                    data.forEach((registrasi) => {
                        tableRows += `
                            <tr class="border-t hover:bg-gray-100 transition">
                                <td class="px-4 py-2">${pendaftarCount + 1}</td>
                                <td class="px-4 py-2">${registrasi.nama}</td>
                                <td class="px-4 py-2">${registrasi.asal_sekolah}</td>
                                <td class="px-4 py-2">${registrasi.menu.menu_category?.name ?? 'Tanpa Kategori'} - ${registrasi.menu.short_code}</td>
                                <td class="px-4 py-2">
                                    <span class="${registrasi.status === "approved" ? "text-green-600" : "text-red-600"}">
                                        ${registrasi.status.charAt(0).toUpperCase() + registrasi.status.slice(1)}
                                    </span>
                                </td>
                                <td class="px-4 py-2 text-center">
                                        ${
                                            registrasi.status === "pending" 
                                                ? `<a href="/back/registrasis/${registrasi.id}/edit" class="bg-blue-500 text-white px-3 py-1 rounded-lg hover:bg-blue-600 transition">Verifikasi</a>`
                                                : registrasi.status === "rejected"
                                                    ? `<a href="/back/registrasis/${registrasi.id}/edit" class="bg-yellow-500 text-white px-3 py-1 rounded-lg hover:bg-yellow-600 transition">Evaluasi</a>`
                                                    : `<a href="/back/registrasis/${registrasi.id}/card" class="bg-green-500 text-white px-3 py-1 rounded-lg hover:bg-green-600 transition">Kartu</a>`
                                        }
                                </td>
                            </tr>
                        `;

                        pendaftarCount++;
                        if (registrasi.status === "approved") terdaftarCount++;
                        if (registrasi.status === "rejected") rejectCount++;
                        if (registrasi.status === "pending") pendingCount++;
                    });

                    tableBody.html(tableRows);
                    totalPendaftar.text(pendaftarCount);
                    totalTerdaftar.text(terdaftarCount);
                    totalPending.text(pendingCount);
                    totalReject.text(rejectCount);
                },
                error: function (xhr, status, error) {
                    console.error("Error fetching data:", error);
                },
            });
        }

        searchInput.on("input", fetchRegistrasiData);
        statusFilter.on("change", fetchRegistrasiData);
        menuFilter.on("change", fetchRegistrasiData);

        fetchRegistrasiData();

        setInterval(() => {
            fetchRegistrasiData();
        }, 5000);
    });
</script>

@endsection
