
@extends('back.layouts.app')

@section('title', 'Konfigurasi')

@section('content')
<main class="col-md-9 ms-sm-auto col-lg-10 px-md-4">
    <div class="flex justify-between flex-wrap items-center pt-3 pb-2 mb-3 border-b">
        <h1 class="text-2xl">Konfigurasi</h1>
    </div>
    <div class="mt-3">
        @if ($errors->any())
        <div class="alert alert-danger">
            <ul>
                @foreach ($errors->all() as $error)
                    <li>{{ $error }}</li>
                @endforeach
            </ul>
        </div>
        @endif

        @if (session('success'))
        <div class="my-2">
            <div class="alert alert-success">
                {{ session('success') }}
            </div>
        </div>
        @endif
    </div>

    <!-- Parent Categories Table -->
    <table class="table-auto w-full mb-4 border-collapse border border-gray-200">
        <thead>
            <tr class="bg-gray-100">
                <th class="border border-gray-200 px-4 py-2">No</th>
                <th class="border border-gray-200 px-4 py-2">Nama</th>
                <th class="border border-gray-200 px-4 py-2">Value</th>
                <th class="border border-gray-200 px-4 py-2">Fungsi</th>
            </tr>
        </thead>
        <tbody>
            {{-- Loop through parent categories --}}
            @foreach ($config as $item => $key)
                <tr>
                    <td class="border border-gray-200 px-4 py-2">{{ $config->firstItem() + $item }}</td>
                    <td class="border border-gray-200 px-4 py-2">{{ $key->name }}</td>
                    <td class="border border-gray-200 px-4 py-2">{{ $key->value }}</td>
                    <td class="border border-gray-200 px-4 py-2">
                        <div class="text-center">
                            <button class="btn btn-secondary" onclick="openModal('modalUpdate{{ $key->id }}')">Edit</button>
                        </div>
                    </td>
                </tr>
            @endforeach
        </tbody>
    </table>

    <div>
        {{ $config->links() }}
    </div>

    {{-- Modal Update --}}
    @include('back.config.update-modal')

</main>

<script>
    function openModal(modalId) {
        const modal = document.getElementById(modalId);
        if (modal) {
            modal.classList.remove('hidden');
            modal.setAttribute('aria-hidden', 'false');
        }
    }

    document.querySelectorAll('[data-bs-dismiss="modal"]').forEach(button => {
        button.addEventListener('click', function () {
            const modal = button.closest('.fixed.inset-0.z-50');
            if (modal) {
                modal.classList.add('hidden');
                modal.setAttribute('aria-hidden', 'true');
            }
        });
    });
</script>

@endsection
