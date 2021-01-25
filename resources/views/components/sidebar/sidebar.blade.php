<div {{$attributes->merge([])}} x-data="{mobile: false, isOpen: false}"
     x-on:resize.window="mobile = window.outerWidth > 640 ? false : true"
     x-init="mobile = window.outerWidth > 640 ? false : true"
     @click.away="isOpen = false"
>
    <a
            class="top-4 left-2 z-20 cursor-pointer fixed sm:hidden"
            @click="isOpen = !isOpen"
    >
        <img src="/ico/burger.svg">
    </a>
    <div x-show.transition.origin.left="isOpen || !mobile" class="w-44">
    </div>
    <div x-show.transition.origin.left="isOpen || !mobile" class="inline-block mr-5 fixed">
        <x-sidebar.side-menu></x-sidebar.side-menu>
        <x-sidebar.side-info-links class=""></x-sidebar.side-info-links>
    </div>
</div>