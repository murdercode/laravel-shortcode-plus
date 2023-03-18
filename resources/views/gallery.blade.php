<div class="w-full">
	<div class="grid

	 @if(count($images) == 4)
	 grid-rows-1 grid-cols-4
	 @elseif(count($images) == 3)
	 grid-rows-1 grid-cols-3
	 @elseif(count($images) == 2)
	 grid-rows-1 grid-cols-2
	 @else
	 grid-rows-2 grid-cols-4
	 @endif

	  not-prose sm:px-0">
		@foreach ($images as $image)
			@if ($loop->iteration <= 5)
				<a class="

			@if ($loop->count > 4 && $loop->count != 4 && $loop->iteration == 1) col-span-2 row-span-2 @endif
			@if ($loop->count == 4 && ($loop->iteration == 1 || $loop->iteration == 2 || $loop->iteration == 3 || $loop->iteration == 4)) col-span-1 @endif
			@if ($loop->count == 3 && $loop->iteration == 1) col-span-1 @endif
			@if ($loop->count == 2 && $loop->iteration == 1) col-span-1 @endif

			glightbox hover:brightness-110 relative"
				   href="{{ asset('storage/' . $image['path']) }}"
				   data-glightbox="{{ addslashes($image['title']) }}">
					<img class="

                    @if($loop->count == 2) h-1/2 @else @h-full @endif

                    relative object-cover w-full cursor-pointer"
					     src="{{ asset('storage/' . $image['path']) }}?width=400"
					     alt="{{ $image['alternative_text'] }}"
					     title="Clicca per vedere l'immagine originale"/>
					{{-- Hover Count --}}
					@if ($loop->iteration == 5 && $loop->count > 5)
						<div
								class="absolute inset-0 flex items-center justify-center font-black text-white bg-red-500/50">
							+{{ $loop->count - 5 }}
						</div>
					@endif

				</a>

				{{-- Hidden images --}}
			@else
				<a href="{{ asset('storage/' . $image['path']) }}" class="hidden glightbox"></a>
			@endif
		@endforeach
	</div>
	@if ($title)
		<div class="font-sans text-base bg-gray-200 dark:bg-zinc-800 px-2 py-1.5">
			{{ $title }}
		</div>
	@endif
</div>
