<div class="w-full rounded bg-green-100 py-6 px-10">
    <div class="w-full inline-flex">
        <div class="w-1/5">
            <img class="w-full object-contain rounded-full" src="{{ $user->avatar('md') }}" alt="avatar image">
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
        <div class="flex flex-col space-y-2">
            <div class="flex items-center justify-between w-full">
                <div>{{ __('Старый пароль') }} </div>
                <input type="password" class="settings-input">
            </div>
            <div class="flex items-center justify-between w-full">
                <div>{{ __('Новый пароль') }} </div>
                <input type="password" class="settings-input">
            </div>
            <div class="flex items-center justify-between w-full">
                <div>{{ __('Повтор новгого пароля') }}</div>
                <input type="password" class="settings-input">
            </div>
        </div>
        <a href="#" class="float-right p-2 font-medium">
            {{ __('Забыли пароль?') }}
        </a>
        <button class="send-button ml-auto">
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
