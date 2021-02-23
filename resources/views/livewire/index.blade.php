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
    @if($page === 'post' && $post_id)
        <livewire:post :post_id="$post_id" :key="$post_id"></livewire:post>
    @endif
    @if($page === 'feed' || $page === 'favorite')
        <livewire:feed :favorite="$page === 'favorite'" :key="$page.$category_id" :category_id="$category_id"></livewire:feed>
    @endif
    @if($page === 'settings')
        <livewire:settings-page></livewire:settings-page>
    @endif
    @if($page === 'create-post')
        <livewire:create-post-page></livewire:create-post-page>
    @endif
    @if($page === 'policy')
        {{ view('policy') }}
    @endif
</div>

