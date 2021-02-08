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
    <link href="/css/tailwind.css" rel="stylesheet">
    <link href="/css/app.css" rel="stylesheet">
    <link href="/css/utilities.css" rel="stylesheet">
    @yield('head')
    <title>@yield('title', 'Mint')</title>
</head>
<body >
<div id="blackout"
     x-data="{show: false}"
     style="display:none"
     x-show="show"
     @blackout-show.window="show = true"
     @blackout-hide.window="show = false"
     class="bg-black opacity-30 w-full top-0 fixed"
></div>
<x-header.header></x-header.header>
<div class="flex flex-row w-full p-5 xl:w-2/3 mx-auto justify-between mt-12">
    <x-sidebar.sidebar class=""></x-sidebar.sidebar>
    <div class="w-full px-5">
        @yield('content')
    </div>
    <div class="w-34r hidden lg:block">
        <livewire:right-sidebar></livewire:right-sidebar>
    </div>
</div>
@guest
    <x-user-interface.login-pop-up></x-user-interface.login-pop-up>
@endguest
@yield('script')
@livewireScripts
<script src="/js/app.js"></script>
<script src="https://cdn.jsdelivr.net/npm/@ryangjchandler/spruce@2.x.x/dist/spruce.umd.js"></script>
<script src="https://cdn.jsdelivr.net/gh/alpinejs/alpine@v2.8.0/dist/alpine.min.js"></script>
<script>
    window.Spruce.store('blackout', {
        show: false,
    });
    window.Spruce.store('login', {
        show: false,
    });
</script>
</body>
</html>
