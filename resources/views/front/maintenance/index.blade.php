<!DOCTYPE html>
@if($config['app_status'] != 0)
<script>
    window.location.href = "{{ url('/') }}";
</script>
@else
<html lang="id">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Maintenance</title>

    <link rel="stylesheet" href="{{ asset('css/front.css') }}">

    <link rel="icon" type="image/x-icon" href="{{ $config['app_favicon'] }}">

    <script src="https://cdn.tailwindcss.com"></script>

    <style>
        @keyframes float {
            0%,100% { transform: translateY(0); }
            50% { transform: translateY(-12px); }
        }

        .float {
            animation: float 4s ease-in-out infinite;
        }

        @keyframes gradient {
            0% { background-position: 0% 50%; }
            50% { background-position: 100% 50%; }
            100% { background-position: 0% 50%; }
        }

        .animated-bg {
            background: linear-gradient(270deg, #fde68a, #facc15, #fb923c);
            background-size: 600% 600%;
            animation: gradient 10s ease infinite;
        }
    </style>
</head>

<body class="relative min-h-screen overflow-hidden animated-bg">

    <div id="particles" class="absolute inset-0 pointer-events-none"></div>

    <div class="relative z-10 flex items-center justify-center min-h-screen px-4">
        <div class="text-center max-w-md w-full">

            <img src="https://media1.tenor.com/m/NvTh_ZMUNM4AAAAC/kobayashi-kobayashi-dragon-maid.gif"
                alt="Maintenance"
                class="mx-auto w-40 sm:w-48 rounded-xl shadow-xl float">

            <h1 class="mt-6 text-3xl sm:text-4xl font-extrabold text-yellow-900 tracking-tight">
                Website dalam Perbaikan
            </h1>

            <p class="mt-3 text-base sm:text-lg text-yellow-800/90">
                Kami sedang melakukan pemeliharaan sistem.<br>
                Silakan kembali lagi nanti.
            </p>

            <div class="mt-6 flex justify-center gap-3">
                <span class="px-4 py-2 bg-yellow-900 text-white rounded-full text-sm shadow-lg">
                    Maintenance Mode
                </span>
                <span class="px-4 py-2 bg-white/80 backdrop-blur rounded-full text-sm">
                    ETA: Soon
                </span>
            </div>
        </div>
    </div>

    <footer class="absolute bottom-2 w-full text-center z-20">
        <div class="group flex flex-col items-center gap-1 opacity-60 hover:opacity-100 transition">
            <img src="https://github.com/SLAVUSworks/HL-Web-ICON/blob/master/slavusworks.png?raw=true"
                class="w-9 h-9 object-contain group-hover:scale-105 transition">

            <p class="text-[10px] sm:text-xs text-blue-600 tracking-wide leading-tight">
                ©{{ date('Y') }} HL-Web App n Booking System<br>
                <span class="font-bold">SLAVUSworks</span>
            </p>
        </div>
    </footer>

    <script>
        document.addEventListener('mousemove', e => {
            const x = (window.innerWidth / 2 - e.clientX) / 30;
            const y = (window.innerHeight / 2 - e.clientY) / 30;

            document.querySelector('.float').style.transform =
                `translate(${x}px, ${y}px)`;
        });

        const container = document.getElementById('particles');
        for (let i = 0; i < 20; i++) {
            const dot = document.createElement('div');
            dot.className = 'absolute rounded-full bg-white/40';
            dot.style.width = dot.style.height = Math.random() * 6 + 4 + 'px';
            dot.style.left = Math.random() * 100 + '%';
            dot.style.top = Math.random() * 100 + '%';
            dot.style.animation = `float ${Math.random() * 6 + 4}s ease-in-out infinite`;
            container.appendChild(dot);
        }
    </script>

</body>
</html>
@endif
