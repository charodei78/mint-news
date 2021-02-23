<div class="w-full rounded bg-green-100 py-6 px-10" x-data="">
    <div class="w-full inline-flex">
        <form wire:submit.prevent="updateAvatar" action="" type="multipart" method="POST" enctype="multipart/form-data">
            @csrf
            @error('photo')
            <div class="bg-red-500 w-60 p-1 text-white text-center mb-3 rounded" wire:key="$message">
                {{ $message }}
            </div>
            @enderror
            <div class="w-1/5" @click="$refs.avatar.click()">
                <div class="absolute break-words w-21 text-center opacity-0 hover:opacity-90 m-auto bg-green-100 p-1">Изменить<br>фото</div>
                <input type="file" name="photo" accept="image/*" x-ref="avatar" wire:model="photo">
                {{ $photo }}
                <img class="w-full object-contain rounded-full"
                     src="{{ $photo && $photo->temporaryUrl() }}"
                     alt="avatar image"
                >
            </div>
            <button>Обновить</button>
        </form>
        <div>
            <div class="text-xl font-medium">
                {{ $user->name }}
            </div>
            <div class="text-lg">
                {{ $user->nickname }}
            </div>
        </div>
    </div>
    <div class="w-full mb-7">
        <div class="text-2xl font-medium mb-4">
            {{ __('Сменить пароль') }}
        </div>
        @if (session()->has('message'))
            <div class="bg-green-600 w-60 p-1 text-white text-center mb-3 rounded" wire:key="$message">
                {{ session('message') }}
            </div>
        @endif
        @error('password')
        <div class="bg-red-500 w-60 p-1 text-white text-center mb-3 rounded" wire:key="$message">
            {{ $message }}
        </div>
        @enderror
        <div class="flex flex-col space-y-2">
            <div class="flex items-center justify-between w-full">
                <div>{{ __('Старый пароль') }} </div>
                <input type="password" class="settings-input" wire:model.defer="oldPassword">
            </div>
            <div class="flex items-center justify-between w-full">
                <div>{{ __('Новый пароль') }} </div>
                <input type="password" class="settings-input" wire:model.defer="password">
            </div>
            <div class="flex items-center justify-between w-full">
                <div>{{ __('Повтор новгого пароля') }}</div>
                <input type="password" class="settings-input" wire:model.defer="passwordConfirmation">
            </div>
        </div>
        <a href="#" class="float-right p-2 font-medium">
            {{ __('Забыли пароль?') }}
        </a>
        <button class="send-button ml-auto" wire:click="changePassword()">
            {{ __('Изменить') }}
        </button>
    </div>
    <div>
        <div class="text-2xl font-medium">
            {{ __('Уведомления') }}
        </div>
        <div class="flex flex-col">
            <div class="flex w-3/5 justify-between">
                <div>{{ __('Ответы на коментарии') }}</div>
                <input type="checkbox" class="rounded">
            </div>
            <div class="flex w-3/5 justify-between">
                <div>{{ __('Новые статьи') }}</div>
                <input type="checkbox" class="rounded">
            </div>
        </div>
    </div>
    <div>
        <div class="text-2xl font-medium">
            {{ __('Интересы') }}
        </div>
        <div>
            @forelse($categories as $category)
                <div class="flex w-1/2 justify-between">
                    <div>
                        {{ $category->name }}
                    </div>
                    <div>
                        {{ $category->count }}
                    </div>
                </div>
            @empty
                Список пуст. Отмечайте интересующие вас посты, чтобы улучшить рекомендации
            @endforelse
        </div>
    </div>
</div>
