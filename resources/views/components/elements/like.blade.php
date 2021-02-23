@php($liked = intval($liked ?? 0))
@auth
<div x-data="{
        liked: {{ $liked ? 'true' : 'false' }},
        state: {{ $liked ? 'true' : 'false' }},
        }"
        {{ $attributes->merge(['class' => 'items-center flex justify-start space-x-0.5 px-0.5']) }}
>
    <img class="max-h-full h-full cursor-pointer object-contain" :src="'/ico/like' + (state ? 'd' : '') + '.svg'"
         @mouseenter="state=!state;"
         @mouseout="state=!state;"
         @click.stop="
         Livewire.emit('likeChange', liked, {{ $postId }});
         liked = !liked; state = !state"
    >
</div>
@endauth
