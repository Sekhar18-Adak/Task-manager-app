<!DOCTYPE html>
<html lang="{{ str_replace('_','-',app()->getLocale())}}">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Task Manger | @yield('title')</title>
    @include('layout.css')
    @yield('style')
</head>
<body>
    @yield('content')
    @include('layout.js')
    @yield('custom.js')
</body>
</html>