<div {{ $attributes->merge(['class' => 'right-sidebar-post' ]) }}
    onclick="history.pushState({ post: {{ $post->id }} }, '{{ $post->title }}', '?post={{ $post->id }}') ;
              Livewire.emit('loadPost', {{ $post->id }})"
>
        <div class="w-1/3 h-full flex">
            <img class="post-image" src="/{{ $post->preview }}">
        </div>
        <div class="post-body">
            <div class="post-title">
                {{ $post->title }}
            </div>
            <div class="post-info">
                <div class="text-xs font-medium">{{ $post->created_at->format('d.m.Y') }}</div>
                <x-elements.post-views class="h-4 text-xs" views="{{ $post->views }}"></x-elements.post-views>
            </div>
        </div>
</div>