{{--<script src="--}}
{{--https://cdn.jsdelivr.net/npm/@splidejs/splide@4.1.4/dist/js/splide.min.js--}}
{{--"></script>--}}

<section class="splide" aria-label="Splide Basic HTML Example">
    <div class="splide__track">
        <ul class="splide__list">
            @foreach (json_decode($images) as $image)
                <li class="splide__slide">
                    <img src="{{ asset('storage/' . $image->src )}}" class="w-full h-full object-cover">
                </li>
            @endforeach
        </ul>
    </div>
</section>

{{--<script>--}}
{{--    let splide = new Splide( '.splide', {--}}
{{--        type   : 'loop',--}}
{{--        padding: '5rem',--}}
{{--    } );--}}

{{--    splide.mount();--}}
{{--</script>--}}
