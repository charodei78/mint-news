<div x-data="{
        liked: {{ $liked ? 'true' : 'false' }},
        state: {{ $liked ? 'true' : 'false' }},
    }"
    {{ $attributes->merge(['class' => 'cursor-pointer']) }}
>
    <img class="max-h-full h-full object-contain" :src="'/ico/like' + (state ? 'd' : '') + '.svg'"
         @mouseenter="state=!state;"
         @mouseout="state=!state;"
         x-on:click.stop="Livewire.emit('likeChange', liked, {{ $postId }}); liked = !liked; state = !state"
    >
</div>
