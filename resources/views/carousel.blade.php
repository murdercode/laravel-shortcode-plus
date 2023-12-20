<section class="splide">
    <div class="splide__track relative">
        <ul class="splide__list">
            @foreach (json_decode($images) as $index => $image)
                <li class="splide__slide">
                    <span class="splide_pag absolute top-0 right-0 bg-white px-2">Immagine {{ $index + 1 }} di {{ $images->count() }}</span>
                    <img src="{{ asset('storage/' . $image->src )}}?width=896"
                         alt="{{ $image->title }}"
                         class="w-full h-full object-cover glightbox"
                         data-glightbox="{{ addslashes('carousel-' . $image->title) }}"
                         loading="lazy"
                         title="Clicca per vedere l'immagine originale
                    ">
                </li>
            @endforeach
        </ul>
    </div>
</section>
