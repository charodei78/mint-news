<div class="post-full-width">
    <a href="#">
        <img src="{{ $post->preview }}" class="post-preview-image">
        <div class="p-3 pb-2 flex flex-col justify-between">
            <div class="post-body">
                <div class="font-bold text-sm sm:text-lg">{{ $post->title }}</div>
                {{ $post->synopsis }}
            </div>
            <div class="flex justify-start w-full text-sm sm:text-base mt-1">
                <span class=" font-bold text-gray-500">{{ $post->created_at->format('d.m.Y') }}</span>
                <a href="#" class="mx-2 sm:mx-4 text-green-500 font-medium">
                    {{ ucwords($post->user->nickname) }}
                </a>
                <x-elements.post-views
                    class="h-5 text-gray-500 w-10 block"
                    views="{{ $post->views }}"
                ></x-elements.post-views>
                <x-elements.star
                    class="block ml-auto h-5"
                    :inFavorite="$post->inFavorite()"
                ></x-elements.star>
            </div>
        </div>
    </a>
</div>