<div
        class="
                {{ $selected ?? false ? 'bg-green-600' : 'hover:bg-green-600 hover:bg-opacity-50' }}
                side-menu-button
                {{ $class ?? '' }}
                "
>
    <img src="{{ $image ?? '/ico/star.svg' }}">
    <span>
        {{ $slot }}
    </span>
</div>