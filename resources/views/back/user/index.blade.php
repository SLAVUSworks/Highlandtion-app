@extends('back.layouts.app')

@section('content')
<main class="container mx-auto">
    @if (auth()->user()->role == 1)
    <div class="mb-6 rounded-lg bg-white/60 backdrop-blur px-6 py-4 shadow-sm border border-gray-200">
        <h1 class="flex items-center gap-3 text-3xl font-semibold text-gray-800">
            <span class="h-8 w-1.5 rounded-full bg-teal-500"></span>
            Akun Anda
        </h1>
        <p class="mt-1 text-sm text-gray-500">
            Atur profil dan kelola pengguna
        </p>
    </div>
    <div class="flex flex-wrap mb-4">
        <div class="w-full lg:w-1/3 mb-4 lg:mb-0">
            <div class="bg-white shadow rounded-lg mr-4 h-full p-4 text-center">
                <img src="{{ asset('storage/'. auth()->user()->avatar) }}" alt="avatar" class="rounded-full mx-auto mb-4 w-24 h-24 object-cover">
                <h5 class="text-lg font-semibold">{{ auth()->user()->nickname }}</h5>
                <p class="text-gray-500">Admin</p>
                <div class="flex justify-center space-x-2 mt-4">
                    <button class="bg-gray-500 text-white px-4 py-2 rounded" data-bs-toggle="modal" data-bs-target="#modalUpdate{{ auth()->user()->id }}">Edit</button>
                </div>
            </div>
        </div>
        <div class="w-full lg:w-2/3">
            <div class="bg-white shadow rounded-lg h-full p-4">
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
                        <p class="text-gray-500">Admin</p>
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
    <div class="mb-6 rounded-lg bg-white/60 backdrop-blur px-6 py-4 shadow-sm border border-gray-200 mt-6">
        <h1 class="flex items-center gap-3 text-3xl font-semibold text-gray-800">
            <span class="h-8 w-1.5 rounded-full bg-teal-500"></span>
            Kelola Pengguna
        </h1>
        <p class="mt-1 text-sm text-gray-500">
            Atur dan kelola akun pengguna/admin lainnya
        </p>
    </div>
    <div class="mt-4 rounded-lg bg-white p-5 shadow-sm border border-gray-100">
        <div>
            <button class="bg-green-500 text-white px-4 py-2 rounded-lg mb-4" data-bs-toggle="modal" data-bs-target="#modalCreate">Create</button>
            
            @if ($errors->any())
            <div class="bg-red-500 text-white p-4 rounded-lg mb-4">
                <ul>
                    @foreach ($errors->all() as $error)
                    <li>{{ $error }}</li>
                    @endforeach
                </ul>
            </div>
            @endif

            @if (session('success'))
            <div class="bg-green-500 text-white p-4 rounded-lg mb-4">
                {{ session('success') }}
            </div>
            @endif
            
            <table class="w-full border-collapse">
                <thead>
                    <tr class="bg-gray-200 text-gray-700">
                        <th class="px-4 py-2 text-left">No</th>
                        <th class="px-4 py-2 text-left">Nama</th>
                        <th class="px-4 py-2 text-left">Email</th>
                        <th class="px-4 py-2 text-left">Role</th>
                        <th class="px-4 py-2 text-left">Dibuat Pada</th>
                        <th class="px-4 py-2 text-center">Fungsi</th>
                    </tr>
                </thead>
                <tbody>
                    @foreach ($users as $item)
                    <tr class="border-t hover:bg-gray-100 transition">
                        <td class="px-4 py-2">{{ $loop->iteration }}</td>
                        <td class="px-4 py-2">{{ $item->nickname }}</td>
                        <td class="px-4 py-2">{{ $item->email }}</td>
                        <td class="px-4 py-2">
                            @if ($item->role == 1)
                                Admin
                            @elseif ($item->role == 2)
                                Moderator
                            @else
                                Verifikator
                            @endif
                        </td>
                        <td class="px-4 py-2">{{ $item->created_at }}</td>
                        <td class="px-4 py-2 text-center">
                            <div class="flex justify-center space-x-2">
                                <button class="bg-gray-500 text-white px-3 py-1 rounded-lg hover:bg-gray-600 transition" data-bs-toggle="modal" data-bs-target="#modalUpdate{{ $item->id }}">Edit</button>
                                @if (auth()->user()->role == 1)
                                    @if ($item->id != auth()->user()->id)
                                        <button class="bg-red-500 text-white px-3 py-1 rounded-lg hover:bg-red-600 transition" data-bs-toggle="modal" data-bs-target="#modalDelete{{ $item->id }}">Delete</button>
                                    @endif
                                @endif
                            </div>
                        </td>
                    </tr>
                    @endforeach
                </tbody>
            </table>
    </div>

    @else
    <div class="mb-6 rounded-lg bg-white/60 backdrop-blur px-6 py-4 shadow-sm border border-gray-200">
        <h1 class="flex items-center gap-3 text-3xl font-semibold text-gray-800">
            <span class="h-8 w-1.5 rounded-full bg-teal-500"></span>
            Akun Anda
        </h1>
        <p class="mt-1 text-sm text-gray-500">
            Atur profil anda disini
        </p>
    </div>
    @foreach ($users as $item)
        <div class="flex flex-wrap mb-4">
        <div class="w-full lg:w-1/3 mb-4 lg:mb-0">
            <div class="bg-white shadow rounded-lg mr-4 h-full p-4 text-center">
                <img src="{{ asset('storage/'. auth()->user()->avatar) }}" alt="avatar" class="rounded-full mx-auto mb-4 w-24 h-24 object-cover">
                <h5 class="text-lg font-semibold">{{ auth()->user()->nickname }}</h5>
                <p class="text-gray-500">
                    @if (auth()->user()->role == 1)
                        Admin
                    @elseif (auth()->user()->role == 2)
                        Moderator
                    @else
                        Verifikator
                    @endif
                </p>
                <div class="flex justify-center space-x-2 mt-4">
                    <button class="bg-gray-500 text-white px-4 py-2 rounded" data-bs-toggle="modal" data-bs-target="#modalUpdate{{ auth()->user()->id }}">Edit</button>
                </div>
            </div>
        </div>
        <div class="w-full lg:w-2/3">
            <div class="bg-white shadow rounded-lg h-full p-4">
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
                                Moderator
                            @else
                                Verifikator
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
