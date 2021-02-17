@php($liked = intval($liked ?? 0))
<div x-data="{
        count: {{ $liked }},
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
         count += liked ? -1 : 1;
         liked = !liked; state = !state"
    >
    <span x-text="
        count > 1000000
            ? (int)(count/1000000) + 'M'
            : (count > 1000
            ? (int)(count/1000) + 'k'
            : count)
     ">
    </span>
</div>
