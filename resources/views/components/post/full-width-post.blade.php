<div {{ $attributes->merge(['class' => 'post-full-width'])}}>
    <a href="#">
        <img src="https://arte1.ru/images/detailed/4/23608.jpg" class="post-preview-image">
        <div class="p-3 flex flex-col justify-between">
            <div class="post-body">
                <div class="font-bold text-sm sm:text-lg">Lorem ipsum dolor sit amet, consectetur adipisicing elit. Ab assumenda inventore iure ratione!</div>
                Lorem ipsum dolor sit amet, consectetur adipisicing elit. Beatae commodi consequuntur cumque doloremque, ea eius eligendi eum iusto, molestias omnis quo ratione sint tempora, unde velit voluptas voluptate. Est ex fuga illo ipsa itaque molestiae molestias pariatur saepe sequi vero?
            </div>
            <div class="flex justify-start w-full text-sm sm:text-base">
                <span class=" font-bold text-gray-500">10.20.1203</span>
                <a href="#" class="mx-2 sm:mx-4 text-green-500 font-medium">Mocki
                    {{--        {{ ucwords($post->user->nickname) }}--}}
                </a>
                <x-elements.post-views
                        class="h-5 text-gray-500 w-10 block"
                        views="1000"
                ></x-elements.post-views>
                <x-elements.star class="block ml-auto"></x-elements.star>
            </div>
        </div>
    </a>
</div>