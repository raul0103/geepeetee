<!DOCTYPE html>
<html lang="{{ str_replace('_', '-', app()->getLocale()) }}">

<head>
    @vite(['resources/sass/app.sass'])
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
</body>

</html>
