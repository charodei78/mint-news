<div x-data="{input: ''}" class="search-wrapper {{ $class ?? '' }}">
    <img src="/ico/lens.svg" class="absolute my-1.5 mx-1.5">
    <input type="text" id="search" placeholder="Поиск" class="rounded-full  border-0 h-7 pl-8 w-full"
           wire:model.debounce.150ms="input" x-model:value="input"
           @keyup="blackout.style.display = input.length > 0 ? 'block' : 'none'">
    @if(!empty($input))
        <div class="absolute z-10 mt-10 w-inherit h-10">
            @forelse($posts as $post)
                <x-post-in-search :post="$post"></x-post-in-search>
            @empty
                <h3 class="text-black">Ничего не найдено</h3>
            @endforelse
        </div>
    @endif
</div>
