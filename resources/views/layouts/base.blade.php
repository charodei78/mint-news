<!doctype html>
<html lang="ru">
<head>
    <meta charset="UTF-8">
    <meta name="viewport"
          content="width=device-width, user-scalable=no, initial-scale=1.0, maximum-scale=1.0, minimum-scale=1.0">
    <meta http-equiv="X-UA-Compatible" content="ie=edge">
    <link rel="preconnect" href="https://fonts.gstatic.com">
    <link rel="apple-touch-icon" sizes="180x180" href="/favicons/apple-touch-icon.png">
    <link rel="icon" type="image/png" sizes="32x32" href="/favicons/favicon-32x32.png">
    <link rel="icon" type="image/png" sizes="16x16" href="/favicons/favicon-16x16.png">
    <link rel="manifest" href="/site.webmanifest">
    <link rel="mask-icon" href="/favicons/safari-pinned-tab.svg" color="#505953">
    <meta name="msapplication-TileColor" content="#00aba9">
    <meta name="theme-color" content="#bb5656">
    @livewireStyles
    <link href="https://fonts.googleapis.com/css2?family=Montserrat+Alternates:ital,wght@0,300;0,400;0,500;0,600;1,300;1,400;1,500;1,600&family=Righteous&display=swap"
          rel="stylesheet">
    <link href="/css/tailwind.css" rel="stylesheet">
    <link href="/css/app.css" rel="stylesheet">
    <link href="/css/utilities.css" rel="stylesheet">
    @yield('head')
    <title>@yield('title', 'Mint')</title>
</head>
<body>
<div id="blackout"
     x-data="{show: false}"
     style="display:none"
     x-show="show"
     @blackout-show.window="show = true"
     @blackout-hide.window="show = false"
     class="bg-black opacity-30 w-full top-0 fixed"
></div>
<x-header.header></x-header.header>

{{-- left sidebar --}}

<div class="flex flex-row w-full sm:px-5 py-5 xl:w-2/3 mx-auto justify-between mt-12">
    <div  :class="{'mx-3': isOpen}" x-data="{mobile: false, isOpen: false}"
          x-on:resize.window="mobile = window.outerWidth > 640 ? false : true"
          x-init="mobile = window.outerWidth > 640 ? false : true"
          @click.away="isOpen = false"
          @change-page.window="isOpen = false"
    >
        <a  class="top-4 left-2 z-50 cursor-pointer fixed sm:hidden"
            @click="isOpen = !isOpen"
            >
            <img src="/ico/burger.svg">
        </a>
        <div x-show.transition.origin.left="isOpen || !mobile" class="w-44"></div>
        <div x-show.transition.origin.left="isOpen || !mobile" class="inline-block mr-5 fixed">
            <div
                class="flex flex-col space-y-1 {{ $class ?? '' }}"
                x-data="{
                    selected: {{ request()->get('id') ?? 0 }},
                    title: ''
                }"
            >
                <div class="bg-green-600 side-menu-button font-extrabold space-x-2 pl-3 text-2xl"
                     @mouseup="title = 'feed'; selected = 0; changePage('feed')"
                >
                    <img src="/ico/feed.svg">
                    <span>
                        {{ __('Лента') }}
                    </span>
                </div>
                <hr class="opacity-40 border-1 rounded">
                @php($categories = \App\Models\Category::all())
                <div class="h-60 hover:overflow-y-auto overflow-x-hidden overflow-y-hidden">
                    @foreach($categories as $category)
                        <div
                            :class="{
                                  'bg-green-600': selected == {{ $category->id }},
                                  'hover:bg-green-600 hover:bg-opacity-50': selected != {{ $category->id }}
                                    }"
                            :key="{{ $category->id }}"
                            class="side-menu-button"
                            @mouseup="title = '{{ $category->name }}'; selected = {{ $category->id }}; changePage('feed', { itemId: selected})"
                        >
                            <img src="/ico/star.svg">
                            <div class="if-marquee">
                                <span>
                                    {{ $category->name }}
                                </span>
                            </div>
                        </div>
                    @endforeach
                </div>
                <hr class="opacity-40">
                <br>
            </div>
            <div class="flex flex-col {{ $class ?? '' }}">
                <a   class="clear-none side-info-items"
                     target="_blank"
                     href="https://kazan.hh.ru/applicant/resumes/view?resume=ba6fd87dff0386373c0039ed1f7a7251564379"
                >Работодателям</a>
                <span class="side-info-items">О сервисе</span>
                <span class="side-info-items"
                      x-on:click="changePage('policy')"
                >Политики</span>
            </div>
        </div>
    </div>

    {{-- End left sidebar --}}

    <div class="w-full sm:px-5">
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
@stack('scripts')
@livewireScripts
<script src="/js/app.js"></script>
<script src="https://cdn.jsdelivr.net/gh/alpine-collective/alpine-magic-helpers@0.6.x/dist/index.min.js"></script>
<script src="https://cdn.jsdelivr.net/npm/@ryangjchandler/spruce@2.x.x/dist/spruce.umd.js"></script>
<script src="https://cdn.jsdelivr.net/gh/alpinejs/alpine@v2.8.0/dist/alpine.min.js"></script>
<script src="https://yastatic.net/share2/share.js" defer></script>
<script>
  window.Spruce.store('blackout', {
    show: false,
  });
  window.Spruce.store('login', {
    show: false,
  });

  window.addEventListener('load', () => {
      let categories = document.querySelectorAll('.if-marquee');

      for (let wrapper of categories)
      {
          if (wrapper.children[0].offsetWidth > 145)
              wrapper.classList.add('marquee')
      }

  })


</script>
</body>
</html>
