<div x-data="{open: false}" class="{{ $class ?? '' }} relative">
    <a @click="open=!open">
        <img class="user_menu shadow-filter"  src="/user/avatar.png">
    </a>
    <ul x-show.transition="open"
        style="display:none"
        @click.away="open=false"
        class="absolute text-gray-900  shadow-md right-0 rounded py-2.5 leading-8 top-16 bg-green-100">
        <li class="px-5 text-xl mb-1">{{ explode(' ', Auth::user()->name)[0] }}</li>
        <li class="px-5  hover:bg-green-200 cursor-pointer">
            <a>
                {{ __('Настройки') }}
            </a>
        </li>
        <li class="px-5  hover:bg-green-200 cursor-pointer">
            <a>
                {{ __('Помощ') }}
            </a>
        </li>
        <li class="px-5  hover:bg-green-200 cursor-pointer" @click="location.href = '{{ route('logout') }}'">
            <a class="w-full h-full" href="">
                {{ __('Выйти') }}
            </a>
        </li>
    </ul>
</div>
<!-- TODO: add user info-->
