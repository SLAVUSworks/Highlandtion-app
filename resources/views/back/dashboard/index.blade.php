@extends('back.layouts.app')

@section('title', 'WCP Dashboard')

@section('content')
<div class="container mx-auto">
    <div class="mb-6 rounded-lg bg-white/60 backdrop-blur px-6 py-4 shadow-sm border border-gray-200">
        <h1 class="flex items-center gap-3 text-3xl font-semibold text-gray-800">
            <span class="h-8 w-1.5 rounded-full bg-teal-500"></span>
            Dashboard
        </h1>
        <p class="mt-1 text-sm text-gray-500">
            Ringkasan data dan statistik terbaru
        </p>
    </div>

    <div id="dashboardData" class="space-y-6">
        @include('back.dashboard.partials.summary-stat')

        @include('back.dashboard.partials.graph')

        @include('back.dashboard.partials.table')
    </div>
</div>
@endsection
