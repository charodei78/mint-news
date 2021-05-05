<div x-data="{
                input: '',
                visible: false,
                hide() { dispatchEvent(new Event('blackout-hide')); this.visible = false;},
                show() { dispatchEvent(new Event('blackout-show')); this.visible = true;}
            }"
     class="search-wrapper relative {{ $class ?? '' }}"
        @click.away="hide()"
        x-init="$watch('input', input => input.length > 0 ? show() : hide())"
>
    <img src="/ico/lens.svg" class="absolute my-1.5 mx-1.5">
    {{--    <span class="absolute right-3">&times</span>--}}
    <form @submit.prevent="input.length > 0 ? show() : hide()">
        <input type="search"
                autocomplete="new-password"
                name="password" id="search"
                placeholder="Поиск"
                class="rounded-full border-0 h-7 pl-8 w-full bg-green-900"
                wire:model.debounce.150ms="input" x-model:value="input"
                @focus="show()"
                @reset-search.window="input = ''"
        >
    </form>
@if(strlen($input) > 2)
        <div x-show="visible" class="absolute z-10 mt-10 w-full min-w-96 h-10 result-wrapper">
            @forelse($posts as $post)
                <div class="post-in-search" key="{{$post->id}}" x-on:click="changePage('post', { post_id: {{ $post->id }} });hide();">
                    <img src="{{ url($post->preview) }}" class="w-28 h-full mr-1 rounded-lg object-cover" >
                    <div class="flex flex-col w-2/3">
                        <div class="overflow-hidden">
                            <div class="post-body">
                                <b class="post-title">
                                    {{ $post->title }}
                                </b>
                                {{ $post->synopsis }}
                            </div>
                        </div>
                        <div class="post-footer">
                            <div class="post-info">
                                <x-elements.post-views
                                        class="post-views"
                                        views="{{ $post->views }}"
                                ></x-elements.post-views>
                                <div class="font-bold text-sm text-gray-500">{{ $post->created_at->format('d.m.Y') }}</div>
                            </div>
                            <a href="#" class="post-nickname">
                                {{ ucwords($post->user->nickname) }}
                            </a>
                            <x-elements.star
                                    class="post-star"
                                    :inFavorite="$post->in_favorite"
                                    :post_id="$post->id"
                            ></x-elements.star>
                        </div>
                    </div>
                </div>
            @empty
                <h3 class="text-black bg-green-100 rounded mx-auto py-1 text-center">Ничего не найдено</h3>
            @endforelse
        </div>
    @endif
</div>
