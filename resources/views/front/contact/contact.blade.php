@extends('front.layouts.app')

@section('content')
    <div class="container mx-auto py-8">
        <div class="text-center mb-8">
            <h1 class="text-3xl font-bold">{{ $contactPage->title }}</h1>
        </div>

        <div class="contact-description-box p-4 border border-gray-300 rounded-lg overflow-hidden">
            {!! $contactPage->description !!}
        </div>
    </div>
@endsection
