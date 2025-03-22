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
    <link rel="icon" type="image/x-icon" href="{{ $config['app_favicon'] }}">
    <script src="https://cdn.tailwindcss.com"></script>
</head>
<body class="flex items-center justify-center min-h-screen bg-gray-100">
    <div class="text-center space-y-4">
        <img src="https://media1.tenor.com/m/NvTh_ZMUNM4AAAAC/kobayashi-kobayashi-dragon-maid.gif" 
             alt="Bocchi The Rock" 
             class="mx-auto h-48 rounded-lg">
        <h1 class="text-4xl font-bold text-yellow-900 mt-4">⚠️ Website dalam Perbaikan</h1>
        <p class="text-lg text-gray-600 mt-2">Kami sedang melakukan pemeliharaan sistem. Silakan kembali lagi nanti.</p>
    </div>
</body>
</html>
@endif
