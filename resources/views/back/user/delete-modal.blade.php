@foreach ($users as $item)
<!-- Modal -->
<div class="fixed inset-0 z-50 flex items-center justify-center overflow-auto bg-black bg-opacity-50 hidden" id="modalDelete{{ $item->id }}">
    <div class="bg-white rounded-lg shadow-lg w-1/2">
        <div class="bg-red-500 text-white p-4 rounded-t-lg">
            <h1 class="text-lg font-semibold">Hapus Admin</h1>
            <button type="button" class="text-white close-modal" data-bs-target="#modalDelete{{ $item->id }}">&times;</button>
        </div>
        <div class="p-4">
            <form action="{{ url('users/'.$item->id) }}" method="post">
                @method('DELETE')
                @csrf

                <div class="mb-4">
                    <p>Yang Bener aja? <b>{{ $item->nickname }}</b> Dihapus, Rugi dong...</p>
                </div>
                <div class="flex justify-end space-x-2">
                    <button type="button" class="bg-gray-500 text-white px-4 py-2 rounded close-modal" data-bs-target="#modalDelete{{ $item->id }}">Gak dlu</button>
                    <button type="submit" class="bg-red-500 text-white px-4 py-2 rounded">Apus aja deng</button>
                </div>
            </form>
        </div>
    </div>
</div>
@endforeach