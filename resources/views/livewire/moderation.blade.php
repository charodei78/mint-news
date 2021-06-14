<div class="main-wrapper">
    <div class="flex">
        <div class="text-green-100 text-2xl pb-0 font-bold pr-2">{{ __('Мои посты') }}</div>
        <x-user-interface.filter variable="filter" :value="$filter" :values="$filter_values"></x-user-interface.filter>
    </div>
    <div class="mt-6">
        @foreach($posts as $post)
            <div class="post-in-list" wire:key="{{ "my-posts".$post->id}}">
                <div class="post-preview-image">
                    <img src="{{ url($post->preview) }}">
                </div>
                <div class="post-body-wrapper">
                    <div class="post-body">
                        <b>
                            {{ $post->title }}
                        </b>
                        <br>
                        <span class="synopsis">
                            {{ $post->synopsis }}
                        </span>
                    </div>
                    <div class="status-label {{ $post::STATUS_COLOR[$post->status] }}">
                        {{ ucfirst($post::POST_STATUS[$post->status]) }}
                    </div>
                    <div class="post-info">
                        <div>
                            <x-elements.post-views class="h-6" :views="$post->views"></x-elements.post-views>
                        </div>
                        <div>
                            {{ $post->created_at->format('d.m.Y') }}
                        </div>
                    </div>
                    <div class="button-group">
                        <button x-on:mouseup="changePage('edit-post', { itemId: {{ $post->id }} })">
                            <img src="/ico/link.svg" alt="view">
                        </button>
                    </div>
                </div>
            </div>
        @endforeach
        {{ $posts->links() }}
    </div>
</div>
