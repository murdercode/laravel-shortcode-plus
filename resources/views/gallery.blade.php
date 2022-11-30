<span>
    <span class="flex max-w-2xl gap-4 overflow-auto not-prose sm:px-0 snap-x snap-mandatory">
        @foreach ($images as $image)
       <span class="w-48 rounded-lg snap-center shrink-0 focus:ring-2 ring-red-500">
            <img onclick="window.livewire.emit('showImageModal','{{ asset('storage/' . $image['path']) }}', '{{ $image['title'] }}')" class="cursor-pointer relative object-cover w-full h-full rounded-lg" src="{{ asset('storage/' . $image["path"]) }}"
            alt="{{ $image["alternative_text"] }}" title="Clicca per vedere l'immagine originale" /></span>
        @endforeach
    </span>
    <span class="font-sans text-base">
        <span class="text-sm font-bold text-red-500 uppercase">
            Gallery: </span>{{ $title }}
        </span>
    </span>
</span>