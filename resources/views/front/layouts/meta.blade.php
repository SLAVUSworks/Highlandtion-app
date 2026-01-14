<meta name="description" content="{{ $config['app_description'] ?? '' }}">
<meta name="keywords" content="{{ $config['app_name'] ?? '' }},{{ $config['tagline'] ?? '' }}, smansa landbouw, sman 1 bukittinggi, sman 1, sman 1 bkt, sman 1 bkt official, highlandtion, highlandtion app, highlandtion web app, hl-web app, hl-web booking system">
<meta name="robots" content="index, follow">

<meta property="og:type" content="website">
<meta property="og:site_name" content="{{ $config['app_name'] ?? '' }}">
<meta property="og:title" content="{{ $config['app_name'] ?? '' }}">
<meta property="og:description" content="{{ $config['app_description'] ?? '' }}">
<meta property="og:url" content="{{ url()->current() }}">
<meta property="og:image" content="{{ 
    asset(
        ($config['app_status'] ?? 1) == 0
            ? 'digimark/under-cons.png'
            : ($config['header-background'] ?? $config['app_favicon'])
    )
}}">
<meta property="og:image:width" content="1200">
<meta property="og:image:height" content="630">

<meta property="og:image:secure_url" content="{{ 
    asset(
        ($config['app_status'] ?? 1) == 0
            ? 'digimark/under-cons.png'
            : ($config['header-background'] ?? $config['app_favicon'])
    )
}}">

<meta name="twitter:card" content="summary_large_image">
<meta name="twitter:title" content="{{ $config['app_name'] ?? '' }}">
<meta name="twitter:description" content="{{ $config['app_description'] ?? '' }}">
<meta name="twitter:image" content="{{ 
    asset(
        ($config['app_status'] ?? 1) == 0
            ? 'digimark/under-cons.png'
            : ($config['header-background'] ?? $config['app_favicon'])
    )
}}">

<meta name="telegram:channel" content="{{ Str::slug($config['app_name'] ?? '') }}">

<meta name="pinterest-rich-pin" content="true">

<meta name="theme-color" content="#0d6efd">