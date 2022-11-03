<div class="relative block">
    <span
        class="block absolute right-0 px-1 py-0.5 text-xs text-gray-600 bg-white not-prose dark:bg-gray-900 dark:text-gray-300 opacity-60">
        {{ $credits }}
    </span>
    <figure>
        <img class="mx-auto" src="{{ asset('storage/' . $path) }}" alt="{{ $alternative_text }}"
            title="{{ $title }}" loading="lazy" width="{{ $width }}" height="{{ $height }}" />
        <figcaption>{!! $caption !!}</figcaption>
    </figure>
</div>
