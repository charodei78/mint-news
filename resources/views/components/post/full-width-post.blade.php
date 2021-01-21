<div {{ $attributes->merge(['class' => 'bg-green-100'])}}>
    <img src="https://arte1.ru/images/detailed/4/23608.jpg" class="post_preview_image">
    <div class="p-3">
        <h3 class="post_preview_title">Lorem ipsum dolor sit amet, consectetur adipisicing elit. Ab assumenda inventore iure ratione!</h3>
        <span class="post_preview_body">Lorem ipsum dolor sit amet, consectetur adipisicing elit. Beatae commodi consequuntur cumque doloremque, ea eius eligendi eum iusto, molestias omnis quo ratione sint tempora, unde velit voluptas voluptate. Est ex fuga illo ipsa itaque molestiae molestias pariatur saepe sequi vero?</span>
        <div class="flex justify-start w-full">

            <span class=" font-bold text-gray-500">10.20.1203</span>
            <a href="#" class="mx-4">Mocki
                {{--        {{ ucwords($post->user->nickname) }}--}}
            </a>
            <x-elements.post-views
                    class="h-5 text-gray-500 w-10 block"
                    views="1000"
            ></x-elements.post-views>
            <x-elements.star class="block ml-auto"></x-elements.star>
        </div>
    </div>

</div>