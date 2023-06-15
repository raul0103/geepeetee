<!DOCTYPE html>
<html lang="{{ str_replace('_', '-', app()->getLocale()) }}">

<head>
    @vite(['resources/sass/app.sass'])
    <meta name="csrf-token" content="{{ csrf_token() }}">
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
