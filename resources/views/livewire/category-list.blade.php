<div
    class="flex flex-col space-y-1 {{ $class ?? '' }}"
    x-data="{selected: history.state?.category || 0, title: '' }"
    x-init="$watch('selected', value => history.pushState({ category: value }, this.title, '?category=' + selected))"
>
  <div class="bg-green-600 side-menu-button font-extrabold space-x-2 pl-3 text-2xl">
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
  <hr class="opacity-40"><br>
</div>