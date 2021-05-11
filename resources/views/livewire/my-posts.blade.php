<div class="main-wrapper">
    @foreach($posts as $post)
        <div class="w-full flex h-40 justify-between space-x-2 rounded-md bg-green-100 mb-4 p-3" wire:key="{{ "my-posts".$post->id}}">
            <div class="h-full w-44">
                <img class="h-full w-full rounded object-cover" src="{{ url($post->preview) }}">
            </div>
            <div class="flex flex-col w-full">
                <div class="flex">
                    <div class="h-24 w-full ellipsis mb-2">
                        <b>
                            {{ $post->title }}
                        </b>
                        <br>
                        <span class="h-content w-full ellipsis paragraph">
                            {{ $post->synopsis }}
                        </span>
                    </div>
                    <div class="ml-auto w-1/4 text-right {{ $post::STATUS_COLOR[$post->status] }}">
                        {{ ucfirst($post::POST_STATUS[$post->status]) }}
                    </div>
                </div>
                <div class="mt-auto h-10">
                    <div class="flex space-x-2 w-content ml-auto cursor-pointer">
                        <a class="text-red-500" wire:click="deletePost({{ $post->id }})">
                            {{ __('Удалить') }}
                        </a>
                        <a class="text-blue-500" x-on:mouseup="changePage('edit-post', { id: {{ $post->id }} })">
                            {{ __('Редактировать') }}
                        </a>
                        <a class="text-green-500" x-on:mouseup="changePage('post', { id: {{ $post->id }} })">
                            {{ __('Посмотреть') }}
                        </a>
                    </div>
                </div>
            </div>
        </div>
    @endforeach
    {{ $posts->links() }}
</div>
