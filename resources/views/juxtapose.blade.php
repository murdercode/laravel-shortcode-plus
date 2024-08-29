<figure>
    <div class="image-compare">
        @foreach($images as $image)
            <img src="{{ asset('storage/' . $image->src ) }}" alt="{{$image->title}}"/>
        @endforeach
    </div>

    @if ($title)
        <figcaption
            class="!mt-0 font-sans !text-sm py-2 px-4 bg-zinc-200 dark:bg-zinc-800 text-zinc-700 dark:text-zinc-200">
            {!! $title !!}
        </figcaption>
    @endif
</figure>
