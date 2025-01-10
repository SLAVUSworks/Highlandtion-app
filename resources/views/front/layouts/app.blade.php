<!doctype html>
<html lang="en">
<head>
    <meta charset="utf-8">
    <meta http-equiv="X-UA-Compatible" content="IE=edge">
    <meta name="viewport" content="width=device-width, initial-scale=1">
    <link href="https://cdn.tailwindcss.com" rel="stylesheet">
    <link rel="stylesheet" href="https://pro.fontawesome.com/releases/v5.10.0/css/all.css" crossorigin="anonymous" />
    <link href="https://unpkg.com/tailwindcss@^2/dist/tailwind.min.css" rel="stylesheet">
    <title>@yield('title', 'Laravel Application')</title>
</head>
<body class="flex items-center justify-center">
    @yield('content')

    <style>
        ::-webkit-scrollbar { width: 0; }
        ::-webkit-scrollbar-track { -webkit-box-shadow: inset 0 0 0px rgba(0, 0, 0, 0.3); }
        ::-webkit-scrollbar-thumb { background-color: transparent; outline: 1px solid transparent; }
    </style>
</body>
</html>
