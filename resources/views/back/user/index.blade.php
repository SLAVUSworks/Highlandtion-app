@extends('back.layouts.app')

@section('content')
<main class="container mx-auto mt-4">
    @if (auth()->user()->role == 1)
    <div class="flex justify-between items-center border-b pb-2 mb-4">
        <h1 class="text-2xl font-semibold">Register</h1>
    </div>
    <div class="mt-4">
        <button class="bg-green-500 text-white px-4 py-2 rounded mb-4" data-bs-toggle="modal" data-bs-target="#modalCreate">Create</button>
        
        @if ($errors->any())
        <div class="bg-red-500 text-white p-4 rounded mb-4">
            <ul>
                @foreach ($errors->all() as $error)
                <li>{{ $error }}</li>
                @endforeach
            </ul>
        </div>
        @endif

        @if (session('success'))
        <div class="bg-green-500 text-white p-4 rounded mb-4">
            {{ session('success') }}
        </div>
        @endif
        
        <table class="min-w-full bg-white shadow rounded-lg">
            <thead>
                <tr>
                    <th class="py-2 px-4 border-b">No</th>
                    <th class="py-2 px-4 border-b">Nama</th>
                    <th class="py-2 px-4 border-b">Email</th>
                    <th class="py-2 px-4 border-b">Role</th>
                    <th class="py-2 px-4 border-b">Dibuat Pada</th>
                    <th class="py-2 px-4 border-b">Fungsi</th>
                </tr>
            </thead>
            <tbody>
                @foreach ($users as $item)
                <tr>
                    <td class="py-2 px-4 border-b">{{ $loop->iteration }}</td>
                    <td class="py-2 px-4 border-b">{{ $item->nickname }}</td>
                    <td class="py-2 px-4 border-b">{{ $item->email }}</td>
                    <td class="py-2 px-4 border-b">
                        @if ($item->role == 1)
                            Admin
                        @elseif ($item->role == 2)
                            Head
                        @else
                            Assistant
                        @endif
                    </td>
                    <td class="py-2 px-4 border-b">{{ $item->created_at }}</td>
                    <td class="py-2 px-4 border-b">
                        <div class="flex justify-center space-x-2">
                            <button class="bg-gray-500 text-white px-4 py-2 rounded" data-bs-toggle="modal" data-bs-target="#modalUpdate{{ $item->id }}">Edit</button>
                            @if (auth()->user()->role == 1)
                                @if ($item->id != auth()->user()->id)
                                    <button class="bg-red-500 text-white px-4 py-2 rounded" data-bs-toggle="modal" data-bs-target="#modalDelete{{ $item->id }}">Delete</button>
                                @endif
                            @endif
                        </div>
                    </td>
                </tr>
                @endforeach
            </tbody>
        </table>
    </div>

    @else (auth()->user()->role != 1)
    <div class="flex justify-between items-center border-b pb-2 mb-4">
        <h1 class="text-2xl font-semibold">Akun</h1>
    </div>
    @foreach ($users as $item)

    <div class="flex flex-wrap mb-4">
        <div class="w-full lg:w-1/3 mb-4 lg:mb-0">
            <div class="bg-white shadow rounded-lg m-2 h-full p-4 text-center">
                <img src="{{ asset('storage/'. $item->avatar) }}" alt="avatar" class="rounded-full mx-auto mb-4 w-24 h-24 object-cover">
                <h5 class="text-lg font-semibold">{{ $item->nickname }}</h5>
                @if (auth()->user()->role == 1)
                    <p class="text-gray-500">Admin</p>
                @elseif (auth()->user()->role == 2)
                    <p class="text-gray-500">Head</p>
                @else (auth()->user()->role == 3)
                    <p class="text-gray-500">Assistant</p>
                @endif
                <div class="flex justify-center space-x-2 mt-4">
                    <button class="bg-gray-500 text-white px-4 py-2 rounded" data-bs-toggle="modal" data-bs-target="#modalUpdate{{ $item->id }}">Edit</button>
                </div>
            </div>
        </div>
        <div class="w-full lg:w-2/3">
            <div class="bg-white shadow rounded-lg m-2 h-full p-4">
                <div class="mb-4">
                    <div class="flex justify-between">
                        <p class="font-semibold">Nickname</p>
                        <p class="text-gray-500">{{ $item->nickname }}</p>
                    </div>
                </div>
                <div class="mb-4">
                    <div class="flex justify-between">
                        <p class="font-semibold">Nama Lengkap</p>
                        <p class="text-gray-500">{{ $item->full_name }}</p>
                    </div>
                </div>
                <div class="mb-4">
                    <div class="flex justify-between">
                        <p class="font-semibold">Email</p>
                        <p class="text-gray-500">{{ $item->email }}</p>
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
                        <p class="text-gray-500">{{ $item->created_at }}</p>
                    </div>
                </div>
            </div>
        </div>
    </div>

    @endforeach
    @endif
    @include('back.user.create-modal')
    @include('back.user.update-modal')
    @include('back.user.delete-modal')
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