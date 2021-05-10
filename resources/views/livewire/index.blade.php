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
    @if($pageType === 'post' && $ID)
        @livewire('post', ['postId' => $ID], key($pageType.$ID))
    @endif
    @if($pageType === 'feed' || $pageType === 'favorite')
        @livewire('feed', ['favorite' => $pageType === 'favorite', 'categoryId' => $ID], key($pageType.$ID))
    @endif
    @if($pageType === 'settings')
        @livewire('settings-page', [$ID], key($pageType))
    @endif
    @if($pageType === 'edit-post')
        <livewire:edit-post-page :post_id="$ID" :key="$pageType.$ID"></livewire:edit-post-page>
    @endif
    @if($pageType === 'my-posts')
        <livewire:my-posts :key="$pageType"></livewire:my-posts>
    @endif
    @if($pageType === 'policy')
        {{ view('policy') }}
    @endif
</div>

