<div class="w-full rounded bg-green-100 py-6 px-10" x-data="{}">
    <div class="w-full inline-flex">
        <div class="w-1/4">
            @error('photo')
            <div class="bg-red-500 w-60 p-1 text-white text-center mb-3 rounded" wire:key="$message">
                {{ $message }}
            </div>
            @enderror
            <div class="w-full h-full flex flex-col">
                <input type="file" class="invisible absolute" name="photo" accept="image/png,image/jpg,image/jpeg" x-ref="avatar" wire:model="avatar">
                <div @click="$refs.avatar.click()" class="absolute break-words w-32 text-center opacity-0 top-14 cursor-pointer text-lg hover:opacity-90 m-auto bg-green-100 p-1">
                    {{ __('Изменить фото') }}
                </div>
                <img class="w-32 object-cover h-32 rounded-full"
                     @if($avatar)
                       src="{{ $avatar->temporaryUrl() }}"
                     @endif
                     @if(!$avatar && Auth::user()->avatar)
                       src="{{ Storage::url(Auth::user()->avatar['sm']) }}"
                     @endif
                     alt="avatar image"
                >
                @if($avatar)
                <button wire:click="updateAvatar">{{ __('Сохранить') }}</button>
                @endif
            </div>
        </div>
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
