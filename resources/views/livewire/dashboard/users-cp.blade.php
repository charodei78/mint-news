<div class="main-wrapper users-control-panel">
    <div class="flex">
        <div class="text-green-100 text-2xl mt-1 font-bold pr-2">{{ __('Пользователи') }}</div>
        <x-user-interface.filter variable="filter" :value="$filter" :values="$filters" search="true"></x-user-interface.filter>
    </div>
    <div class="mt-6 flex flex-row flex-wrap justify-between">
        @foreach($users as $user)
        <div class="user-card" wire:key="user-{{ $user->id }}">
            <div class="w-1/4">
                <img class="w-full rounded h-full object-cover" src="{{ $user->getAvatar('lg') }}">
            </div>
            <div class="w-3/4">
                <div class="h-3/5 ellipsis">{{ $user->name }}</div>
                <div class="flex h-2/5 w-full items-end justify-between">
                    <div class="{{ $user->getRoleColor() }}">{{ $user->getRole() }}</div>
                    <div class="flex items-end justify-between w-14">
                        <button wire:click="deleteUser({{ $user->id }})">
                            <img src="/ico/delete.svg" alt="delete">
                        </button>
                        <button x-on:mouseup="changePage('settings', { itemId: {{ $user->id }} })">
                            <img src="/ico/edit.svg" alt="edit">
                        </button>
                    </div>
                </div>
            </div>
        </div>
        @endforeach
    </div>
    {{ $users->links() }}

</div>
