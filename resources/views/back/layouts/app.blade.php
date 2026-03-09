<!DOCTYPE html>
<html lang="en">

<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <meta name="csrf-token" content="{{ csrf_token() }}">
    <title>@yield('title', 'Admin Panel')</title>

    <!-- CDN Tailwind CSS -->
    <script src="https://cdn.tailwindcss.com"></script>

    <!-- LOCAL Tailwind CSS -->
    <!-- @vite(['resources/css/app.css', 'resources/js/app.js']) -->

    <!-- Dev Note: Local Tailwind isn't working properly, so I use CDN for now. I will fix this issue later. -->
    <!-- Last Working version is Tailwind v3 -->
    <!-- Slavus: 09-03-2026 -->

    <link rel="stylesheet" href="https://cdnjs.cloudflare.com/ajax/libs/font-awesome/6.7.1/css/all.min.css"
        integrity="sha512-5Hs3dF2AEPkpNAR7UiOHba+lRSJNeM2ECkwxUIxC1Q/FLycGTbNapWXB4tP889k5T5Ju8fs4b1P5z/iB4nMfSQ=="
        crossorigin="anonymous" referrerpolicy="no-referrer" />
    <link rel="icon" type="image/x-icon" href="{{ $config['app_favicon'] }}">
    <link rel="stylesheet" href="https://cdn.ckeditor.com/ckeditor5/44.1.0/ckeditor5.css" crossorigin>
    <script src="https://cdn.jsdelivr.net/npm/sweetalert2@11"></script>
    <script src="https://cdnjs.cloudflare.com/ajax/libs/jquery/3.7.1/jquery.min.js"></script>
    <link rel="stylesheet" href="{{ asset('css/admin.css') }}">
</head>

<body class="bg-[#EAF2FB]">
    <div id="app">
        @include('back.layouts.partials.navbar')

        @include('back.layouts.partials.sidebar')
        
        <main class="ml-64 pt-20 p-6 h-screen overflow-y-auto">
            @if ($errors->any())
            @foreach ($errors->all() as $error)
            <script>
                Swal.fire({
                    icon: 'error',
                    title: 'Gagal',
                    text: "{{ $error }}",
                });
            </script>
            @endforeach
            @endif
            <div class="p-6 rounded">
                @yield('content')
            </div>
        </main>
    </div>

    @include('back.layouts.partials.footer')

    @section('scripts')
    <script src="https://cdn.ckeditor.com/ckeditor5/36.0.1/classic/ckeditor.js"></script>
    @endsection
    <script>
        window.appRoutes = {
            fetchNotifications: "{{ route('back.registrasi.get') }}?status=pending"
        };
    </script>
    <script src="{{ asset('js/admin.js') }}"></script>

    @yield('scripts')

    @include('back.layouts.digimark')
    <script>
        function showDigimark() {
            document.getElementById("digimarkModal").classList.remove("hidden");

            lazyLoadDigimark();

            showSlide(currentSlide);
        }
    </script>
</body>
</html>
