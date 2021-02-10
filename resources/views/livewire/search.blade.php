<div x-data="{input: '', visible: false}" class="search-wrapper relative {{ $class ?? '' }}"
     @click.away="visible==true && $dispatch('blackout-hide');visible = false;"
     x-init="$watch('input', input => input.length > 0 ? $dispatch('blackout-show') : $dispatch('blackout-hide'))"
>
    <img src="/ico/lens.svg" class="absolute my-1.5 mx-1.5">
    {{--    <span class="absolute right-3">&times</span>--}}
    <form @submit.prevent="input.length > 0 ? $dispatch('blackout-show') : $dispatch('blackout-hide')">
        <input type="search"
               autocomplete="new-password"
               name="password" id="search"
               placeholder="Поиск"
               class="rounded-full border-0 h-7 pl-8 w-full bg-green-900"
               wire:model.debounce.150ms="input" x-model:value="input"
               @focus="visible = true; $dispatch('blackout-show')"
               @reset-search.window="input = ''"
        >
    </form>
@if(!empty($input))
        <div x-show="visible" class="absolute z-10 mt-10 w-full min-w-96 h-10 result-wrapper">
            @forelse($posts as $post)
                <x-post.post-in-search :post="$post"></x-post.post-in-search>
            @empty
                <h3 class="text-black bg-green-100 rounded mx-auto py-1 text-center">Ничего не найдено</h3>
            @endforelse
        </div>
    @endif
</div>
