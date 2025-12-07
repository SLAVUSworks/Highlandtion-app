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
            <input type="text" id="search-input" class="border border-gray-300 rounded-lg px-4 py-2 h-10 w-full"
                placeholder="Cari berdasarkan nama atau asal sekolah..." />
            <select id="filter-status" class="border border-gray-300 rounded-lg px-4 py-2 h-10">
                <option value="">Semua Status</option>
                <option value="approved">Approved</option>
                <option value="pending">Pending</option>
                <option value="rejected">Rejected</option>
            </select>
            <select id="filter-menu" class="border border-gray-300 rounded-lg px-4 py-2 h-10">
                <option value="">Semua Menu</option>
                @foreach($menus as $menu)
                <option value="{{ $menu->id }}">{{ $menu->menuCategory->name }} - {{ $menu->mata_pelajaran }} -
                    {{ $menu->tingkat }}</option>
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
                        <td class="px-4 py-2">{{ $registrasi->menu->menuCategory->name }} -
                            {{ $registrasi->menu->short_code}}</td>
                        <td class="px-4 py-2">
                            <span class="{{ $registrasi->status == 'approved' ? 'text-green-600' : 
                           ($registrasi->status == 'pending' ? 'text-yellow-600' : 'text-red-600') }}">
                                {{ ucfirst($registrasi->status) }}
                            </span>
                        </td>
                        <td class="px-4 py-2 text-center">
                            @if($registrasi->status == 'pending')
                            <a href="{{ route('back.registrasis.edit', $registrasi->id) }}"
                                class="bg-blue-500 text-white px-3 py-1 rounded-lg hover:bg-blue-600 transition">
                                Verifikasi
                            </a>
                            @elseif($registrasi->status == 'rejected')
                            <a href="{{ route('back.registrasis.edit', $registrasi->id) }}"
                                class="bg-yellow-500 text-white px-3 py-1 rounded-lg hover:bg-yellow-600 transition">
                                Evaluasi
                            </a>
                            @else
                            <a href="{{ route('back.registrasis.card', $registrasi->id) }}"
                                class="bg-green-500 text-white px-3 py-1 rounded-lg hover:bg-green-600 transition">
                                Kartu
                            </a>
                            @endif
                        </td>
                    </tr>
                    @endforeach
                </tbody>
            </table>
            <div id="pagination-links" class="mt-4">
                {{ $registrasis->links() }}
            </div>
        </div>
    </div>
</div>

