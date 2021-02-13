<div  class="w-full bg-green-100 rounded py-4 px-8 post-wrapper relative">
    <div class="text-2xl font-bold pr-2">
        {{ $post->title }}
    </div>
    <x-elements.star class="h-7 absolute right-3 top-3"
                        :inFavorite="$post->inFavorite()"
                        :post_id="$post->id"
    ></x-elements.star>
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
    <hr class="w-11/12 ml-auto border-green-500 mt-12 mb-5">
    <div class="ml-auto w-80 flex items-center space-x-2">
        <div class="text-green-500 font-bold">{{ __('Поделиться') }}</div>
        <div class="ya-share2" data-services="vkontakte,twitter,facebook,messenger"></div>
        <x-elements.post-views
                class="h-10 font-medium opacity-40"
                :views="$post->views"
        ></x-elements.post-views>
        <x-elements.like
                :liked="$post->liked()"
                :post_id="$post->id"
        ></x-elements.like>
    </div>
</div>
