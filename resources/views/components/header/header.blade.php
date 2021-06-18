<header class="shadow-md fixed top-0 z-50 h-12 pt-1 {{ $class ?? '' }}">
    <div id="header_wrapper" class="w-5/6  xl:w-2/3 mx-auto px-4 sm:px-6 ">
        <div class="flex w-full justify-between items-center md:space-x-10">
            <a href="/" id="logo" class="text-4xl w-2/5 sm:w-1/6">Mint</a>
            <livewire:search class="w-2/3 md:w-5/12" />
            <div id="user_bar" class="justify-start space-x-2.5 pl-4 flex w-0 sm:w-1/4">
                @auth
                    <img class="user_menu shadow-filter hidden sm:flex"
                         x-data="{}"
                         @mousedown="changePage('favorite')"
                         src="/ico/inFavorite.svg" alt="⭐">
                    {{--<x-header.notifications class="hidden sm:flex"></x-header.notifications>--}}
                    <x-header.user-menu></x-header.user-menu>
                    <span class="text-xl my-auto hidden lg:block">{{ explode(' ', Auth::user()->name)[0] }}</span>
                @endauth
                @guest
                    <a x-data="{}" @click="$dispatch('open-login')" class="flex text-center cursor-pointer">
                        <img src="/ico/login-button.svg" alt="login" class="min-w-max min-w-8 mr-2">
                        <span class="text-xl my-auto hidden lg:block text-green-100">{{ __('Вход') }}</span>
                    </a>
                @endguest
            </div>
        </div>
    </div>
</header>
