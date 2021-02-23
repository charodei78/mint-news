<div class="px-2 sm:px-0">
    <span class="text-2xl text-green-100 font-medium block mb-3">
        {{ strlen($title) ? $title : __('Лента') }}
    </span>
    @foreach($posts as $post)
        <x-post.full-width-post :post="$post" :key="$post->id"></x-post.full-width-post>
    @endforeach
    <div>
        {{ $posts->links() }}
    </div>
</div>
