<div class="relative" x-data="{
                            letterIndex: 0,
                            letters: ['M', 'I', 'N', 'T'],
                        }"
     x-init="() => {setInterval(() => { letterIndex++ }, 900) }"
>
    <div class="w-full z-20 h-full absolute bg-black bg-opacity-20 hidden rounded" id="preloader">
        <div class="animate-ping text-green-100 rounded-full w-10 h-10 m-auto mt-52 text-center mint-font text-2xl"
            x-text="letters[letterIndex % 4]"
        >
            M
        </div>
    </div>
    @php($key = $pageType.$itemId.request()->get('page'))
    @if($pageType === 'post' && $itemId)
        @livewire('post', ['postId' => $itemId], key($key))
    @endif
    @if($pageType === 'feed' || $pageType === 'favorite')
        @livewire('feed', ['favorite' => $pageType === 'favorite', 'categoryId' => $itemId], key($key))
    @endif
    @if($pageType === 'settings')
        @livewire('settings-page', [$itemId], key($key))
    @endif
    @if($pageType === 'edit-post')
        @livewire('edit-post-page', [$itemId], key($key))
    @endif
    @if($pageType === 'my-posts')
        @livewire('my-posts', key($key))
    @endif
    @if($pageType === 'moderation')
        @livewire('moderation', key($key))
    @endif
    @if($pageType === 'users')
        @livewire('users-c-p', key($key))
    @endif
    @if($pageType === 'policy')
        {{ view('policy') }}
    @endif
</div>

