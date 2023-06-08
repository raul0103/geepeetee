<!DOCTYPE html>
<html lang="{{ str_replace('_', '-', app()->getLocale()) }}">

<head>
    @vite(['resources/sass/app.sass'])
</head>

<body>
    <div class="container">
        <section class="main">
            @yield('body')
        </section>
    </div>
</body>

</html>
