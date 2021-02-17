<div class="fixed">
    <span class="text-2xl text-green-100 font-medium block mb-3">{{ __('Актуальное') }}</span>
    @foreach($posts as $post)
        <x-post.right-sidebar-post :post="$post"></x-post.right-sidebar-post>
    @endforeach
</div>
