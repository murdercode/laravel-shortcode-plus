@if($path)

    <div class="relative p-4 bg-gray-100 dark:bg-zinc-800 md:rounded-lg outer">

        <figure class="relative !m-0 group">
            <svg xmlns="http://www.w3.org/2000/svg" width="34" height="34" viewBox="0 0 34 34" fill="none"
                 class="absolute top-2 left-2 !z-20 w-12 h-12 group-hover:scale-110 transition-all duration-200">
                <circle cx="17" cy="17" r="16" stroke="white" stroke-width="2"/>
                <g clip-path="url(#clip0_2652_3)">
                    <path
                        d="M24.0625 20.0781V23.3594C24.0627 23.4518 24.0447 23.5433 24.0095 23.6287C23.9742 23.7141 23.9224 23.7917 23.8571 23.8571C23.7917 23.9224 23.7141 23.9742 23.6287 24.0095C23.5433 24.0447 23.4518 24.0627 23.3594 24.0625H20.0781C19.4515 24.0625 19.138 23.3037 19.5801 22.8613L20.6406 21.8008L17.5 18.6602L14.3585 21.8037L15.4199 22.8613C15.862 23.3037 15.5485 24.0625 14.9219 24.0625H11.6406C11.5482 24.0627 11.4567 24.0447 11.3713 24.0095C11.2859 23.9742 11.2083 23.9224 11.1429 23.8571C11.0776 23.7917 11.0258 23.7141 10.9906 23.6287C10.9553 23.5433 10.9373 23.4518 10.9375 23.3594V20.0781C10.9375 19.4512 11.696 19.1377 12.1387 19.5801L13.1989 20.6406L16.3416 17.5L13.1986 14.3564L12.1387 15.4199C11.6963 15.8623 10.9375 15.5488 10.9375 14.9219V11.6406C10.9373 11.5482 10.9553 11.4567 10.9906 11.3713C11.0258 11.2859 11.0776 11.2083 11.1429 11.1429C11.2083 11.0776 11.2859 11.0258 11.3713 10.9906C11.4567 10.9553 11.5482 10.9373 11.6406 10.9375H14.9219C15.5485 10.9375 15.862 11.6963 15.4199 12.1387L14.3594 13.1992L17.5 16.3398L20.6415 13.1963L19.5801 12.1387C19.138 11.6963 19.4515 10.9375 20.0781 10.9375H23.3594C23.4518 10.9373 23.5433 10.9553 23.6287 10.9906C23.7141 11.0258 23.7917 11.0776 23.8571 11.1429C23.9224 11.2083 23.9742 11.2859 24.0095 11.3713C24.0447 11.4567 24.0627 11.5482 24.0625 11.6406V14.9219C24.0625 15.5488 23.304 15.8623 22.8613 15.4199L21.8011 14.3594L18.6584 17.5L21.8014 20.6436L22.8613 19.583C23.3037 19.1377 24.0625 19.4512 24.0625 20.0781Z"
                        fill="white"/>
                </g>
                <defs>
                    <clipPath id="clip0_2652_3">
                        <rect width="15" height="15" fill="white" transform="translate(10 10)"/>
                    </clipPath>
                </defs>
            </svg>

            @if(isset($credits))
                <span
                    class="block absolute rounded-bl-lg right-0 px-2 py-0.5 text-xs text-gray-600 dark:text-zinc-200 bg-white not-prose dark:bg-gray-900 dark:text-gray-300 opacity-60 z-10">
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
                                class="!my-0 mx-auto {{$flexGallery ? 'sm:max-h-[500px] object-contain' : 'aspect-video'}} @if($shape === 'rounded') rounded-full @else rounded-lg @endif"
                                src="{{asset('storage/'.$path)}}?width={{ $width }}"
                                sizes="(max-width: 768px) calc(100vw - 32px), (max-width: 1024px) calc(100vw - 64px), 803px"
                                @if($flexGallery)
                                    srcset="
                                        {{ asset('storage/'.$path) }}?height=320&aspect_ratio=9:16 380w,
                                        {{ asset('storage/'.$path) }}?height=405&aspect_ratio=9:16 480w,
                                        {{ asset('storage/'.$path) }}?height=538&aspect_ratio=9:16 640w,
                                        {{ asset('storage/'.$path) }}?height=647&aspect_ratio=9:16 768w,
                                        {{ asset('storage/'.$path) }}?height=662&aspect_ratio=9:16 1024w,
                                        {{ asset('storage/'.$path) }}?height=663&aspect_ratio=9:16 1025w,
                                    "
                                @else
                                    srcset="
                                        {{ asset('storage/'.$path) }}?height=214&aspect_ratio=16:9 380w,
                                        {{ asset('storage/'.$path) }}?height=320&aspect_ratio=16:9 480w,
                                        {{ asset('storage/'.$path) }}?height=333&aspect_ratio=16:9 640w,
                                        {{ asset('storage/'.$path) }}?height=257&aspect_ratio=16:9 768w,
                                        {{ asset('storage/'.$path) }}?height=348&aspect_ratio=16:9 1024w,
                                        {{ asset('storage/'.$path) }}?height=376&aspect_ratio=16:9 1025w,
                                    "
                                @endif
                                alt="{{ $alt }}"
                                title="{{ $title }}" loading="lazy" width="{{ $width }}"
                                height="{{ $height }}"/>
                            @if($didascalia)
                                <figcaption
                                    class="font-sans !text-sm text-center text-gray-700 dark:text-zinc-100 italic mt-4">
                                    {!! html_entity_decode($didascalia) !!}
                                </figcaption>
                            @endif
                        </a>
        </figure>

    </div>

@endif
