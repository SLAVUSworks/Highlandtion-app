<!DOCTYPE html>
<html class="dark" lang="id">
    <head>
        <meta charset="utf-8"/>
        <meta content="width=device-width, initial-scale=1.0" name="viewport"/>

        <!-- CDN Tailwind CSS -->
        <script src="https://cdn.tailwindcss.com"></script>

        <!-- LOCAL Tailwind CSS -->
        <!-- @vite(['resources/css/app.css', 'resources/js/app.js']) -->

        <!-- Dev Note: Local Tailwind isn't working properly, so I use CDN for now. I will fix this issue later. -->
        <!-- Last Working version is Tailwind v3 -->
        <!-- Slavus: 09-03-2026 -->

        @include('front.layouts.meta')

        {{-- Iconography --}}
        <link href="https://fonts.googleapis.com/css2?family=Material+Symbols+Outlined:wght@100..700,0..1&display=swap" rel="stylesheet"/>
        <link href="https://fonts.googleapis.com/css2?family=Material+Symbols+Outlined:wght,FILL@100..700,0..1&display=swap" rel="stylesheet"/>

        {{-- Existing dependencies --}}
        <link rel="stylesheet" href="https://cdnjs.cloudflare.com/ajax/libs/font-awesome/6.7.1/css/all.min.css">
        <link rel="icon" type="image/x-icon" href="{{ $config['app_favicon'] }}">
        <script src="https://cdn.jsdelivr.net/npm/sweetalert2@11"></script>
        <script src="https://unpkg.com/typewriter-effect@latest/dist/core.js"></script>
        <link href="https://unpkg.com/aos@2.3.1/dist/aos.css" rel="stylesheet">
        <link rel="stylesheet" href="{{ asset('css/front.css') }}">

        @include('front.layouts.partials.palettes')

        <title>@yield('title', $config['app_name'])</title>
    </head>

<body class="bg-background-light dark:bg-background-dark font-display text-slate-900 dark:text-slate-100 antialiased">
    <div class="relative flex min-h-screen flex-col overflow-x-hidden">
        @include('layouts.partials.navbar')

        <main class="flex-1">
            @yield('content')
        </main>

        @include('front.layouts.partials.footer')
    </div>

    {{-- AOS --}}
    <script src="https://cdn.jsdelivr.net/npm/aos@2.3.4/dist/aos.js"></script>
    <script>
        document.addEventListener('DOMContentLoaded', () => {
            AOS.init({ duration: 1000, once: true });
        });
    </script>

    @stack('scripts')

</body>
</html>
