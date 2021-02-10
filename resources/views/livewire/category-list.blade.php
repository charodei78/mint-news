<div
        class="flex flex-col space-y-1 {{ $class ?? '' }}"
        x-data="{
            selected: history.state?.category || 0,
            title: '',
            sendRequest(value) {
              history.pushState({ category: value }, this.title, '?category=' + value);
              Livewire.emit('changeCategory', value);
            }
        }"
        x-init="$watch('selected', sendRequest )"
>
    <div class="bg-green-600 side-menu-button font-extrabold space-x-2 pl-3 text-2xl"
         @click="title = 'feed'; selected = 0; sendRequest(0)"
    >
        <img src="/ico/feed.svg">
        <span>
        {{ __('Лента') }}
    </span>
    </div>
    <hr class="opacity-40 border-1 rounded">
    @foreach($categories as $category)
        <div
                :class="{
          'bg-green-600': selected == {{ $category->id }},
          'hover:bg-green-600 hover:bg-opacity-50': selected != {{ $category->id }}
                        }"
                :key="{{ $category->id }}"
                class="side-menu-button"
                @click="title = '{{ $category->name }}'; selected = {{ $category->id }}"
        >
            <img src="/ico/star.svg">
            <span>
          {{ $category->name }}
      </span>
        </div>
    @endforeach
    <hr class="opacity-40">
    <br>
</div>