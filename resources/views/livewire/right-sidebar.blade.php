<div class="fixed" x-data="{}">
    <span class="text-2xl text-green-100 font-medium block mb-3">{{ __('Актуальное') }}</span>
    @foreach($posts as $post)
        <div class="right-sidebar-post"
             wire:key="{{ "right-side".$post->id}}"
             x-on:mouseup="changePage('post', { itemId: {{ $post->id }} })"
        >
            <div class="w-1/3 h-full flex">
                <img class="post-image" src="{{ url($post->preview) }}">
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
    @endforeach
</div>
