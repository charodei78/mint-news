<div>
  @if($page === 'post' && $post_id)
    <livewire:post :post_id="$post_id" :key="$post_id"></livewire:post>
  @endif
  @if($page === 'feed')
    <livewire:feed></livewire:feed>
  @endif
</div>

