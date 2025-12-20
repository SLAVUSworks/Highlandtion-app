<!DOCTYPE html>
@if($config['app_status'] != 2)
<script>
    window.location.href = "{{ url('/') }}";
</script>
@else
<html lang="id">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Pendaftaran Ditutup</title>
    <link rel="icon" type="image/x-icon" href="{{ $config['app_favicon'] }}">

    <script src="https://cdn.tailwindcss.com"></script>

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
            background: linear-gradient(270deg, #616161ff, #3a3a3aff, #202020ff);
            background-size: 600% 600%;
            animation: gradient 12s ease infinite;
        }

        .float {
            animation: float 4s ease-in-out infinite;
        }
    </style>
</head>

<body class="relative min-h-screen overflow-hidden animated-bg">

    <div id="particles" class="absolute inset-0 pointer-events-none"></div>

    <div class="relative z-10 flex items-center justify-center min-h-screen px-4">
        <div class="text-center max-w-md w-full">

            <img src="https://media1.tenor.com/m/ZTQ6vrw4qPQAAAAd/bocchi-the-rock-ryo.gif"
                 alt="Closed"
                 class="mx-auto w-36 sm:w-44 rounded-xl shadow-xl float">

            <h1 class="mt-6 text-3xl sm:text-4xl font-extrabold text-white tracking-tight">
                Pendaftaran Ditutup
            </h1>

            <p class="mt-3 text-base sm:text-lg text-white">
                Mohon maaf, pendaftaran saat ini sudah ditutup.<br>
                Sampai jumpa di kesempatan berikutnya
            </p>

            <div class="mt-6 flex flex-col items-center gap-2">
                <div class="w-20 h-20 rounded-full border-4 border-red-600 flex items-center justify-center bg-white backdrop-blur shadow-lg">
                    <span id="countdown" class="text-3xl font-bold text-red-600">10</span>
                </div>
                <p class="text-sm text-white">
                    Dialihkan ke halaman informasi
                </p>
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
        let counter = 10;
        const countdownElement = document.getElementById('countdown');

        const timer = setInterval(() => {
            counter--;
            countdownElement.textContent = counter;
            if (counter <= 0) {
                clearInterval(timer);
                window.location.href = "{{ url('/informasi') }}";
            }
        }, 1000);

        document.addEventListener('mousemove', e => {
            const x = (window.innerWidth / 2 - e.clientX) / 40;
            const y = (window.innerHeight / 2 - e.clientY) / 40;
            document.querySelector('.float').style.transform =
                `translate(${x}px, ${y}px)`;
        });

        const container = document.getElementById('particles');
        for (let i = 0; i < 18; i++) {
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
