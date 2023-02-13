<div class="@if(!$show) hidden @else flex @endif w-full h-full fixed z-50 top-0 left-0 p-10 overflow-y-scroll">
	<div onclick="window.livewire.emit('doCloseModal')"
	     class="cursor-zoom-out w-full h-full fixed top-0 left-0 bg-black bg-opacity-70 backdrop-blur"></div>
	<div id="popup-modal" tabindex="-1" class="m-auto md:inset-0 relative">
		<div class="bg-white rounded-lg shadow dark:bg-gray-700">

			<h3 class="text-center text-xl font-semibold text-gray-900 dark:text-white">
				{{ $title }}
			</h3>

			<button onclick="window.livewire.emit('doCloseModal')" type="button"
			        class="p-1.5 absolute top-0 right-0 text-gray-400 bg-transparent hover:bg-gray-200 hover:text-gray-900 rounded-lg text-sm ml-auto inline-flex items-center dark:hover:bg-gray-800 dark:hover:text-white">
				<svg aria-hidden="true" class="w-5 h-5" fill="currentColor" viewBox="0 0 20 20"
				     xmlns="http://www.w3.org/2000/svg">
					<path fill-rule="evenodd"
					      d="M4.293 4.293a1 1 0 011.414 0L10 8.586l4.293-4.293a1 1 0 111.414 1.414L11.414 10l4.293 4.293a1 1 0 01-1.414 1.414L10 11.414l-4.293 4.293a1 1 0 01-1.414-1.414L8.586 10 4.293 5.707a1 1 0 010-1.414z"
					      clip-rule="evenodd"></path>
				</svg>
				<span class="sr-only">Chiudi</span>
			</button>

			<div class="text-center">
				<a href="{{$path}}" target="_blank"
				   title="Clicca per aprire a dimensioni originali">
					<img class="cursor-zoom-in mx-auto" src="{{ $path }}" loading="lazy"
					     alt="{{$title}}"/>
				</a>
			</div>
		</div>
	</div>
</div>