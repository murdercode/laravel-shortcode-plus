@if($path)

    <div class="relative">

        <figure class="relative !m-0 group">

            @if(isset($credits))
                <span
                    class="block absolute right-0 px-2 py-0.5 text-xs text-gray-600 dark:text-zinc-200 bg-white not-prose dark:bg-gray-900 dark:text-gray-300 opacity-60 z-10">
		            {{ $credits }}
		        </span>
            @endif

            @if($link)
                <a class="stretched-link" target="_blank" href="{!! $link !!}" rel="nofollow norefereer sponsored">
                    @else
                        <a class="glightbox hover:brightness-110 !no-underline"
                           href="{{asset('storage/'.$path)}}">
                            @endif

                            <img
                                class="!my-0 mx-auto object-contain {{$flexGallery ? 'sm:max-h-[500px]' : 'aspect-video'}} @if($shape === 'rounded') rounded-full @endif"
                                src="{{asset('storage/'.$path)}}?width={{ $width }}"
                                sizes="(max-width: 768px) calc(100vw - 32px), (max-width: 1024px) calc(100vw - 64px), 803px"
                                @if($flexGallery)
                                    srcset="
                                        {{ asset('storage/'.$path) }}?height=320 380w,
                                        {{ asset('storage/'.$path) }}?height=405 480w,
                                        {{ asset('storage/'.$path) }}?height=538 640w,
                                        {{ asset('storage/'.$path) }}?height=647 768w,
                                        {{ asset('storage/'.$path) }}?height=662 1024w,
                                        {{ asset('storage/'.$path) }}?height=663 1025w,
                                    "
                                @else
                                    srcset="
                                        {{ asset('storage/'.$path) }}?height=214 380w,
                                        {{ asset('storage/'.$path) }}?height=320 480w,
                                        {{ asset('storage/'.$path) }}?height=333 640w,
                                        {{ asset('storage/'.$path) }}?height=257 768w,
                                        {{ asset('storage/'.$path) }}?height=348 1024w,
                                        {{ asset('storage/'.$path) }}?height=376 1025w,
                                    "
                                @endif
                                alt="{{ $alt }}"
                                title="{{ $title }}" loading="lazy" width="{{ $width }}"
                                height="{{ $height }}"/>
                            @if($didascalia)
                                <figcaption
                                    class="font-sans !text-sm text-gray-700 dark:text-zinc-100 italic !mt-0 pt-1">
                                    {!! html_entity_decode($didascalia) !!}
                                </figcaption>
                            @endif
                        </a>
        </figure>

    </div>

@endif
