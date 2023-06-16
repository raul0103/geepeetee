<!DOCTYPE html>
<html lang="{{ str_replace('_', '-', app()->getLocale()) }}">

<head>
    @vite(['resources/sass/app.sass'])
    <meta name="csrf-token" content="{{ csrf_token() }}">

    <link rel="apple-touch-icon" sizes="180x180" href="/apple-touch-icon.png">
    <link rel="icon" type="image/png" sizes="32x32" href="/favicon-32x32.png">
    <link rel="icon" type="image/png" sizes="16x16" href="/favicon-16x16.png">
    <link rel="manifest" href="/site.webmanifest">
    <meta name="msapplication-TileColor" content="#da532c">
    <meta name="theme-color" content="#ffffff">
</head>

<body>

    @include('components.header-nav')
    <div class="container">
        <section class="pagetitle">
            <h1>@yield('pagetitle')</h1>
        </section>
        <section class="main">
            @yield('body')
        </section>
    </div>

    <footer>
        Copyright © 2023
    </footer>

    @vite(['resources/js/app.js'])
    @yield('scripts')
</body>

</html>
