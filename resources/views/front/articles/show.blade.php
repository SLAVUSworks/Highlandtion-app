@extends('front.layouts.app')

@section('content')

<div class="min-h-screen px-4 py-8 pb-16">
    <div class="max-w-2xl mx-auto space-y-6">

        {{-- Article Card --}}
        <div class="rounded-3xl border border-primary/10 bg-white dark:bg-slate-900 shadow-xl overflow-hidden"
             data-aos="fade-up">

            {{-- Thumbnail --}}
            <div class="relative h-64 w-full overflow-hidden">
                <img src="{{ asset('storage/' . $article->img) }}"
                     alt="{{ $article->title }}"
                     class="w-full h-full object-cover">
                <div class="absolute inset-0 bg-gradient-to-t from-black/70 via-black/20 to-transparent"></div>

                {{-- Meta badges --}}
                <div class="absolute top-4 left-4 flex gap-2">
                    <span class="flex items-center gap-1.5 rounded-lg px-3 py-1 text-xs font-bold text-white backdrop-blur-md bg-black/40">
                        <i class="fa-solid fa-calendar text-primary/80"></i>
                        {{ \Carbon\Carbon::parse($article->publish_date)->format('d M Y') }}
                    </span>
                    <span class="flex items-center gap-1.5 rounded-lg px-3 py-1 text-xs font-bold text-white backdrop-blur-md bg-black/40">
                        <i class="fa-solid fa-eye text-primary/80"></i>
                        {{ number_format($article->views) }} views
                    </span>
                </div>

                {{-- Title overlay --}}
                <div class="absolute bottom-4 left-5 right-5 text-white">
                    <h1 class="text-2xl font-black leading-tight">{{ $article->title }}</h1>
                </div>
            </div>

            {{-- Article Body --}}
            <div class="px-6 py-8">
                <div class="prose prose-sm dark:prose-invert max-w-none
                            prose-headings:font-black prose-headings:text-slate-900 dark:prose-headings:text-white
                            prose-p:text-slate-600 dark:prose-p:text-slate-400 prose-p:leading-relaxed
                            prose-a:text-primary prose-a:no-underline hover:prose-a:underline
                            prose-img:rounded-2xl prose-img:border prose-img:border-primary/10">
                    {!! $article->desc !!}
                </div>
            </div>

        </div>

        {{-- Author Card --}}
        <div class="rounded-3xl border border-primary/10 bg-white dark:bg-slate-900 shadow-xl overflow-hidden"
             data-aos="fade-in">
            <div class="flex items-center gap-4 px-6 py-5">
                <img src="{{ asset('storage/' . $article->user->avatar) }}"
                     alt="{{ $article->user->nickname }}"
                     class="w-14 h-14 rounded-2xl object-cover border border-primary/10 shrink-0">
                <div class="min-w-0">
                    <p class="text-xs text-slate-400 font-bold uppercase tracking-widest">Ditulis Oleh</p>
                    <p class="text-base font-black text-slate-900 dark:text-white truncate">
                        {{ $article->user->nickname }}
                    </p>
                    <span class="inline-flex items-center gap-1 rounded-full px-2.5 py-0.5 text-xs font-bold
                        @if($article->user->role == 1) bg-primary/10 text-primary
                        @elseif($article->user->role == 2) bg-blue-500/10 text-blue-500
                        @else bg-green-500/10 text-green-500 @endif">
                        <span class="w-1.5 h-1.5 rounded-full
                            @if($article->user->role == 1) bg-primary
                            @elseif($article->user->role == 2) bg-blue-500
                            @else bg-green-500 @endif">
                        </span>
                        @if($article->user->role == 1) Admin
                        @elseif($article->user->role == 2) Moderator
                        @else Verifikator @endif
                    </span>
                </div>
            </div>
        </div>

        {{-- Back --}}
        <a href="{{ route('front.articles.index') }}"
           class="flex items-center justify-center gap-2 text-sm font-semibold text-slate-400 hover:text-primary transition-colors py-2">
            <span class="material-symbols-outlined text-base">arrow_back</span>
            Kembali ke daftar informasi
        </a>

    </div>
</div>

@endsection