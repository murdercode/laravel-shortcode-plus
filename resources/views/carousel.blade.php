<section class="splide" aria-label="Didascalia">
    <div class="splide__track">
        <ul class="splide__list">
            @foreach (json_decode($images) as $image)
                <li class="splide__slide">
                    <img src="{{ asset('storage/' . $image->src )}}" class="w-full h-full object-cover" loading="lazy">
                </li>
            @endforeach
        </ul>
    </div>
</section>
