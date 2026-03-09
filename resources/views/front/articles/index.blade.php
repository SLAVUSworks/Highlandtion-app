@extends('front.layouts.app')

@section('content')

<div class="min-h-screen px-4 py-8">
    <div class="max-w-6xl mx-auto space-y-8">

        {{-- Header --}}
        <div data-aos="fade-up">
            <span class="inline-block px-4 py-1 rounded-full bg-primary/10 text-primary text-xs font-bold uppercase tracking-wider mb-3">
                Informasi
            </span>
            <h1 class="text-3xl md:text-4xl font-black text-slate-900 dark:text-white">Daftar Informasi</h1>
            <p class="text-slate-400 mt-1 text-sm">Berita dan pengumuman terbaru dari panitia</p>
        </div>

        {{-- Grid --}}
        @forelse ($articles as $article)
        @if ($loop->first)
        <div class="grid grid-cols-1 sm:grid-cols-2 lg:grid-cols-3 gap-6">
        @endif

            <div class="group overflow-hidden rounded-2xl bg-white dark:bg-slate-900 border border-primary/10 shadow-xl transition-all hover:shadow-2xl hover:shadow-primary/10"
                 data-aos="fade-up" data-aos-anchor-placement="top-bottom">

                {{-- Thumbnail --}}
                <div class="relative h-48 w-full overflow-hidden">
                    <a href="{{ route('front.articles.show', $article->slug) }}" class="block h-full w-full">
                        <img src="{{ asset('storage/' . $article->img) }}"
                             alt="{{ $article->title }}"
                             class="h-full w-full object-cover transition-transform duration-500 group-hover:scale-110"
                             loading="lazy">
                    </a>
                    <div class="absolute inset-0 bg-gradient-to-t from-black/50 to-transparent pointer-events-none"></div>

                    {{-- Date badge --}}
                    <div class="absolute top-3 right-3">
                        <span class="rounded-lg px-2.5 py-1 text-xs font-bold text-white backdrop-blur-md bg-black/40">
                            {{ \Carbon\Carbon::parse($article->publish_date)->format('d M Y') }}
                        </span>
                    </div>
                </div>

                {{-- Body --}}
                <div class="p-5 space-y-3">

                    <a href="{{ route('front.articles.show', $article->slug) }}">
                        <h5 class="text-base font-black text-slate-900 dark:text-white hover:text-primary dark:hover:text-primary transition-colors leading-snug line-clamp-2">
                            {{ $article->title }}
                        </h5>
                    </a>

                    <p class="text-slate-500 dark:text-slate-400 text-sm leading-relaxed line-clamp-3">
                        {{ Str::limit(strip_tags(html_entity_decode($article->desc)), 100) }}
                    </p>

                    {{-- Author + Read more --}}
                    <div class="flex items-center justify-between pt-2 border-t border-slate-100 dark:border-slate-800">
                        <div class="flex items-center gap-2.5">
                            <img src="{{ asset('storage/' . $article->user->avatar) }}"
                                 class="w-8 h-8 rounded-full object-cover border border-primary/10"
                                 alt="{{ $article->user->nickname }}"
                                 loading="lazy">
                            <div>
                                <p class="text-xs text-slate-400 leading-none">Penulis</p>
                                <p class="text-xs font-bold text-slate-700 dark:text-slate-300">{{ $article->user->nickname }}</p>
                            </div>
                        </div>
                        <a href="{{ route('front.articles.show', $article->slug) }}"
                           class="flex items-center gap-1 text-xs font-bold text-primary hover:text-primary-dark transition-colors">
                            Baca
                            <span class="material-symbols-outlined text-sm">arrow_forward</span>
                        </a>
                    </div>

                </div>
            </div>

        @if ($loop->last)
        </div>
        @endif

        @empty
        <div class="flex flex-col items-center justify-center py-24 text-center space-y-3">
            <span class="material-symbols-outlined text-slate-300 dark:text-slate-700" style="font-size: 4rem;">article</span>
            <p class="text-slate-400 font-semibold">Tidak ada artikel untuk ditampilkan.</p>
        </div>
        @endforelse

        {{-- Pagination --}}
        <div class="pt-4">
            {{ $articles->links() }}
        </div>

    </div>
</div>

@endsection