<!DOCTYPE html>
<html lang="{{ str_replace('_', '-', app()->getLocale()) }}">

<head>
    @vite(['resources/sass/app.sass'])
</head>

<body>
    @yield('body')
</body>

</html>
