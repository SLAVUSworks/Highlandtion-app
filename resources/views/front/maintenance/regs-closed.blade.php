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
    <title>Closed</title>
    <link rel="icon" type="image/x-icon" href="{{ $config['app_favicon'] }}">
    <script src="https://cdn.tailwindcss.com"></script>
</head>
<body class="flex items-center justify-center min-h-screen bg-gray-100">
    <div class="text-center space-y-4">
        <img src="https://media1.tenor.com/m/ZTQ6vrw4qPQAAAAd/bocchi-the-rock-ryo.gif" 
             alt="Bocchi The Rock" 
             class="mx-auto w-48 h-48 rounded-lg">
    
        <h1 class="text-4xl font-bold text-yellow-900 mt-4">Pendaftaran Telah Ditutup</h1>
        <p class="text-lg text-gray-600 mt-2">
            Mohon maaf, Anda tidak dapat mengakses laman pendaftaran saat ini. Sampai jumpa di lain waktu.
        </p>
    
        <p class="text-lg text-gray-600 mt-4">
            Anda akan dialihkan ke halaman informasi dalam 
            <span id="countdown" class="font-bold text-red-600">10</span> detik...
        </p>
    </div>    

    <script>
        let counter = 10;
        const countdownElement = document.getElementById('countdown');

        const countdown = setInterval(() => {
            counter--;
            countdownElement.textContent = counter;
            if (counter <= 0) {
                clearInterval(countdown);
                window.location.href = "{{ url('/informasi') }}";
            }
        }, 1000);
    </script>
</body>
</html>
@endif
