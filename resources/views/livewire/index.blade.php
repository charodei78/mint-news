<div>
  @if($page === 'post' && $post_id)
    <livewire:post :post_id="$post_id" :key="$post_id"></livewire:post>
  @endif
  @if($page === 'feed')
    <livewire:feed :category_id="$category_id"></livewire:feed>
  @endif
</div>

