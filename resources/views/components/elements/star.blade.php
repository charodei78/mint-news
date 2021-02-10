<div x-data="{
        inFavorite: {{ $inFavorite ? 'true' : 'false' }},
        state: {{ $inFavorite ? 'true' : 'false' }},
    }"
    {{ $attributes->merge(['class' => 'cursor-pointer']) }}
>
    <img class="max-h-full h-full object-contain" :src="'/ico/' + (state ? 'in' : 'to') + 'Favorite.svg'"
         @mouseenter="state=!state;"
         @mouseout="state=!state;"
         x-on:click.stop="Livewire.emit('favoriteChange', inFavorite, {{ $postId }}); inFavorite = !inFavorite; state = !state"
    >
</div>
