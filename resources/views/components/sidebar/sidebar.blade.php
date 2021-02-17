<div {{$attributes->merge([])}} :class="{'mx-3': isOpen}" x-data="{mobile: false, isOpen: false}"
     x-on:resize.window="mobile = window.outerWidth > 640 ? false : true"
     x-init="mobile = window.outerWidth > 640 ? false : true"
     @click.away="isOpen = false"
     @change-category.window="isOpen = false"
>
    <a
            class="top-4 left-2 z-50 cursor-pointer fixed sm:hidden"
            @click="isOpen = !isOpen"
    >
        <img src="/ico/burger.svg">
    </a>
    <div x-show.transition.origin.left="isOpen || !mobile" class="w-44">
    </div>
    <div x-show.transition.origin.left="isOpen || !mobile" class="inline-block mr-5 fixed">
        <livewire:category-list></livewire:category-list>
        <x-sidebar.side-info-links class=""></x-sidebar.side-info-links>
    </div>
</div>