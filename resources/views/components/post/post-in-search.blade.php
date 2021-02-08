
<div class="post-in-search"
     onclick="history.pushState({ post: {{ $post->id }} }, '{{ $post->title }}', '?post={{ $post->id }}') ;
                Livewire.emit('loadPost', {{ $post->id }})"
>
    <img src="/{{ $post->preview }}" class="w-28 h-full mr-1 rounded-lg object-cover" >
    <div class="flex flex-col w-2/3">
        <div class="overflow-hidden">
            <div class="post-body">
                <b class="post-title">
                    {{ $post->title }}
                </b>
                {{ $post->synopsis }}
            </div>
        </div>
        <div class="post-footer">
            <div class="post-info">
                <x-elements.post-views
                        class="post-views"
                        views="{{ $post->views }}"
                ></x-elements.post-views>
                <div class="font-bold text-sm text-gray-500">{{ $post->created_at->format('d.m.Y') }}</div>
            </div>
            <a href="#" class="post-nickname">
                {{ ucwords($post->user->nickname) }}
            </a>
            <x-elements.star
                    class="post-star"
                    :inFavorite="$post->inFavorite()"
            ></x-elements.star>
        </div>
    </div>
</div>
