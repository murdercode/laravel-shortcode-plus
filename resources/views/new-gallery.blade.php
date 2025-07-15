<div class="p-4 bg-gray-100 dark:bg-zinc-800 md:rounded-lg outer">
    <div class="{{ $flexGallery ? 'flex justify-around' : 'grid grid-cols-12 grid-rows-12' }} gap-4 not-prose sm:px-0">
        @foreach ($images as $image)
            @if ($loop->iteration <= $imageToDisplay)
                <a class="!bg-transparent group rounded-lg overflow-hidden
                @if (!$flexGallery) @if (count($images) === 2)
                        col-span-12 md:col-span-6 row-span-6 @endif

                    @if (count($images) === 3) @if ($loop->iteration === 1)
                            col-span-12 md:col-span-8 row-span-4
                        @else
                            col-span-6 md:col-span-4 row-span-2 @endif
                    @endif

                    @if (count($images) === 4) col-span-6 row-span-6 @endif

                    @if (count($images) >= 5) @if ($loop->iteration === 1)
                            col-span-12 md:col-span-6 md:row-span-6
                        @elseif($loop->iteration === 2)
                            col-span-6 row-span-6 md:col-span-6 md:row-span-6
                        @else
                            col-span-6 row-span-6 md:col-span-4 md:row-span-4 @endif

                    @endif

                @endif
		           glightbox hover:brightness-110 relative"
                    href="{{ $image->src }}" data-glightbox="{{ addslashes($image->title) }}">
                    @if ($loop->iteration === 1)
                        <svg xmlns="http://www.w3.org/2000/svg" width="34" height="34" viewBox="0 0 34 34"
                            fill="none"
                            class="absolute z-20 w-10 h-10 transition-all duration-200 top-2 left-2 group-hover:scale-110">
                            <circle cx="17" cy="17" r="16" stroke="white" stroke-width="2" />
                            <g clip-path="url(#clip0_2652_3)">
                                <path
                                    d="M24.0625 20.0781V23.3594C24.0627 23.4518 24.0447 23.5433 24.0095 23.6287C23.9742 23.7141 23.9224 23.7917 23.8571 23.8571C23.7917 23.9224 23.7141 23.9742 23.6287 24.0095C23.5433 24.0447 23.4518 24.0627 23.3594 24.0625H20.0781C19.4515 24.0625 19.138 23.3037 19.5801 22.8613L20.6406 21.8008L17.5 18.6602L14.3585 21.8037L15.4199 22.8613C15.862 23.3037 15.5485 24.0625 14.9219 24.0625H11.6406C11.5482 24.0627 11.4567 24.0447 11.3713 24.0095C11.2859 23.9742 11.2083 23.9224 11.1429 23.8571C11.0776 23.7917 11.0258 23.7141 10.9906 23.6287C10.9553 23.5433 10.9373 23.4518 10.9375 23.3594V20.0781C10.9375 19.4512 11.696 19.1377 12.1387 19.5801L13.1989 20.6406L16.3416 17.5L13.1986 14.3564L12.1387 15.4199C11.6963 15.8623 10.9375 15.5488 10.9375 14.9219V11.6406C10.9373 11.5482 10.9553 11.4567 10.9906 11.3713C11.0258 11.2859 11.0776 11.2083 11.1429 11.1429C11.2083 11.0776 11.2859 11.0258 11.3713 10.9906C11.4567 10.9553 11.5482 10.9373 11.6406 10.9375H14.9219C15.5485 10.9375 15.862 11.6963 15.4199 12.1387L14.3594 13.1992L17.5 16.3398L20.6415 13.1963L19.5801 12.1387C19.138 11.6963 19.4515 10.9375 20.0781 10.9375H23.3594C23.4518 10.9373 23.5433 10.9553 23.6287 10.9906C23.7141 11.0258 23.7917 11.0776 23.8571 11.1429C23.9224 11.2083 23.9742 11.2859 24.0095 11.3713C24.0447 11.4567 24.0627 11.5482 24.0625 11.6406V14.9219C24.0625 15.5488 23.304 15.8623 22.8613 15.4199L21.8011 14.3594L18.6584 17.5L21.8014 20.6436L22.8613 19.583C23.3037 19.1377 24.0625 19.4512 24.0625 20.0781Z"
                                    fill="white" />
                            </g>
                            <defs>
                                <clipPath id="clip0_2652_3">
                                    <rect width="15" height="15" fill="white" transform="translate(10 10)" />
                                </clipPath>
                            </defs>
                        </svg>
                    @endif
                    <img class="{{ $flexGallery ? 'md:max-h-[500px]' : 'aspect-video' }} relative object-cover w-full h-full cursor-pointer"
                        src="{{ $image->src }}?width=1920&aspect_ratio=16:9"
                        @if ($flexGallery) @if (count($images) === 2)
                                srcset="
                                {{ $image->src }}?height=365&aspect_ratio=9:19 380w,
                                {{ $image->src }}?height=475&aspect_ratio=9:19 480w,
                                {{ $image->src }}?height=500&aspect_ratio=9:19 640w,
                                {{ $image->src }}?height=500&aspect_ratio=9:19 768w,
                                {{ $image->src }}?height=500&aspect_ratio=9:19 1024w,
                                {{ $image->src }}?height=500&aspect_ratio=9:19 1025w,
                            "
                        @else
                            srcset="
                                {{ $image->src }}?height=231&aspect_ratio=9:19 380w,
                                {{ $image->src }}?height=305&aspect_ratio=9:19 480w,
                                {{ $image->src }}?height=500&aspect_ratio=9:19 640w,
                                {{ $image->src }}?height=500&aspect_ratio=9:19 768w,
                                {{ $image->src }}?height=500&aspect_ratio=9:19 1024w,
                                {{ $image->src }}?height=500&aspect_ratio=9:19 1025w,
                            " @endif
                    @else
                        @if (count($images) === 2) sizes="(max-width: 768px) calc(100vw - 32px), (max-width: 1024px) calc((100vw - 80px) / 2), 393px"
                                srcset="
                                    {{ $image->src }}?height=146&aspect_ratio=16:9 260w,
                                    {{ $image->src }}?height=186&aspect_ratio=16:9 330w,
                                    {{ $image->src }}?height=221&aspect_ratio=16:9 393w,
                                    {{ $image->src }}?height=265&aspect_ratio=16:9 470w,
                                    {{ $image->src }}?height=298&aspect_ratio=16:9 530w,
                                    {{ $image->src }}?height=371&aspect_ratio=16:9 660w,
                                    {{ $image->src }}?height=443&aspect_ratio=16:9 786w
                                " @endif
                        @if (count($images) === 3) sizes="(max-width: 768px) calc(100vw - 32px), (max-width: 1024px) calc((100vw - 80px) / 1.5), 530"
                        srcset="
                            {{ $image->src }}?height=146&aspect_ratio=16:9 260w,
                            {{ $image->src }}?height=186&aspect_ratio=16:9 330w,
                            {{ $image->src }}?height=221&aspect_ratio=16:9 393w,
                            {{ $image->src }}?height=265&aspect_ratio=16:9 470w,
                            {{ $image->src }}?height=298&aspect_ratio=16:9 530w,
                            {{ $image->src }}?height=371&aspect_ratio=16:9 660w,
                            {{ $image->src }}?height=443&aspect_ratio=16:9 786w,
                            {{ $image->src }}?height=528&aspect_ratio=16:9 940w,
                            {{ $image->src }}?height=596&aspect_ratio=16:9 1060w
                        " @endif
                        @if (count($images) === 4) sizes="(max-width: 768px) calc((100vw - 48px) / 2), (max-width: 1024px) calc((100vw - 80px) / 2), 393"
                        srcset="
                            {{ $image->src }}?height=146&aspect_ratio=16:9 260w,
                            {{ $image->src }}?height=186&aspect_ratio=16:9 330w,
                            {{ $image->src }}?height=221&aspect_ratio=16:9 393w,
                            {{ $image->src }}?height=266&aspect_ratio=16:9 470w,
                            {{ $image->src }}?height=304&aspect_ratio=16:9 540w,
                            {{ $image->src }}?height=371&aspect_ratio=16:9 660w,
                        " @endif
                        @if (count($images) >= 5) sizes="(max-width: 768px) calc(100vw - 48px), (max-width: 1024px) calc((100vw - 80px) / 2), 393px"
                        srcset="
                            {{ $image->src }}?height=146&aspect_ratio=16:9 260w,
                            {{ $image->src }}?height=186&aspect_ratio=16:9 330w,
                            {{ $image->src }}?height=221&aspect_ratio=16:9 393w,
                            {{ $image->src }}?height=266&aspect_ratio=16:9 470w,
                            {{ $image->src }}?height=304&aspect_ratio=16:9 540w,
                            {{ $image->src }}?height=371&aspect_ratio=16:9 660w,
                                " @endif
                        @endif
                    alt="{{ $image->alt }}"
                    title="Clicca per vedere l'immagine originale"
                    width="{{ $flexGallery ? '1080' : '1920' }}" height="{{ $flexGallery ? '1920' : '1080' }}"
                    loading="lazy" decoding="async"/>
                    {{-- Hover Count --}}
                    @if ($loop->iteration == $imageToDisplay && $loop->count > $imageToDisplay)
                        <div
                            class="absolute inset-0 flex items-center justify-center font-black !text-base text-white bg-black/50">
                            +{{ $loop->count - $imageToDisplay }}
                            <svg xmlns="http://www.w3.org/2000/svg" width="55" height="47" viewBox="0 0 55 47"
                                fill="none" class="absolute -translate-x-1/2 -translate-y-1/2 top-1/2 left-1/2">
                                <path
                                    d="M14.352 8.69434C13.8944 9.41848 13.284 10.0338 12.5635 10.497C11.843 10.9602 11.0298 11.2601 10.1811 11.3758C9.21525 11.513 8.25704 11.6605 7.29883 11.8206C4.62246 12.2654 2.71875 14.6215 2.71875 17.3335V38.7495C2.71875 40.2662 3.32126 41.7208 4.39373 42.7933C5.46621 43.8658 6.92079 44.4683 8.4375 44.4683H46.5625C48.0792 44.4683 49.5338 43.8658 50.6063 42.7933C51.6787 41.7208 52.2813 40.2662 52.2813 38.7495V17.3335C52.2813 14.6215 50.375 12.2654 47.7012 11.8206C46.7422 11.6608 45.7814 11.5125 44.8189 11.3758C43.9706 11.2598 43.158 10.9597 42.4379 10.4965C41.7179 10.0333 41.1078 9.41818 40.6506 8.69434L38.5613 5.3495C38.0921 4.58725 37.4461 3.94928 36.6781 3.4896C35.91 3.02992 35.0425 2.76207 34.149 2.70871C29.7195 2.47079 25.2805 2.47079 20.851 2.70871C19.9575 2.76207 19.09 3.02992 18.3219 3.4896C17.5539 3.94928 16.9079 4.58725 16.4387 5.3495L14.352 8.69434Z"
                                    stroke="white" stroke-width="3.5" stroke-linecap="round" stroke-linejoin="round" />
                            </svg>
                        </div>
                    @endif

                </a>

                {{-- Hidden images --}}
            @else
                <a href="{{ $image->src }}" class="hidden glightbox"></a>
            @endif
        @endforeach
    </div>

    @if ($title)
        <div class="mt-4 font-sans text-sm italic text-center text-gray-700 dark:text-zinc-100">
            {!! html_entity_decode($title) !!}
        </div>
    @endif
</div>
