@foreach ($config as $item)
<!-- Modal -->
<div class="fixed inset-0 z-50 overflow-y-auto hidden" id="modalUpdate{{ $item->id }}" aria-labelledby="staticBackdropLabel" aria-hidden="true">
    <div class="flex items-center justify-center min-h-screen px-4">
        <div class="bg-white rounded-lg shadow-lg w-full max-w-lg">
            <div class="bg-green-600 text-white px-4 py-2 rounded-t-lg flex justify-between items-center">
                <h1 class="text-lg font-semibold" id="staticBackdropLabel">Ubah Konfigurasi</h1>
                <button type="button" class="text-white" onclick="closeModal('modalUpdate{{ $item->id }}')" aria-label="Close">
                    <span class="text-2xl">&times;</span>
                </button>
            </div>
            <div class="p-4">
                <form action="{{ url('back/config/'.$item->id) }}" method="post">
                    @method('PUT')
                    @csrf
                    <div class="mb-4">
                        <label for="name" class="block mb-2">Name</label>
                        <input name="name" id="name" class="form-control @error('name') border-red-500 @enderror w-full p-2 border rounded" value="{{ old('name', $item->name) }}" readonly>
                        @error('name')
                        <div class="text-red-500 text-sm mt-1">
                            {{ $message }}
                        </div>
                        @enderror
                    </div>
                    <div class="mb-4">
                        <label for="value" class="block mb-2">Value</label>
                        <textarea name="value" id="value" class="form-control @error('value') border-red-500 @enderror w-full p-2 border rounded" rows="10">{{ old('value', $item->value) }}</textarea>
                        @error('value')
                        <div class="text-red-500 text-sm mt-1">
                            {{ $message }}
                        </div>
                        @enderror
                    </div>
                    <div class="flex justify-end space-x-2">
                        <button type="button" class="btn btn-secondary bg-gray-500 text-white px-4 py-2 rounded" onclick="closeModal('modalUpdate{{ $item->id }}')">Gak dlu</button>
                        <button type="submit" class="btn btn-success bg-green-600 text-white px-4 py-2 rounded">Iye</button>
                    </div>
                </form>
            </div>
        </div>
    </div>
</div>
@endforeach

<script>
    function openModal(id) {
        document.getElementById(id).classList.remove('hidden');
    }

    function closeModal(id) {
        document.getElementById(id).classList.add('hidden');
    }
</script>