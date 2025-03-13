
@extends('back.layouts.app')

@section('title', 'Konfigurasi')

@section('content')
<main class="col-md-9 ms-sm-auto col-lg-10 px-md-4">
    <div class="flex justify-between flex-wrap items-center pt-3 pb-2 mb-3 border-b">
        <h1 class="text-2xl font-bold mb-4">Konfigurasi</h1>
    </div>
    <div class="mt-3">
        @if ($errors->any())
            <script>
                Swal.fire({
                    title: 'Terjadi Kesalahan!',
                    html: `{!! implode('<br>', $errors->all()) !!}`,
                    icon: 'error',
                });
            </script>
        @endif
    
        @if (session('success'))
            <script>
                Swal.fire({
                    title: 'Berhasil!',
                    text: "{{ session('success') }}",
                    icon: 'success',
                    timer: 3000,
                    showConfirmButton: false
                });
            </script>
        @endif
    </div>    

    <table class="w-full border-collapse">
        <thead>
            <tr class="bg-gray-200 text-gray-700">
                <th class="px-4 py-2 text-left">No</th>
                <th class="px-4 py-2 text-left">Name</th>
                <th class="px-4 py-2 text-left">Value</th>
                <th class="px-4 py-2 text-center">Aksi</th>
            </tr>
        </thead>
        <tbody>
            @foreach ($config as $item => $key)
            <tr class="border-t hover:bg-gray-100 transition">
                <td class="px-4 py-2">{{ $config->firstItem() + $item }}</td>
                <td class="px-4 py-2">{{ $key->name }}</td>
                <td class="px-4 py-2">{{ Str::limit($key->value, 50) }}</td> 
                <td class="px-4 py-2 text-center">
                    <button class="bg-gray-500 text-white px-3 py-1 rounded-lg hover:bg-gray-600 transition" onclick="openModal('modalUpdate{{ $key->id }}')">Edit</button>
                </td>
            </tr>
            @endforeach
        </tbody>
    </table>    

    <div class="mt-3">
        {{ $config->links() }}
    </div>

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
