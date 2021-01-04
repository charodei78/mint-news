<div class="post_in_search relative z-10
            grid 2xl:grid-cols-6 2xl:grid-rows-3 2xl:gap-2
            grid-cols-3 grid-rows-3 gap-1
            rounded-lg p-3 my-3 h-32 w-full text-black bg-green-100
             shadow-md
">
    <div class="row-span-3 col-span-1">
        <img src="{{ $post->preview }}" class="w-full h-full rounded-lg object-cover">
    </div>
    <div class="2xl:col-span-5 2xl:row-span-2 col-span-2 row-span-2 overflow-hidden">
        <b class="overflow-ellipsis  pr-3 block max-h-full">
            {{ $post->title }}
        </b>
        <span class="sm:hidden 2xl:block text-sm align-text-top overflow-hidden">
            Itaque quod dignissimos cumque dignissimos accusamus repudiandae.Itaque quod dignissimos cumque dignissimos accusamus repudiandae.Itaque quod dignissimos cumque dignissimos accusamus repudiandae.
        </span>
    </div>
    <div class="2xl:col-span-2 my-auto sm:text-xs 2xl:text-lg 2xl:flex 2xl:items-center space-x-2.5">
        <x-post-views
            class="h-5 text-gray-500 sm:mr-auto 2xl:mr-2.5 ml-1 w-1/2 2xl:w-auto"
            views="{{ $post->views }}"
        ></x-post-views>
        <span class=" font-bold text-gray-500">{{ $post->created_at->format('d.m.Y') }}</span>
    </div>
    <a href="#" class="2xl:col-span-3 ml-1.5 text-green-500 mr-auto cursor-pointer mt-auto xl:text-xl text-sm truncate max-w-full">
        {{ ucwords($post->user->nickname) }}
    </a>
    <x-star class="ml-auto absolute top-2 right-2 2xl:bottom-2 2xl:top-auto"></x-star>
</div>
