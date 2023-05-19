@if($path)

    <div class="relative block">
        @if(isset($credits))
            <span
                class="block absolute right-0 px-1 py-0.5 text-xs text-gray-600 bg-white not-prose dark:bg-gray-900 dark:text-gray-300 opacity-60">
		        {{ $credits }}
		    </span>
        @endif

        <figure class="relative" @if($align) style="float: {{$align}}" @endif>

            @if($link)
                <a class="stretched-link" href="{!! $link !!}" rel="nofollow norefereer sponsored">
                    @else
                        <a class="stretched-link glightbox hover:brightness-110 !no-underline"
                           href="{{asset('storage/'.$path)}}">
                            @endif

                            <img class="!my-0 mx-auto"
                                 src="{{asset('storage/'.$path)}}?width={{ $width }}"
                                 alt="{{ $alt }}"
                                 title="{{ $title }}" loading="lazy" width="{{ $width }}"
                                 height="{{ $height }}"/>
                            @if($didascalia)
                                <figcaption
                                    class="!mt-0 font-sans !text-sm py-2 px-4 bg-zinc-200 dark:bg-zinc-800 text-zinc-700 dark:text-zinc-200">
                                    {{$didascalia }}
                                </figcaption>
                            @endif
                        </a>
        </figure>

    </div>

@endif
