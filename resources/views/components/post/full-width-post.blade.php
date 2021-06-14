<div class="post-full-width"
     onmouseup="changePage('post', {itemId: {{ $post->id }}})">
    <div class="post-preview-image">
        <img src="{{ url($post->preview) }}" class="post-preview-image">
    </div>
    <div class="post-body-wrapper">
        <div class="post-body">
            <div class="post-title">{{ $post->title }}</div>
            {{ $post->synopsis }}
        </div>
        <div class="post-footer">
            <span class="font-bold text-gray-500">
                {{ $post->created_at->format('d.m.Y') }}
            </span>
            <a href="#" class="post-nickname">
                {{ ucwords($post->user->nickname) }}
            </a>
            <x-elements.post-views
                class="post-views"
                views="{{ $post->views }}"
            ></x-elements.post-views>
            <x-elements.star
                class="block ml-auto h-5"
                :inFavorite="$post->in_favorite"
                :post_id="$post->id"
            ></x-elements.star>
        </div>
    </div>
</div>