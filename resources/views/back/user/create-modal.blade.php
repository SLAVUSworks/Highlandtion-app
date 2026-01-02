<!-- Modal -->
<div class="fixed inset-0 z-50 flex items-center justify-center overflow-auto bg-black bg-opacity-50 hidden" id="modalCreate">
    <div class="bg-white rounded-lg shadow-lg w-1/2">
        <div class="bg-green-500 text-white p-4 rounded-t-lg flex justify-between items-center">
            <h1 class="text-lg font-semibold">Tambah Pengguna</h1>
            <button type="button" class="text-white text-xl font-bold close-modal" data-bs-target="#modalCreate">&times;</button>
        </div>        
        <div class="p-4">
            <form action="{{ url('back/users') }}" method="post">
                @csrf

                <div class="mb-4">
                    <label for="nickname" class="block mb-2">Nama Pengguna</label>
                    <input type="text" name="nickname" id="nickname" class="w-full p-2 border rounded-lg @error('nickname') border-red-500 @enderror" value="{{ old('nickname') }}">
                    @error('nickname')
                    <div class="text-red-500 mt-2 text-sm">
                        {{ $message }}
                    </div>
                    @enderror
                </div>
                <div class="mb-4">
                    <label for="full_name" class="block mb-2">Nama Lengkap</label>
                    <input type="text" name="full_name" id="full_name" class="w-full p-2 border rounded-lg @error('full_name') border-red-500 @enderror" value="{{ old('full_name') }}">
                    @error('full_name')
                    <div class="text-red-500 mt-2 text-sm">
                        {{ $message }}
                    </div>
                    @enderror
                </div>
                <div class="mb-4">
                    <label for="email" class="block mb-2">Email</label>
                    <input type="email" name="email" id="email" class="w-full p-2 border rounded-lg @error('email') border-red-500 @enderror" value="{{ old('email') }}">
                    @error('email')
                    <div class="text-red-500 mt-2 text-sm">
                        {{ $message }}
                    </div>
                    @enderror
                </div>
                <div class="mb-4">
                    <label for="role" class="block mb-2">Role</label>
                    <select name="role" id="role" class="w-full p-2 border rounded-lg @error('role') border-red-500 @enderror" value="{{ old('role') }}">
                        <option value="" hidden>Select</option>
                        <option value="1" class="btn">Admin</option>
                        <option value="2" class="btn">Moderator</option>
                        <option value="3" class="btn">Verifikator</option>
                    </select>
                    @error('role')
                    <div class="text-red-500 mt-2 text-sm">
                        {{ $message }}
                    </div>
                    @enderror
                </div>
                <div class="mb-4">
                    <label for="password" class="block mb-2">Password</label>
                    <input type="password" name="password" id="password" class="w-full p-2 border rounded-lg @error('password') border-red-500 @enderror" value="{{ old('password') }}">
                    @error('password')
                    <div class="text-red-500 mt-2 text-sm">
                        {{ $message }}
                    </div>
                    @enderror
                </div>
                <div class="mb-4">
                    <label for="confirm_password" class="block mb-2">Konfirmasi Password</label>
                    <input type="password" name="password_confirmation" id="confirm_password" class="w-full p-2 border rounded-lg @error('confirm_password') border-red-500 @enderror" value="{{ old('confirm_password') }}">
                    @error('confirm_password')
                    <div class="text-red-500 mt-2 text-sm">
                        {{ $message }}
                    </div>
                    @enderror
                </div>

                <div class="flex justify-end mt-4">
                    <button type="button" class="bg-gray-500 text-white px-4 py-2 rounded-lg mr-2 close-modal" data-bs-target="#modalCreate">Batal</button>
                    <button type="submit" class="bg-green-500 text-white px-4 py-2 rounded">Ya, Tambah!</button>
                </div>
            </form>
        </div>
    </div>
</div>