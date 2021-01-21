<!doctype html>
<html lang="ru">
<head>
    <meta charset="UTF-8">
    <meta name="viewport"
          content="width=device-width, user-scalable=no, initial-scale=1.0, maximum-scale=1.0, minimum-scale=1.0">
    <meta http-equiv="X-UA-Compatible" content="ie=edge">
    <link rel="preconnect" href="https://fonts.gstatic.com">
    <script src="https://cdn.jsdelivr.net/gh/alpinejs/alpine@v2.8.0/dist/alpine.min.js" defer></script>
    @livewireStyles
    <link href="https://fonts.googleapis.com/css2?family=Montserrat+Alternates:ital,wght@0,300;0,400;0,500;0,600;1,300;1,400;1,500;1,600&family=Righteous&display=swap" rel="stylesheet">
    <link href="/css/app.css" rel="stylesheet">
    @yield('head')
    <title>@yield('title', 'Mint')</title>
</head>
<body >
<div id="blackout" class="bg-black opacity-30 w-full top-0 absolute"></div>
<x-header.header></x-header.header>
<div class="flex w-full p-5 md:w-5/6  xl:w-2/3 mx-auto justify-between mt-24">
    <x-sidebar.sidebar class="w-50 "></x-sidebar.sidebar>
    <div class="w-full px-5">
        @yield('content')
    </div>
    <div class="w-1/4 hidden 2xl:block">
        Lorem ipsum dolor sit amet, consectetur adipisicing elit. Aliquam culpa cumque id nihil sed, tempora tenetur. Asperiores deleniti eius harum illo possimus quis vel. Nisi!
    </div>
</div>
@yield('script')
@livewireScripts
</body>
</html>
