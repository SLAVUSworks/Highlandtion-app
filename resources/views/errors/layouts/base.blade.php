<!DOCTYPE html>
<html lang="id">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>@yield('title')</title>

    <script src="https://cdn.tailwindcss.com"></script>

    <link rel="icon" type="image/x-icon" href="{{ $config['app_favicon'] }}">

    <style>
        @keyframes float {
            0%,100% { transform: translateY(0); }
            50% { transform: translateY(-14px); }
        }

        @keyframes gradient {
            0% { background-position: 0% 50%; }
            50% { background-position: 100% 50%; }
            100% { background-position: 0% 50%; }
        }

        .animated-bg {
            background: linear-gradient(270deg, #1e3a8a, #2563eb, #0f172a);
            background-size: 600% 600%;
            animation: gradient 14s ease infinite;
        }

        .float {
            animation: float 4s ease-in-out infinite;
        }
    </style>
</head>

<body class="relative min-h-screen overflow-hidden animated-bg text-white">

    <div id="particles" class="absolute inset-0 pointer-events-none"></div>

    <div class="relative z-10 flex flex-col items-center justify-center min-h-screen px-4 text-center">

    @yield('content')

    </div>

    <footer class="absolute bottom-2 w-full text-center z-20">
        <div class="flex flex-col items-center gap-1 opacity-70">
            <img src="https://github.com/SLAVUSworks/HL-Web-ICON/blob/master/slavusworks.png?raw=true"
                 alt="SLAVUSworks"
                 class="w-9 h-9 object-contain">

            <p class="text-[10px] sm:text-xs text-white/80 tracking-wide leading-tight">
                ©{{ date('Y') }} HL-Web App n Booking System<br>
                <span class="font-bold">SLAVUSworks</span>
            </p>
        </div>
    </footer>

    <script>
        document.addEventListener('mousemove', e => {
            const x = (window.innerWidth / 2 - e.clientX) / 40;
            const y = (window.innerHeight / 2 - e.clientY) / 40;
            document.querySelector('.float').style.transform =
                `translate(${x}px, ${y}px)`;
        });

        const container = document.getElementById('particles');
        for (let i = 0; i < 16; i++) {
            const dot = document.createElement('div');
            dot.className = 'absolute rounded-full bg-white/30';
            dot.style.width = dot.style.height = Math.random() * 6 + 4 + 'px';
            dot.style.left = Math.random() * 100 + '%';
            dot.style.top = Math.random() * 100 + '%';
            dot.style.animation = `float ${Math.random() * 6 + 4}s ease-in-out infinite`;
            container.appendChild(dot);
        }
    </script>

</body>
</html>
