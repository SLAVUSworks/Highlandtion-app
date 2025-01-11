@extends('back.layouts.app')

@section('title', 'Registrasi')

@section('content')
<div class="container mx-auto px-4 py-6">
    <h1 class="text-2xl font-bold mb-4">Daftar Registrasi</h1>
    <div class="overflow-x-auto">
        <div class="flex items-center gap-4 mb-4">
            <!-- Search Input -->
            <input
            type="text"
            id="search-input"
            class="border border-gray-300 rounded-lg px-4 py-2 h-10 w-full"
            placeholder="Cari berdasarkan nama, asal sekolah, atau email..."
            />
            <!-- Filter Status -->
            <select id="filter-status" class="border border-gray-300 rounded-lg px-4 py-2 h-10">
            <option value="">Semua Status</option>
            <option value="approved">Approved</option>
            <option value="pending">Pending</option>
            <option value="rejected">Rejected</option>
            </select>
            <!-- Filter Menu -->
            <select id="filter-menu" class="border border-gray-300 rounded-lg px-4 py-2 h-10">
            <option value="">Semua Menu</option>
            @foreach($menus as $menu)
                <option value="{{ $menu->id }}">{{ $menu->mata_pelajaran }} Tingkat {{ $menu->tingkat }}</option>
            @endforeach
            </select>
        </div>
        <table class="table-auto w-full border-collapse border border-gray-300">
            <thead>
                <tr class="bg-gray-100">
                    <th class="border border-gray-300 px-4 py-2">Nama</th>
                    <th class="border border-gray-300 px-4 py-2">Asal Sekolah</th>
                    <th class="border border-gray-300 px-4 py-2">Email</th>
                    <th class="border border-gray-300 px-4 py-2">Menu</th>
                    <th class="border border-gray-300 px-4 py-2">Status</th>
                    <th class="border border-gray-300 px-4 py-2">Aksi</th>
                </tr>
            </thead>
            <tbody>
                @foreach($registrasis as $registrasi)
                <tr>
                    <td class="border border-gray-300 px-4 py-2">{{ $registrasi->nama }}</td>
                    <td class="border border-gray-300 px-4 py-2">{{ $registrasi->asal_sekolah }}</td>
                    <td class="border border-gray-300 px-4 py-2">{{ $registrasi->email }}</td>
                    <td class="border border-gray-300 px-4 py-2">{{ $registrasi->menu->mata_pelajaran }} Tingkat {{ $registrasi->menu->tingkat }}</td>
                    <td class="border border-gray-300 px-4 py-2">
                        <span class="{{ $registrasi->status == 'approved' ? 'text-green-600' : 'text-red-600' }}">
                            {{ ucfirst($registrasi->status) }}
                        </span>
                    </td>
                    <td class="border border-gray-300 px-4 py-2">
                        @if($registrasi->status == 'pending' || $registrasi->status == 'rejected')
                            <a href="{{ route('back.registrasis.edit', $registrasi->id) }}" class="text-blue-600 hover:underline">Verifikasi</a>
                        @else
                            <a href="{{ route('back.registrasis.card', $registrasi->id) }}" class="text-blue-600 hover:underline">Kartu Peserta</a>
                        @endif
                    </td>
                </tr>
                @endforeach
            </tbody>
        </table>
    </div>
</div>
<script src="https://code.jquery.com/jquery-3.6.4.min.js"></script>
<script>
    $(document).ready(function () {
        const tableBody = $("tbody");
        const searchInput = $("#search-input");
        const statusFilter = $("#filter-status");
        const menuFilter = $("#filter-menu");

        function fetchRegistrasiData() {
            const query = searchInput.val();
            const status = statusFilter.val();
            const menu = menuFilter.val();

            $.ajax({
                url: "/api/registrasi-data",
                method: "GET",
                data: { search: query, status: status, menu: menu },
                success: function (data) {
                    let tableRows = "";
                    data.forEach((registrasi) => {
                        tableRows += `
                            <tr>
                                <td class="border border-gray-300 px-4 py-2">${registrasi.nama}</td>
                                <td class="border border-gray-300 px-4 py-2">${registrasi.asal_sekolah}</td>
                                <td class="border border-gray-300 px-4 py-2">${registrasi.email}</td>
                                <td class="border border-gray-300 px-4 py-2">${registrasi.menu.mata_pelajaran} Tingkat ${registrasi.menu.tingkat}</td>
                                <td class="border border-gray-300 px-4 py-2">
                                    <span class="${registrasi.status === "approved" ? "text-green-600" : "text-red-600"}">
                                        ${registrasi.status.charAt(0).toUpperCase() + registrasi.status.slice(1)}
                                    </span>
                                </td>
                                <td class="border border-gray-300 px-4 py-2">
                                    ${
                                        registrasi.status === "pending" || registrasi.status === "rejected"
                                            ? `<a href="/back/registrasis/${registrasi.id}/edit" class="text-blue-600 hover:underline">Verifikasi</a>`
                                            : `<a href="/back/registrasis/${registrasi.id}/card" class="text-blue-600 hover:underline">Kartu Peserta</a>`
                                    }
                                </td>
                            </tr>
                        `;
                    });
                    tableBody.html(tableRows);
                },
                error: function (xhr, status, error) {
                    console.error("Error fetching data:", error);
                },
            });
        }

        // Event listeners for search and filters
        searchInput.on("input", fetchRegistrasiData);
        statusFilter.on("change", fetchRegistrasiData);
        menuFilter.on("change", fetchRegistrasiData);

        // Initial fetch
        fetchRegistrasiData();
    });
</script>


@endsection
