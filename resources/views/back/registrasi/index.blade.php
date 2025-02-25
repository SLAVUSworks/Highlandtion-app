@extends('back.layouts.app')

@section('title', 'Registrasi')

@section('content')
<div class="container mx-auto px-4 py-6">
    <h1 class="text-2xl font-bold mb-4">Daftar Registrasi</h1>

    <!-- Cards for Counts -->
    <div class="grid grid-cols-1 sm:grid-cols-3 gap-4 mb-6">
        <div class="bg-blue-100 border border-blue-300 rounded-lg p-4">
            <h2 class="text-lg font-semibold text-blue-800">Pendaftar</h2>
            <p id="total-pendaftar" class="text-2xl font-bold text-blue-900">0</p>
        </div>
        <div class="bg-green-100 border border-green-300 rounded-lg p-4">
            <h2 class="text-lg font-semibold text-green-800">Terdaftar</h2>
            <p id="total-terdaftar" class="text-2xl font-bold text-green-900">0</p>
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
            placeholder="Cari berdasarkan nama, asal sekolah, atau email..."
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
                {{-- @dd($registrasis) --}}
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
        const totalPendaftar = $("#total-pendaftar");
        const totalTerdaftar = $("#total-terdaftar");
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

                        pendaftarCount++;
                        if (registrasi.status === "approved") terdaftarCount++;
                        if (registrasi.status === "pending") pendingCount++;
                    });

                    tableBody.html(tableRows);
                    totalPendaftar.text(pendaftarCount);
                    totalTerdaftar.text(terdaftarCount);
                    totalPending.text(pendingCount);
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
