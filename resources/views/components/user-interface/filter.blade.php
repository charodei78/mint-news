<div x-data="{ isOpen: false }" class="py-3 bg-green-100 rounded-lg flex flex-col w-32 shadow-2xl absolute right-8" x-on:click.away="isOpen = false">
    <button x-on:click="isOpen = !isOpen">
        Фильтр
    </button>
    <div x-show.transition="isOpen" class="text-center" style="display: none">
        <hr class="border-green-500 my-2">
        <ul>
            @foreach($values as $code => $status)
                <li class="hover:bg-green-300 cursor-pointer {{ $value == $code ? 'bg-green-300' : '' }} py-0.5"
                    wire:click="$set('{{ $variable }}', {{ $code }})"
                >
                        {{ $status }}
                </li>
            @endforeach
            @if($search ?? false)
                <li class="mt-2">
                    <div class="relative">
                        <img src="/ico/lens.svg" class="absolute left-2.5 top-1.5">
                        <input class="w-11/12 h-8 pl-6 border-none rounded bg-green-500 text-green-100" type="text"
                               wire:model.debounce.1s="search">
                    </div>
                </li>
            @endif
        </ul>
    </div>
</div>