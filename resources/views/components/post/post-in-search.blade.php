<div class="post_in_search relative z-10
            grid lg:grid-cols-6 lg:grid-rows-3 lg:gap-2
            grid-cols-3 grid-rows-3 gap-1
            rounded-lg p-3 my-3 h-32 w-full text-black bg-green-100
             shadow-md
">
    <div class="row-span-3 col-span-1 lg:col-span-2">
        <img src="{{ $post->preview }}" class="w-full h-full rounded-lg object-cover">
    </div>
    <div class="lg:col-span-4 lg:row-span-2 col-span-2 row-span-2 overflow-hidden">
{{--TODO: закинуть классы в css--}}
        <b class="overflow-ellipsis  pr-3 block max-h-full">
            {{ $post->title }}
        </b>
        <span class="sm:hidden lg:block text-sm align-text-top overflow-hidden">
            Itaque quod dignissimos cumque dignissimos accusamus repudiandae.Itaque quod dignissimos cumque dignissimos accusamus repudiandae.Itaque quod dignissimos cumque dignissimos accusamus repudiandae.
        </span>
    </div>
    <div class="lg:col-span-2 mt-auto sm:text-xs lg:text-sm lg:flex lg:items-baseline space-x-2.5">
        <x-elements.post-views
            class="h-5 text-gray-500 sm:mr-auto lg:mr-2.5 mt-auto ml-1 w-1/2 lg:w-auto"
            views="{{ $post->views }}"
        ></x-elements.post-views>
        <span class=" font-bold text-sm text-gray-500">{{ $post->created_at->format('d.m.Y') }}</span>
    </div>
    <a href="#" class="lg:col-span-1 ml-2 h-5 xl:h-6 text-green-500 mr-auto cursor-pointer mt-auto xl:text-lg text-sm truncate max-w-full">
        {{ ucwords($post->user->nickname) }}
    </a>
    <x-elements.star class="ml-auto absolute top-2 right-2 lg:bottom-2 lg:top-auto"></x-elements.star>
</div>
