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
                        {!! $article->desc !!}
                    </div>
                                       
                </div>
            </div>
            <!-- Author Info -->
            <div class="mb-6 shadow-lg rounded-lg bg-white dark:bg-gray-800" data-aos="fade-in">
                <div class="flex flex-wrap">
                    <div class="w-full md:w-1/3 p-4">
                        <img class="w-full h-auto rounded-full object-cover" src="{{ asset('storage/'.$article->user->avatar) }}" alt="{{ $article->user->nickname }}">
                    </div>
                    <div class="w-full md:w-2/3 p-6">
                        <h4 class="text-lg font-bold text-gray-900 dark:text-white">Penulis</h4>
                        <hr class="my-4 border-gray-300 dark:border-gray-700">
                        <div class="space-y-3">
                            <div class="flex justify-between">
                                <span class="font-medium text-gray-600 dark:text-gray-400">Panggilan</span>
                                <span class="text-gray-800 dark:text-gray-300">{{ $article->user->nickname }}</span>
                            </div>
                            <div class="flex justify-between">
                                <span class="font-medium text-gray-600 dark:text-gray-400">Nama Lengkap</span>
                                <span class="text-gray-800 dark:text-gray-300">{{ $article->user->full_name }}</span>
                            </div>
                            <div class="flex justify-between">
                                <span class="font-medium text-gray-600 dark:text-gray-400">Email</span>
                                <span class="text-gray-800 dark:text-gray-300">{{ $article->user->email }}</span>
                            </div>
                            <div class="flex justify-between">
                                <span class="font-medium text-gray-600 dark:text-gray-400">Register</span>
                                <span class="text-gray-800 dark:text-gray-300">
                                    @if ($article->user->role == 1)
                                        Admin
                                    @elseif ($article->user->role == 2)
                                        Head
                                    @else
                                        Assistant
                                    @endif
                                </span>
                            </div>
                            <div>
                                <small class="text-gray-500 dark:text-gray-400">Terdaftar Pada {{ date('d-m-Y', strtotime($article->user->created_at)) }}</small>
                            </div>
                        </div>
                    </div>
                </div>
            </div>
        </div>
    </div>
</div>
@endsection