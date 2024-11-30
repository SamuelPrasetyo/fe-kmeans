<!doctype html>
<html lang="{{ str_replace('_', '-', app()->getLocale()) }}">

<head>
    <meta charset="utf-8">
    <meta name="viewport" content="width=device-width, initial-scale=1">

    <!-- CSRF Token -->
    <meta name="csrf-token" content="{{ csrf_token() }}">

    <title>@yield('title')</title>

    <!-- Fonts -->
    <link rel="dns-prefetch" href="//fonts.gstatic.com">
    <link href="https://fonts.bunny.net/css?family=Nunito" rel="stylesheet">

    <!-- Scripts -->
    @vite(['resources/sass/app.scss', 'resources/js/app.js'])

    <!-- Botstrap CSS -->
    <link rel="stylesheet" href="/assets/eliteadmin/dist/css/style.css">
</head>

<body>
    <div id="app">
        <main class="py-4">
            @yield('content')
        </main>
    </div>

    <!-- Script JS -->
    <script type="text/javascript" src="assets/js/bootstrap.js"></script>
    <script type="text/javascript" src="js/app.js"></script>
</body>

</html>