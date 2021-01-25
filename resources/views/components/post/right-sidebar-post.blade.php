<div {{ $attributes->merge(['class' => 'w-full h-60 flex flex-row' ]) }}>
    <div class="w-1/3">
        <img class="w-full h-full object-cover" src="https://arte1.ru/images/detailed/4/23608.jpg">
    </div>
    <div class="w-2/3 p-2 flex flex-col justify-between">
        <div class="w-full pr-3 overflow-ellipsis overflow-hidden h-5/6 text-sm">Lorem ipsum dolor sit amet, consectetur adipisicing elit. Assumenda illo inventore magnam modi quo vitae?</div>
        <div class="flex flex-row ">
            <x-elements.post-views></x-elements.post-views>
            <div>01.10.2001</div>
            <div class="text-green-500 font-medium">
                {{ __('Подробнее...') }}
            </div>
        </div>
    </div>
</div>