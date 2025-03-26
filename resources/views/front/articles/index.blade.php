@extends('front.layouts.app')

@section('content')
<div class="container mx-auto px-4">
    <h1 class="mb-6 mt-6 text-3xl font-extrabold text-gray-900">Daftar Informasi</h1>
    
    <div class="grid grid-cols-1 sm:grid-cols-2 lg:grid-cols-3 gap-6">
        @forelse ($articles as $article)
        <div class="bg-white border rounded-lg shadow-md dark:bg-gray-800 dark:border-gray-700" data-aos="fade-up"
            data-aos-anchor-placement="top-bottom">
            <div class="p-2 flex justify-center">
                <a href="{{ route('front.articles.show', $article->slug) }}" class="block w-full h-48">
                    <img 
                        class="rounded-lg object-cover w-full h-full"
                        src="{{ asset('storage/' . $article->img) }}"
                        alt="{{ $article->title }}"
                        loading="lazy">
                </a>
            </div>
            
            <div class="px-4 pb-3">
                <div>
                    <a href="{{ route('front.articles.show', $article->slug) }}">
                        <h5 class="text-xl font-semibold tracking-tight hover:text-violet-800 dark:hover:text-violet-300 text-gray-900 dark:text-white">
                            {{ $article->title }}
                        </h5>
                    </a>
                    <p class="text-gray-600 dark:text-gray-400 text-sm break-words">
                        {{ Str::limit(strip_tags(html_entity_decode($article->desc)), 100) }}
                    </p>                                       
                </div>
                <div class="mt-2 flex justify-between">
                    <div class="flex items-center gap-3 py-2">
                        <img src="{{ asset('storage/'.$article->user->avatar) }}" 
                            class="object-cover w-12 h-12 rounded-full" alt="thumbnail" loading="lazy">
                        <p class="text-gray-600 dark:text-gray-300 hover:text-violet-800">
                            <a href="#" class="text-sm">
                                <small>Penulis</small> <br>
                                {{ $article->user->nickname }}
                            </a>
                        </p>
                    </div>
                    <div class="flex items-center mt-2.5">
                        <span class="bg-blue-100 text-blue-800 text-xs font-semibold mr-2 px-2.5 py-0.5 rounded dark:bg-blue-200 dark:text-blue-800 ml-3">
                            {{ \Carbon\Carbon::parse($article->publish_date)->format('d M Y') }}
                        </span>
                    </div>
                </div>
            </div>
        </div>
        @empty
        <p class="text-gray-700 dark:text-gray-300">Tidak ada artikel untuk ditampilkan.</p>
        @endforelse
    </div>

    <div class="mt-6">
        {{ $articles->links() }}
    </div>
</div>
@endsection
