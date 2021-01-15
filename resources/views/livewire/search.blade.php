<div x-data="{input: '', visible: false}" class="search-wrapper relative {{ $class ?? '' }}"
     @click.away="visible = false; blackout.style.display='none'"
>
    <img src="/ico/lens.svg" class="absolute my-1.5 mx-1.5">
    {{--    <span class="absolute right-3">&times</span>--}}
    <input type="search" id="search" placeholder="Поиск" class="rounded-full border-0 h-7 pl-8 w-full bg-green-900"
           wire:model.debounce.150ms="input" x-model:value="input"
           @input.change="blackout.style.display = input.length > 0 ? 'block' : 'none'"
           @focus="visible = true; blackout.style.display='block'"
    >
    @if(!empty($input))
        <div x-show="visible" class="absolute z-10 mt-10 w-inherit h-10">
            @forelse($posts as $post)
                <x-search.post-in-search :post="$post"></x-search.post-in-search>
            @empty
                <h3 class="text-black">Ничего не найдено</h3>
            @endforelse
        </div>
    @endif
</div>
