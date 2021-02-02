<div {{ $attributes->merge(['class' => 'cursor-pointer w-72 h-24 flex flex-row bg-green-100 rounded my-3' ]) }}
    onclick="location.href = '{{ route('posts.show', ['post' => $post->id]) }}'"
>
        <div class="w-1/3 h-full flex">
            <img class="w-5/6 h-5/6 m-auto rounded object-cover" src="/{{ $post->preview }}">
        </div>
        <div class="w-2/3 p-2 flex flex-col justify-between">
            <div class="w-full pr-3 overflow-ellipsis overflow-hidden h-5/6 text-sm font-semibold">
                {{ $post->title }}
            </div>
            <div class="flex flex-row justify-between">
                <div class="text-xs font-medium">{{ $post->created_at->format('d.m.Y') }}</div>
                <x-elements.post-views class="h-4 text-xs" views="{{ $post->views }}"></x-elements.post-views>
            </div>
        </div>
</div>