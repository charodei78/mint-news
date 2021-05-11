<div  class="main-wrapper bg-green-100 post-wrapper">
    <div class="text-2xl font-bold pr-2">
        {{ $post->title }}
    </div>
    <x-elements.star class="h-7 absolute right-3 top-12 sm:top-3"
                        :inFavorite="$post->inFavorite"
                        :post_id="$post->id"
    ></x-elements.star>
    <div class="flex space-x-2 my-3">
        <div class="text-green-500">
            {{ ucfirst($post->user->nickname) }}
        </div>
        <div class="font-medium">
            {{ $post->created_at->format('d.m.Y') }}
        </div>
        @can('update', $post)
            <a  class="cursor-pointer"
                x-on:click="changePage('edit-post', { id: {{ $post->id }} })"
            >{{ __('Редактировать') }}</a>
        @endcan
    </div>
    <div>
        <div class="h-96  my-3">
            <img class="post-image rounded object-cover h-full w-full" src="{{ url($post->preview) }}">
        </div>
        <div class="font-medium">
            {{ $post->synopsis }}
        </div>
        <div class="post-body">
            {!! $post->body !!}
        </div>
    </div>
    <hr class="post-hr">
    <div class="ml-auto w-full md:w-80 inline-flex items-center justify-end space-x-2">
        <div class="text-green-500 font-bold">{{ __('Поделиться') }}</div>
        <div class="ya-share2" data-curtain data-limit="0" data-more-button-type="short" data-services="messenger,vkontakte,facebook,odnoklassniki,telegram,twitter"></div>
        <x-elements.like
                class="min-w-10"
                :liked="$post->liked"
                :post_id="$post->id"
        ></x-elements.like>
        <x-elements.post-views
                class="h-10 font-medium opacity-40 hidden sm:flex"
                :views="$post->views"
        ></x-elements.post-views>
{{--        {{ $post-> }}--}}
    </div>
</div>
