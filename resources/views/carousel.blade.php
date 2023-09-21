<section class="splide">
    <div class="splide__track">
        <ul class="splide__list">
            @foreach (json_decode($images) as $image)
                <li class="splide__slide">
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
