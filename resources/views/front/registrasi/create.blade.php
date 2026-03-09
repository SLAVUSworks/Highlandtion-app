@extends('front.layouts.app')

@section('content')

<div class="min-h-screen py-6 px-4 pb-16">
    <div class="max-w-lg mx-auto space-y-4">

        {{-- Header Card --}}
        <div class="rounded-3xl border border-primary/10 bg-white dark:bg-slate-900 shadow-xl overflow-hidden">
            <div class="relative h-32 w-full overflow-hidden">
                <img src="{{ asset('storage/' . $menu->thumbnail) }}"
                     alt="{{ $menu->mata_pelajaran }}"
                     class="w-full h-full object-cover">
                <div class="absolute inset-0 bg-gradient-to-t from-black/80 via-black/20 to-transparent"></div>
                <div class="absolute bottom-4 left-5 right-5 text-white">
                    <span class="text-xs font-medium opacity-60 uppercase tracking-widest">
                        {{ $menu->menuCategory->name ?? 'Kategori' }}
                    </span>
                    <h1 class="text-xl font-black leading-tight">{{ $menu->mata_pelajaran }} — {{ $menu->tingkat }}</h1>
                </div>
            </div>
            <div class="flex items-center gap-4 px-5 py-4">
                <img src="{{ asset('storage/' . $menu->icon) }}"
                     alt="{{ $menu->mata_pelajaran }}"
                     class="w-14 h-14 rounded-2xl object-cover border border-primary/10 shrink-0">
                <div>
                    <p class="text-xs text-slate-400 uppercase font-bold tracking-widest">Biaya Pendaftaran</p>
                    <p class="text-2xl font-black text-primary">Rp. {{ number_format($menu->harga, 0, ',', '.') }}</p>
                </div>
            </div>
        </div>

        {{-- Notice --}}
        <div class="rounded-2xl border border-red-500/20 bg-red-500/5 px-5 py-4 space-y-1.5">
            <p class="text-xs font-bold text-red-500 uppercase tracking-widest mb-2">Perhatian</p>
            <div class="flex items-start gap-2 text-sm text-slate-600 dark:text-slate-400">
                <span class="material-symbols-outlined text-red-500 text-base mt-0.5 shrink-0">person</span>
                <span>Satu form hanya untuk <strong>satu peserta</strong>.</span>
            </div>
            <div class="flex items-start gap-2 text-sm text-slate-600 dark:text-slate-400">
                <span class="material-symbols-outlined text-slate-400 text-base mt-0.5 shrink-0">group</span>
                <span>Jika satu bukti pembayaran untuk lebih dari satu peserta, ulangi pengisian sebanyak jumlah peserta.</span>
            </div>
            <div class="flex items-start gap-2 text-sm text-slate-600 dark:text-slate-400">
                <span class="material-symbols-outlined text-slate-400 text-base mt-0.5 shrink-0">receipt_long</span>
                <span>Pastikan bukti pembayaran yang dimasukkan sesuai.</span>
            </div>
        </div>

        {{-- Form --}}
        <form action="{{ route('registrasi.store') }}" method="POST" enctype="multipart/form-data" class="space-y-4">
            @csrf
            <input type="hidden" name="menu_id" value="{{ $menu->id }}">

            {{-- Data Diri --}}
            <div class="rounded-3xl border border-primary/10 bg-white dark:bg-slate-900 shadow-xl overflow-hidden divide-y divide-slate-100 dark:divide-slate-800">
                <div class="px-5 py-4">
                    <p class="text-xs font-bold text-slate-400 uppercase tracking-widest">Data Diri</p>
                </div>

                <div class="px-5 py-4 space-y-1">
                    <label for="nama" class="text-xs font-bold text-slate-400 uppercase tracking-widest">Nama Lengkap</label>
                    <input type="text" id="nama" name="nama" required
                           class="block w-full rounded-xl border border-primary/20 bg-slate-50 dark:bg-slate-800 px-4 py-3 text-sm font-semibold text-slate-900 dark:text-white placeholder-slate-400 focus:outline-none focus:ring-2 focus:ring-primary/30 focus:border-primary transition"
                           placeholder="Contoh: Slava Slavus">
                </div>

                <div class="px-5 py-4 space-y-1">
                    <label for="asal_sekolah" class="text-xs font-bold text-slate-400 uppercase tracking-widest">Asal Sekolah</label>
                    <input type="text" id="asal_sekolah" name="asal_sekolah" required
                           class="block w-full rounded-xl border border-primary/20 bg-slate-50 dark:bg-slate-800 px-4 py-3 text-sm font-semibold text-slate-900 dark:text-white placeholder-slate-400 focus:outline-none focus:ring-2 focus:ring-primary/30 focus:border-primary transition"
                           placeholder="Contoh: SMAN 1 Bukittinggi">
                </div>

                <div class="px-5 py-4 space-y-1">
                    <label for="email" class="text-xs font-bold text-slate-400 uppercase tracking-widest">Email</label>
                    <input type="email" id="email" name="email" required
                           class="block w-full rounded-xl border border-primary/20 bg-slate-50 dark:bg-slate-800 px-4 py-3 text-sm font-semibold text-slate-900 dark:text-white placeholder-slate-400 focus:outline-none focus:ring-2 focus:ring-primary/30 focus:border-primary transition"
                           placeholder="Contoh: slavas@email.com">
                </div>

                <div class="px-5 py-4 space-y-1">
                    <label for="nomor_hp" class="text-xs font-bold text-slate-400 uppercase tracking-widest">Nomor WhatsApp</label>
                    <div class="flex gap-2">
                        <span class="flex items-center px-4 rounded-xl border border-primary/20 bg-primary/5 text-sm font-bold text-slate-500 shrink-0">+62</span>
                        <input type="text" id="nomor_hp" name="nomor_hp" required
                               class="block w-full rounded-xl border border-primary/20 bg-slate-50 dark:bg-slate-800 px-4 py-3 text-sm font-semibold text-slate-900 dark:text-white placeholder-slate-400 focus:outline-none focus:ring-2 focus:ring-primary/30 focus:border-primary transition"
                               placeholder="81234567890"
                               inputmode="numeric"
                               oninput="this.value = this.value.replace(/[^0-9]/g, '')">
                    </div>
                </div>
            </div>

            {{-- Informasi Pembayaran --}}
            <div class="rounded-3xl border border-primary/10 bg-white dark:bg-slate-900 shadow-xl overflow-hidden divide-y divide-slate-100 dark:divide-slate-800">
                <div class="px-5 py-4">
                    <p class="text-xs font-bold text-slate-400 uppercase tracking-widest">Informasi Pembayaran</p>
                </div>

                {{-- Bank Info --}}
                <div class="px-5 py-4">
                    <p class="text-xs text-red-500 font-semibold mb-4">
                        Lakukan pembayaran sebesar
                        <span class="font-black text-primary">Rp. {{ number_format($menu->harga, 0, ',', '.') }}</span>
                        ke rekening berikut:
                    </p>
                    <div class="flex items-center gap-4 p-4 rounded-2xl bg-slate-50 dark:bg-slate-800 border border-primary/10">
                        <img src="{{ $config['logo-bank'] }}" alt="Bank" class="w-14 h-14 object-contain rounded-xl shrink-0">
                        <div>
                            <p class="text-base font-black text-slate-900 dark:text-white">{{ $config['nama-bank'] }}</p>
                            <p class="text-lg font-black text-primary tracking-widest copyable cursor-pointer"
                               onclick="copyText(this)"
                               title="Klik untuk menyalin">
                                {{ $config['nomor-rekening'] }}
                            </p>
                            <p class="text-xs text-slate-400 font-semibold">{{ $config['nama-pemilik-rekening'] }}</p>
                        </div>
                    </div>
                </div>

                {{-- Upload Bukti --}}
                <div class="px-5 py-4 space-y-3">
                    <p class="text-xs font-bold text-slate-400 uppercase tracking-widest">
                        Bukti Transfer <span class="normal-case text-slate-400 font-normal">— maks. 2MB</span>
                    </p>

                    <label for="bukti_transfer"
                           class="flex items-center gap-3 w-full rounded-xl border-2 border-dashed border-primary/20 bg-primary/5 hover:bg-primary/10 px-4 py-4 cursor-pointer transition-colors">
                        <span class="material-symbols-outlined text-primary">upload_file</span>
                        <div class="flex-1 min-w-0">
                            <p id="file-name" class="text-sm font-semibold text-slate-500 truncate">Ketuk untuk memilih file</p>
                        </div>
                        <input type="file" id="bukti_transfer" name="bukti_transfer" required
                               accept="image/*" class="hidden"
                               onchange="updateFileName(this); validateFileSize(this); previewImage(this);">
                    </label>

                    <img id="preview"
                         class="hidden w-full rounded-2xl object-cover border border-primary/10 max-h-48">
                </div>
            </div>

            {{-- Submit --}}
            <button type="submit"
                    class="w-full flex items-center justify-center gap-3 rounded-2xl bg-primary py-4 font-bold text-white hover:bg-primary-dark active:scale-[0.98] transition-all shadow-lg shadow-primary/20">
                Kirim Pendaftaran
                <span class="w-8 h-8 bg-white text-primary flex items-center justify-center rounded-full">
                    <i class="fa-solid fa-paper-plane text-xs"></i>
                </span>
            </button>

            {{-- Back --}}
            <a href="{{ route('menu.show', $menu) }}"
               class="flex items-center justify-center gap-2 text-xs font-semibold text-slate-400 hover:text-primary transition-colors py-2">
                <span class="material-symbols-outlined text-base">arrow_back</span>
                Kembali ke detail acara
            </a>

        </form>

    </div>
