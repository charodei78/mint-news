<div class="search-wrapper {{ $class }}">
    <img src="/ico/lens.svg" class="absolute my-1.5 mx-1.5">
    <input type="text" id="search" placeholder="Поиск" class="rounded-full  border-0 h-7 pl-8 w-full" wire:model.debounce.100ms="input">
{{--    <div class="absolute mt-10 w-full h-10 bg-">--}}
{{--        <div>--}}

{{--        </div>--}}
{{--    </div>--}}
</div>
