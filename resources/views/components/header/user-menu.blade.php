<div x-data="{open: false}" class="{{ $class ?? '' }} relative">
    <a @click="open=!open">
        <img class="user_menu shadow-filter"  src="/user/avatar.png">
    </a>
    <ul x-show.transition="open"
        @click.away="open=false"
        class="absolute text-gray-900  shadow-md right-0 rounded py-2.5 leading-8 top-16 bg-green-100">
        <li class="px-5 text-xl mb-1">Константин</li>
        <li class="px-5  hover:bg-green-200 cursor-pointer">Настройки</li>
        <li class="px-5  hover:bg-green-200 cursor-pointer">Помощ</li>
        <li class="px-5  hover:bg-green-200 cursor-pointer">Выйти</li>
    </ul>
</div>
<!-- TODO: add user info-->
