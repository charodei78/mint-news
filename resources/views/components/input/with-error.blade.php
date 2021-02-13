<div class="{{ $class ?? '' }}">
    <x-elements.error-message x-show="error.{{ $name }}"
                              x-text="error.{{ $name }}"
    ></x-elements.error-message>
    <input type="{{ $type ?? 'text' }}" :class="{'border-red-300' : error.{{ $name }} }" class="form-input" {{ $attributes->except(['class', 'type']) }}>
</div>