<div class="relative block">
    <span
        class="block absolute right-0 px-1 py-0.5 text-xs text-gray-600 bg-white not-prose dark:bg-gray-900 dark:text-gray-300 opacity-60">
        {{ $credits }}
    </span>
    <figure>
        <img @if($enable_modal) onclick="window.livewire.emit('showImageModal', '{{ asset('storage/' . $path) }}', '{{ addslashes($title) }}')" @endif 
        class="mx-auto cursor-pointer" src="{{ asset('storage/' . $path) }}" alt="{{ $alternative_text }}"
            title="Clicca per vedere l'immagine originale" loading="lazy" width="{{ $width }}" height="{{ $height }}" />
        <figcaption>{!! $caption !!}</figcaption>
    </figure>
</div>
