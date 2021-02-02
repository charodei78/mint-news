
<div class="post_in_search relative z-10 flex flex-row
            rounded-lg p-3 my-3 h-32 w-full text-black bg-green-100
             shadow-md cursor-pointer
"
     onclick="location.href = '{{ route('posts.show', ['post' => $post->id]) }}'"
>
    <img src="/{{ $post->preview }}" class="w-28 h-full mr-1 rounded-lg object-cover" >
    <div class="flex flex-col w-2/3">
        <div class="overflow-hidden">
            {{--TODO: закинуть классы в css--}}
            <div class="block h-full w-auto text-sm align-text-top overflow-hidden mr-8 xl:mr-0">
                <b class="overflow-ellipsis  pr-3 block max-h-full">
                    {{ $post->title }}
                </b>
                {{ $post->synopsis }}
            </div>
        </div>
        <div class="flex flex-row justify-start mt-auto max-w-full pr-5">
            <div class="mt-auto sm:text-xs lg:text-sm lg:flex lg:items-baseline space-x-2.5">
                <x-elements.post-views
                        class="h-5 text-gray-500 sm:mr-auto lg:mr-2.5 mt-auto ml-1 w-1/2 lg:w-auto"
                        views="{{ $post->views }}"
                ></x-elements.post-views>
                <div class=" font-bold text-sm text-gray-500">{{ $post->created_at->format('d.m.Y') }}</div>
            </div>
            <a href="#" class="ml-2 h-5 xl:h-5 text-green-500 mr-auto cursor-pointer mt-auto xl:text-md text-sm truncate">
                {{ ucwords($post->user->nickname) }}
            </a>
            <x-elements.star
                    class="ml-auto absolute top-2 right-2 lg:bottom-2 lg:top-auto h-6"
                    :inFavorite="$post->inFavorite()"
            ></x-elements.star>
        </div>
    </div>
</div>
