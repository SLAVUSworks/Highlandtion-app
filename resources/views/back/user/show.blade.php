@extends('back.layouts.app')

@section('content')
<main class="container mx-auto mt-4">
    <div class="flex justify-between items-center border-b pb-2 mb-4">
        <h1 class="text-2xl font-semibold">Akun</h1>
    </div>
    <div class="flex flex-wrap">
        <div class="w-full lg:w-1/3 mb-4 lg:mb-0">
            <div class="bg-white shadow rounded-lg p-4 text-center">
                <img src="{{ asset('storage/'. auth()->user()->avatar) }}" alt="avatar" class="rounded-full mx-auto mb-4 w-24 h-24 object-cover">
                <h5 class="text-lg font-semibold">{{ auth()->user()->nickname }}</h5>
                @if (auth()->user()->role == 1)
                    <p class="text-gray-500">Admin</p>
                @elseif (auth()->user()->role == 2)
                    <p class="text-gray-500">Head</p>
                @else (auth()->user()->role == 3)
                    <p class="text-gray-500">Assistant</p>
                @endif
            </div>
        </div>
        <div class="w-full lg:w-2/3">
            <div class="bg-white shadow rounded-lg p-4">
                <div class="mb-4">
                    <div class="flex justify-between">
                        <p class="font-semibold">Nickname</p>
                        <p class="text-gray-500">{{ auth()->user()->nickname }}</p>
                    </div>
                </div>
                <div class="mb-4">
                    <div class="flex justify-between">
                        <p class="font-semibold">Nama Lengkap</p>
                        <p class="text-gray-500">{{ auth()->user()->full_name }}</p>
                    </div>
                </div>
                <div class="mb-4">
                    <div class="flex justify-between">
                        <p class="font-semibold">Email</p>
                        <p class="text-gray-500">{{ auth()->user()->email }}</p>
                    </div>
                </div>
                <div class="mb-4">
                    <div class="flex justify-between">
                        <p class="font-semibold">Role</p>
                        <p class="text-gray-500">
                            @if (auth()->user()->role == 1)
                                Admin
                            @elseif (auth()->user()->role == 2)
                                Head
                            @else (auth()->user()->role == 3)
                                Assistant
                            @endif
                        </p>
                    </div>
                </div>
                <div class="mb-4">
                    <div class="flex justify-between">
                        <p class="font-semibold">Terdaftar Pada</p>
                        <p class="text-gray-500">{{ auth()->user()->created_at }}</p>
                    </div>
                </div>
            </div>
        </div>
    </div>
</main>

<script>
    document.querySelectorAll('.close-modal').forEach(button => {
        button.addEventListener('click', function() {
            const modal = document.querySelector(this.getAttribute('data-bs-target'));
            modal.classList.add('hidden');
        });
    });

    document.querySelectorAll('[data-bs-toggle="modal"]').forEach(button => {
        button.addEventListener('click', function() {
            const modal = document.querySelector(this.getAttribute('data-bs-target'));
            modal.classList.remove('hidden');
        });
    });
</script>
@endsection