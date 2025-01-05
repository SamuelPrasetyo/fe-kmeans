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
    <link rel="stylesheet" type="text/css" href="/assets/css/bootstrap.css">
</head>

<body class="fixed-layout skin-blue">
    <style>
        /* Styling untuk sidebar */
        .sidebar {
            height: 100vh;
            /* Full height */
            width: 200px;
            /* Lebar sidebar */
            position: fixed;
            /* Tetap pada posisi */
            top: 0;
            left: 0;
            background-color: #003366;
            /* Warna background */
            padding-top: 1rem;
        }

        .sidebar a {
            color: white;
            /* Warna teks */
            text-decoration: none;
            /* Menghapus garis bawah */
            display: block;
            /* Tampilkan sebagai blok */
            padding: 0.75rem 1rem;
        }

        .sidebar a:hover {
            background-color: #495057;
            /* Warna saat hover */
        }

        .content {
            margin-left: 220px;
            /* padding: 1rem; */
        }
    </style>

    <div id="app" class="content">
        <!-- Sidebar -->
        <div class="sidebar">
            <a href="dashboard">Dashboard</a>
            <a href="nilaisiswa">Data Nilai Siswa</a>
            <a href="form-clustering">Form Clustering</a>
            <a href="hasil-perbandingan">Hasil Perbandingan</a>
            <a href="logout">Logout</a>
        </div>

        <main class="py-4">
            @yield('content')
        </main>
    </div>

    <!-- Script JS -->
    <script type="text/javascript" src="/assets/js/bootstrap.js"></script>
    
    @yield('scripts')
</body>

</html>