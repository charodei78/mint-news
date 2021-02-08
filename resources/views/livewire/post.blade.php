<div class="w-full bg-green-100 rounded py-4 px-8 post-wrapper relative">
  <div class="text-2xl font-bold pr-2">
    {{ $post->title }}
  </div>
  <x-elements.star class="h-7 absolute right-3 top-3" :inFavorite="$post->inFavorite()"></x-elements.star>
  <div class="flex space-x-2 my-3">
    <div class="text-green-500">
      {{ ucfirst($post->user->nickname) }}
    </div>
    <div class="font-medium">
      {{ $post->created_at->format('d.m.Y') }}
    </div>
  </div>
  <div>
    <div class="h-96  my-3">
      <img class="post-image rounded object-cover h-full w-full" src="/{{ $post->preview }}">
    </div>
    {!! $post->body !!}
  </div>
</div>