<script src="https://code.jquery.com/jquery-3.6.4.min.js"></script>
<script>
    $(document).ready(function () {
        const searchInput = $("#search-input");
        const statusFilter = $("#filter-status");
        const menuFilter = $("#filter-menu");
        const tableBody = $("tbody");
        const paginationLinks = $("#pagination-links");
        const totalPendaftar = $("#total-pendaftar");
        const totalTerdaftar = $("#total-terdaftar");
        const totalPending = $("#total-pending");
        const totalReject = $("#total-reject");

        fetchRegistrasiData();

        searchInput.on("keyup", function () {
            fetchRegistrasiData();
        });

        statusFilter.on("change", function () {
            fetchRegistrasiData();
        });

        menuFilter.on("change", function () {
            fetchRegistrasiData();
        });

        $(document).on("click", "#pagination-links a", function (e) {
            e.preventDefault();
            const page = $(this).data("page");
            if (page) {
                fetchRegistrasiData(page);
            }
        });

        function generatePagination(pagination) {
            let totalPages = pagination.last_page;
            let currentPage = pagination.current_page;
            let totalResults = pagination.total;
            let perPage = pagination.per_page;
            let startResult = (currentPage - 1) * perPage + 1;
            let endResult = Math.min(currentPage * perPage, totalResults);

            let paginationHTML = `
        <div class="flex items-center justify-between border-t border-gray-200 bg-white px-4 py-3 sm:px-6">
            <div>
                <p class="text-sm text-gray-700">
                    Menampilkan <span class="font-medium">${startResult}</span> sampai 
                    <span class="font-medium">${endResult}</span> dari 
                    <span class="font-medium">${totalResults}</span> hasil
                </p>
            </div>
            <nav class="isolate inline-flex -space-x-px rounded-sm shadow-lg" aria-label="Pagination">
    `;

            if (pagination.prev_page_url) {
                paginationHTML += `
            <a href="#" data-page="${currentPage - 1}" class="relative inline-flex items-center px-2 py-2 text-gray-400 hover:bg-gray-50">
                <span class="sr-only">Previous</span>
                <svg class="size-5" viewBox="0 0 20 20" fill="currentColor"><path d="M11.78 5.22a.75.75 0 0 1 0 1.06L8.06 10l3.72 3.72a.75.75 0 1 1-1.06 1.06l-4.25-4.25a.75.75 0 0 1 0-1.06l4.25-4.25a.75.75 0 0 1 1.06 0Z" /></svg>
            </a>
        `;
            }

            let maxPagesToShow = 10;
            let startPage = Math.max(1, currentPage - Math.floor(maxPagesToShow / 2));
            let endPage = Math.min(totalPages, startPage + maxPagesToShow - 1);

            if (endPage - startPage < maxPagesToShow - 1) {
                startPage = Math.max(1, endPage - maxPagesToShow + 1);
            }

            if (startPage > 1) {
                paginationHTML +=
                    `<a href="#" data-page="1" class="inline-flex px-4 py-2 text-sm font-semibold text-gray-900 hover:bg-gray-200">1</a>`;
                if (startPage > 2) {
                    paginationHTML += `<span class="px-4 py-2 text-sm font-semibold text-gray-700">...</span>`;
                }
            }

            for (let i = startPage; i <= endPage; i++) {
                paginationHTML += `
            <a href="#" data-page="${i}" class="inline-flex px-4 py-2 text-sm font-semibold ${i === currentPage ? 'bg-blue-600 text-white' : 'text-gray-900 hover:bg-gray-200'}">${i}</a>
        `;
            }

            if (endPage < totalPages) {
                if (endPage < totalPages - 1) {
                    paginationHTML += `<span class="px-4 py-2 text-sm font-semibold text-gray-700">...</span>`;
                }
                paginationHTML += `
            <a href="#" data-page="${totalPages}" class="inline-flex px-4 py-2 text-sm font-semibold text-gray-900 hover:bg-gray-50">${totalPages}</a>
        `;
            }

            if (pagination.next_page_url) {
                paginationHTML += `
            <a href="#" data-page="${currentPage + 1}" class="relative inline-flex items-center px-2 py-2 text-gray-400 hover:bg-gray-50">
                <span class="sr-only">Next</span>
                <svg class="size-5" viewBox="0 0 20 20" fill="currentColor"><path d="M8.22 5.22a.75.75 0 0 1 1.06 0l4.25 4.25a.75.75 0 0 1 0 1.06l-4.25 4.25a.75.75 0 0 1-1.06-1.06L11.94 10 8.22 6.28a.75.75 0 0 1 0-1.06Z" /></svg>
            </a>
        `;
            }

            paginationHTML += `</nav></div>`;

            return paginationHTML;
        }

        let currentPage = 1;
        let lastResponse = "";

        function fetchRegistrasiData(page = 1) {
            const query = searchInput.val();
            const status = statusFilter.val();
            const menu = menuFilter.val();

            $.ajax({
                url: `{{ url('back/registrasi-data') }}?page=${page}`,
                method: "GET",
                data: {
                    search: query,
                    status: status,
                    menu: menu
                },
                success: function (response) {
                    let tableRows = "";
                    response.data.forEach((registrasi, index) => {
                        tableRows += `
            <tr class="border-t hover:bg-gray-100 transition">
                <td class="px-4 py-2">${(response.pagination.current_page - 1) * response.pagination.per_page + index + 1}</td>
                <td class="px-4 py-2">${registrasi.nama}</td>
                <td class="px-4 py-2">${registrasi.asal_sekolah}</td>
                <td class="px-4 py-2">${registrasi.menu?.menu_category?.name ?? 'Tanpa Kategori'} - ${registrasi.menu?.short_code}</td>
                <td class="px-4 py-2">
                    <span class="${
                        registrasi.status === 'approved' ? 'text-green-600' : 
                        registrasi.status === 'pending' ? 'text-yellow-600' : 
                        'text-red-600'
                    }">
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
                    });

                    tableBody.html(tableRows);

                    totalPendaftar.text(response.counts.pendaftar);
                    totalTerdaftar.text(response.counts.approved);
                    totalPending.text(response.counts.pending);
                    totalReject.text(response.counts.rejected);

                    paginationLinks.html(generatePagination(response.pagination));

                    currentPage = response.pagination.current_page;
                },


                error: function (xhr, status, error) {
                    console.error("Error fetching data:", error);
                },
            });
        }
        $(document).on("click", ".pagination a", function (e) {
            e.preventDefault();
            let page = $(this).data("page");
            if (page) {
                console.log("Pagination clicked, new page:", page);
                currentPage = page;
                fetchRegistrasiData(page);
            }
        });

        fetchRegistrasiData(currentPage);

        setInterval(() => {
            console.log("Auto fetching, current page:", currentPage);
            fetchRegistrasiData(currentPage);
        }, 5000);
    });

</script>

@endsection
