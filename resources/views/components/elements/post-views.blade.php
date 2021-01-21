<div {{ $attributes->merge(['class' => 'items-center flex justify-start space-x-0.5 px-0.5']) }}>
    <img class="h-full" src="/ico/eye.svg">
    <span>
        {{ $views > 1000000
            ? (int)($views/1000000) . 'M'
            : ($views > 1000
            ? (int)($views/1000) . 'k'
            : $views)}}
    </span>
</div>
