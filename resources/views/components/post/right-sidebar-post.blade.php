<div {{ $attributes->merge(['class' => 'w-72 h-24 flex flex-row bg-green-100 rounded my-3' ]) }}>
    <div class="w-1/3 h-full flex">
        <img class="w-5/6 h-5/6 m-auto rounded object-cover" src="https://arte1.ru/images/detailed/4/23608.jpg">
    </div>
    <div class="w-2/3 p-2 flex flex-col justify-between">
        <div class="w-full pr-3 overflow-ellipsis overflow-hidden h-5/6 text-sm font-semibold">Lorem ipsum dolor sit amet, consectetur adipisicing elit. Assumenda illo inventore magnam modi quo vitae?</div>
        <div class="flex flex-row justify-between">
            <div class="text-xs font-medium">01.10.20</div>
            <x-elements.post-views class="h-4 text-xs" views="100000"></x-elements.post-views>
            <a href="#" class="text-green-500 text-xs font-medium">
                {{ __('Подробнее') }}
            </a>
        </div>
    </div>
</div>