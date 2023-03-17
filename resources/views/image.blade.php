<div class="relative block">
    <span
        class="block absolute right-0 px-1 py-0.5 text-xs text-gray-600 bg-white not-prose dark:bg-gray-900 dark:text-gray-300 opacity-60">
        {{ $credits }}
    </span>
    <figure>
        <a href="{{ asset('storage/' . $path) }}" class="glightbox" data-glightbox="{{ addslashes($title) }}">
            <img class="mx-auto cursor-pointer" src="{{ asset('storage/' . $path) }}" alt="{{ $alternative_text }}"
                title="Clicca per vedere l'immagine originale" loading="lazy" width="{{ $width }}"
                height="{{ $height }}" />
        </a>
        <figcaption class="bg-gray-200 dark:bg-zinc-800 px-2 py-1.5 font-sans text-base">
            {!! $caption !!}
        </figcaption>
    </figure>
</div>
