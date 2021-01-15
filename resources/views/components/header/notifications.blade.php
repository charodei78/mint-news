<div x-data="{open: false}" class="{{ $class ?? '' }} relative">
    <a @click="open=!open">
        <img class="user_menu shadow-filter" src="/ico/notifications.svg">
    </a>
    <div x-show.transition="open"
        @click.away="open=false"
        class="absolute text-gray-900  shadow-md w-96 h-96 right-0 rounded p-3.5 top-16 bg-green-100">
        <p class="text-xl mb-4">Уведомления</p>
        <ul class="overflow-y-auto w-full h-5/6 py-4 divide-y">
            <x-header.notify></x-header.notify>
            <x-header.notify></x-header.notify>
            <x-header.notify></x-header.notify>
            <x-header.notify></x-header.notify>
            <x-header.notify></x-header.notify>
            <x-header.notify></x-header.notify>
        </ul>
    </div>
</div>
<!-- TODO: add notification info-->
