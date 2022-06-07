<!doctype html>
<html lang="{{ str_replace('_', '-', app()->getLocale()) }}">
<head>
    <meta charset="utf-8">
    <meta name="viewport" content="width=device-width, initial-scale=1">

    <!-- CSRF Token -->
    <meta name="csrf-token" content="{{ csrf_token() }}">

    <title>{{ app('site_info')->site_name ? app('site_info')->site_name : 'Register your title' }}</title>
    <link rel="icon" href={{ app('site_info')->horizontal_logo ? route('get.image', ['path' => 'website', 'subpath' => 'images', 'image' => app('site_info')->favicon]) : ""}}>

    <!-- Scripts -->
    <script src="{{ asset('js/app.js') }}" defer></script>

    <!-- Fonts -->
    <link rel="dns-prefetch" href="//fonts.gstatic.com">
    <link href="https://fonts.googleapis.com/css?family=Nunito" rel="stylesheet">

    <!-- Styles -->
    <link href="{{ asset('css/app.css') }}" rel="stylesheet">
    <link rel="stylesheet" href="{{asset('css/coreStyles.css')}}">
</head>
<body>
    <div id="app">

        <nav class="navbar container">

            <a href="#" class="navbar__logo"><img src={{ app('site_info')->horizontal_logo ? route('get.image', ['path' => 'website', 'subpath' => 'images', 'image' => app('site_info')->horizontal_logo]) : "../img/Logo.png"}} height='80' alt="burguerhouse"></a>
            <!--<p class="navbar__contact">Express delivery +1 234 567 890</p>-->

            <div class="navbar__bars" onclick="showMenu()">
                <i class="fas fa-bars"></i>
            </div>
            <ul class="navbar__navLinks d-flex">
                <li class="navbar__link mx-2"><a href={{ route('index') }}>Home</a></li>
                <li class="navbar__link mx-2"><a href="#menu_section">Menu</a></li>
                <li class="navbar__link mx-2"><a href="#">Our Story</a></li>
                <li class="navbar__link mx-2"><a href="#">Contact Us</a></li>
                <li class="navbar__link mx-2"><a href={{ route('login') }}>Sign-in</a></li>
            </ul>
        </nav>

        <main class="py-4">
            @yield('content')
        </main>
    </div>
</body>
</html>