</div>

{{-- SweetAlert session feedback --}}
@if(session('success'))
<script>
    Swal.fire({ icon: 'success', title: 'Berhasil', text: '{{ session('success') }}' });
</script>
@endif
@if(session('error'))
<script>
    Swal.fire({ icon: 'error', title: 'Gagal', text: "{{ session('error') }}" });
</script>
@endif

<script src="{{ asset('js/registrasi.js') }}"></script>
<script>
    // Name: letters only
    document.getElementById('nama').addEventListener('input', function () {
        this.value = this.value.replace(/[^A-Za-z\s]/g, '');
    });

    // File upload helpers
    function updateFileName(input) {
        document.getElementById('file-name').textContent =
            input.files.length > 0 ? input.files[0].name : 'Ketuk untuk memilih file';
    }
    function validateFileSize(input) {
        if (input.files[0] && input.files[0].size > 2 * 1024 * 1024) {
            Swal.fire({ icon: 'warning', title: 'File Terlalu Besar', text: 'Ukuran file harus kurang dari 2MB.' });
            input.value = '';
            document.getElementById('file-name').textContent = 'Ketuk untuk memilih file';
            document.getElementById('preview').classList.add('hidden');
        }
    }
    function previewImage(input) {
        if (input.files[0]) {
            const reader = new FileReader();
            reader.onload = e => {
                const preview = document.getElementById('preview');
                preview.src = e.target.result;
                preview.classList.remove('hidden');
            };
            reader.readAsDataURL(input.files[0]);
        }
    }
</script>

@endsection