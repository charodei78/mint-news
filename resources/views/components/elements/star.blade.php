<div x-data="{
        off: '/ico/toFavorite.svg',
        on: '/ico/inFavorite.svg',
        position: {{ $inFavorite ? 'true' : 'false' }},
    }"
    {{ $attributes->merge(['class' => 'cursor-pointer']) }}
>
    <img class="max-h-full h-full object-contain" :src="position ? on : off" @mouseenter="position=!position;" @mouseout="position=!position;">
</div>
