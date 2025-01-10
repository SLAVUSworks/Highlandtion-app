@foreach ($users as $item)
    <!-- Modal -->
<div class="fixed inset-0 z-50 flex items-center justify-center overflow-auto bg-black bg-opacity-50 hidden" id="modalUpdate{{ $item->id }}">
    <div class="bg-white rounded-lg shadow-lg w-1/2">
        <div class="bg-green-500 text-white p-4 rounded-t-lg">
            <h1 class="text-lg font-semibold">Edit Pengguna</h1>
            <button type="button" class="text-white close-modal" data-bs-target="#modalUpdate{{ $item->id }}">&times;</button>
        </div>
        <div class="p-4">
            <form action="{{ url('back/users/'.$item->id) }}" method="post" enctype="multipart/form-data">
                @method('PUT')
                @csrf

                <div class="mb-4">
                    <label for="nickname" class="block mb-2">Nama Pengguna</label>
                    <input type="text" name="nickname" id="nickname" class="w-full p-2 border rounded @error('nickname') border-red-500 @enderror" value="{{ old('nickname', $item->nickname) }}">
                    @error('nickname')
                    <div class="text-red-500 mt-2 text-sm">
                        {{ $message }}
                    </div>
                    @enderror
                </div>
                <div class="mb-4">
                    <label for="full_name" class="block mb-2">Nama Lengkap</label>
                    <input type="text" name="full_name" id="full_name" class="w-full p-2 border rounded @error('full_name') border-red-500 @enderror" value="{{ old('full_name', $item->full_name) }}">
                    @error('full_name')
                    <div class="text-red-500 mt-2 text-sm">
                        {{ $message }}
                    </div>
                    @enderror
                </div>
                <div class="mb-4">
                    <label for="avatar" class="block mb-2">Foto Profil</label>
                    <input type="file" name="avatar" id="avatar" class="w-full p-2 border rounded @error('avatar') border-red-500 @enderror" value="{{ old('avatar', $item->avatar) }}">
                    @error('avatar')
                    <div class="text-red-500 mt-2 text-sm">
                        {{ $message }}
                    </div>
                    @enderror
                </div>
                <div class="mb-4">
                    <label for="email" class="block mb-2">Email</label>
                    <input type="email" name="email" id="email" class="w-full p-2 border rounded @error('email') border-red-500 @enderror" value="{{ old('email', $item->email) }}">
                    @error('email')
                    <div class="text-red-500 mt-2 text-sm">
                        {{ $message }}
                    </div>
                    @enderror
                </div>
                <div class="mb-4">
                    <label for="password" class="block mb-2">Password</label>
                    <input type="password" name="password" id="password" class="w-full p-2 border rounded @error('password') border-red-500 @enderror" value="{{ old('password') }}">
                    @error('password')
                    <div class="text-red-500 mt-2 text-sm">
                        {{ $message }}
                    </div>
                    @enderror
                </div>
                <div class="mb-4">
                    <label for="confirm_password" class="block mb-2">Konfirmasi Password</label>
                    <input type="password" name="password_confirmation" id="confirm_password" class="w-full p-2 border rounded @error('confirm_password') border-red-500 @enderror" value="{{ old('confirm_password') }}">
                    @error('confirm_password')
                    <div class="text-red-500 mt-2 text-sm">
                        {{ $message }}
                    </div>
                    @enderror
                </div>

                <div class="flex justify-end space-x-2">
                    <button type="button" class="bg-gray-500 text-white px-4 py-2 rounded close-modal" data-bs-target="#modalUpdate{{ $item->id }}">Gak dlu</button>
                    <button type="submit" class="bg-green-500 text-white px-4 py-2 rounded">Iye</button>
                </div>
            </form>
        </div>
    </div>
</div>
@endforeach

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