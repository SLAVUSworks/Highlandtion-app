@extends('front.layouts.app')

@section('content')

<div class="min-h-screen px-4 py-8">
    <div class="max-w-6xl mx-auto space-y-8">
        <div data-aos="fade-up">
            <span class="inline-block px-4 py-1 rounded-full bg-primary/10 text-primary text-xs font-bold uppercase tracking-wider mb-3">
                Dokumen
            </span>
            <h1 class="text-3xl md:text-4xl font-black text-slate-900 dark:text-white">Juknis Acara</h1>
            <p class="text-slate-400 mt-1 text-sm">Unduh panduan teknis pelaksanaan acara di bawah ini</p>
        </div>
        @forelse ($juknis as $item)
        @if ($loop->first)
        <div class="grid grid-cols-1 sm:grid-cols-2 lg:grid-cols-3 gap-6">
        @endif

            <div class="group flex flex-col rounded-3xl border border-primary/10 bg-white dark:bg-slate-900 shadow-xl overflow-hidden transition-all hover:shadow-2xl hover:shadow-primary/10"
                 data-aos="fade-up" data-aos-anchor-placement="top-bottom">

                {{-- Card top accent --}}
                <div class="h-2 w-full bg-gradient-to-r from-primary to-primary-light"></div>

                {{-- Body --}}
                <div class="flex-1 p-6 space-y-3">
                    <div class="flex items-start gap-3">
                        <div class="flex h-11 w-11 items-center justify-center rounded-xl bg-primary/10 text-primary shrink-0 mt-0.5">
                            <span class="material-symbols-outlined text-xl">description</span>
                        </div>
                        <div class="min-w-0">
                            <p class="text-xs text-slate-400 font-bold uppercase tracking-widest mb-0.5">Juknis</p>
                            <h5 class="text-base font-black text-slate-900 dark:text-white leading-snug">
                                {{ $item->nama_event }}
                            </h5>
                        </div>
                    </div>

                    @if(!empty($item->keterangan))
                    <p class="text-sm text-slate-500 dark:text-slate-400 leading-relaxed line-clamp-3">
                        {{ Str::limit($item->keterangan, 120) }}
                    </p>
                    @endif
                </div>
                <div class="px-6 pb-6">
                    <a href="{{ route('front.juknis.download', $item) }}"
                       class="flex items-center justify-between w-full rounded-2xl bg-primary px-5 py-3.5 font-bold text-white hover:bg-primary-dark active:scale-[0.98] transition-all shadow-lg shadow-primary/20 group/btn">
                        <span class="text-sm">Unduh PDF</span>
                        <span class="w-8 h-8 bg-white text-primary flex items-center justify-center rounded-full shrink-0 group-hover/btn:scale-110 transition-transform">
                            <span class="material-symbols-outlined text-base">download</span>
                        </span>
                    </a>
                </div>

            </div>

        @if ($loop->last)
        </div>
        @endif

        @empty
        <div class="flex flex-col items-center justify-center py-24 text-center space-y-3">
            <span class="material-symbols-outlined text-slate-300 dark:text-slate-700" style="font-size: 4rem;">folder_open</span>
            <p class="text-slate-400 font-semibold">Belum ada juknis tersedia.</p>
        </div>
        @endforelse

        <div class="pt-4">
            {{ $juknis->links() }}
        </div>

    </div>
</div>

@endsection