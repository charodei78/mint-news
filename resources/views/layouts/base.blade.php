<!doctype html>
<html lang="ru">
<head>
    <meta charset="UTF-8">
    <meta name="viewport"
          content="width=device-width, user-scalable=no, initial-scale=1.0, maximum-scale=1.0, minimum-scale=1.0">
    <meta http-equiv="X-UA-Compatible" content="ie=edge">
    <link rel="preconnect" href="https://fonts.gstatic.com">
    @livewireStyles
    <link href="https://fonts.googleapis.com/css2?family=Montserrat+Alternates:ital,wght@0,300;0,400;0,500;0,600;1,300;1,400;1,500;1,600&family=Righteous&display=swap" rel="stylesheet">
    <link href="/css/app.css" rel="stylesheet">
    @yield('head')
    <title>@yield('title', 'Mint')</title>
</head>
<body >
<x-header></x-header>
@yield('content')
@yield('script')
@livewireScripts
</body>
</html>
