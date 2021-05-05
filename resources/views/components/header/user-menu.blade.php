<div x-data="{open: false}" class="{{ $class ?? '' }} relative">
    <a @click="open=!open">
        <img class="user_menu shadow-filter" src="{{ Storage::url(Auth::user()->avatar['ico']) }}">
    </a>
    <ul x-show.transition="open"
        style="display:none"
        @click.away="open=false"
        class="absolute z-30 text-gray-900  shadow-md right-0 rounded py-2.5 leading-8 top-14 text-green-500 bg-green-100">
        <li class="px-5 text-xl mb-1 text-black">{{ explode(' ', Auth::user()->name)[0] }}</li>
        <li class="px-5  hover:bg-green-200 cursor-pointer">
            <div class="w-full h-full" @mouseup="open = false;changePage('settings');">
                {{ __('Настройки') }}
            </div>
        </li>
        <li class="px-5  hover:bg-green-200 cursor-pointer">
            <div class="w-full h-full"
                 @mouseup="open = false;changePage('my-posts');">
                {{ __('Мои посты') }}
            </div>
        </li>
        <li class="px-5  hover:bg-green-200 cursor-pointer">
            <div class="w-full h-full"
                 @mouseup="open = false;changePage('edit-post');">
                {{ __('Создать пост') }}
            </div>
        </li>
        <li class="px-5  hover:bg-green-200 cursor-pointer">
            <div class="w-full h-full">
                {{ __('Помощ') }}
            </div>
        </li>
        <li class="px-5  hover:bg-green-200 cursor-pointer" @click="location.href = '{{ route('logout') }}'">
            <div class="w-full h-full">
                {{ __('Выйти') }}
            </div>
        </li>
    </ul>
</div>
