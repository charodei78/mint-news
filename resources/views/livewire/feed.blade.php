<div>
    <span class="text-2xl text-green-100 font-medium block mb-3">{{ strlen($title) ? $title : __('Актуальное') }}</span>
    @foreach($posts as $post)
        <x-post.full-width-post :post="$post"></x-post.full-width-post>
    @endforeach
</div>
