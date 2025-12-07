@extends('front.layouts.app')

@section('content')
<div class="container mx-auto px-4 py-6">
    <div class="flex flex-wrap">
        <!-- Blog entries -->
        <div class="w-full">
            <!-- Featured blog post -->
            <div class="mb-6 shadow-lg rounded-lg bg-white dark:bg-gray-200" data-aos="fade-up">
                <img class="w-full h-64 object-cover rounded-t-lg" src="{{ asset('storage/'.$article->img) }}" alt="{{ $article->title }}">
                
                <div class="p-6">
                    <div class="text-sm text-gray-500 dark:text-gray-400 flex space-x-4 mb-4">
                        <span><i class="fa-solid fa-calendar"></i> {{ $article->publish_date }}</span>
                        <span><i class="fa-solid fa-eye"></i> {{ $article->views }}</span>
                    </div>
                    <h1 class="text-2xl font-bold text-gray-900 dark:text-dark mb-4">{{ $article->title }}</h1>
                    <div class="text-gray-700 dark:text-dark text-left break-words">
                        <div class="prose">
                            {!! $article->desc !!}
                        </div>                        
                    </div>                                       
                </div>
            </div>
            <!-- Author Info -->
            <div class="mb-6 shadow-lg rounded-lg bg-white dark:bg-gray-800 p-4 flex items-center space-x-4" data-aos="fade-in">
                <img class="w-16 h-16 rounded-full object-cover aspect-square" src="{{ asset('storage/'.$article->user->avatar) }}" alt="{{ $article->user->nickname }}">
                <div>
                    <h4 class=" text-left text-lg font-bold text-gray-900 dark:text-white">Artikel ini Ditulis Oleh {{ $article->user->nickname }}</h4>
                    <p class="text-left text-sm text-gray-500 dark:text-gray-400">
                        @if ($article->user->role == 1)
                            Admin
                        @elseif ($article->user->role == 2)
                            Moderator
                        @else
                            Verifikator
                        @endif
                        - Email : {{ $article->user->email }}
                    </p>
                </div>
            </div>
        </div>
    </div>
</div>
@endsection