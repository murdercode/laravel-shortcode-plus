<div class="p-4 my-4 bg-white border border-gray-300 rounded-lg shadow-lg dark:bg-zinc-950 dark:border-zinc-700" data-product-count="{{ $productCount }}">

    @if ($error)
        <div class="p-4 text-center text-red-800 border border-red-200 rounded dark:text-red-200 dark:border-red-700 bg-red-50 dark:bg-red-900/20">
            <h5 class="mb-2 font-semibold text-red-800 dark:text-red-200">Contenuto non disponibile</h5>
            <p class="mb-3 text-red-800 dark:text-red-200">{{ $errorMessage }}</p>
            <button wire:click="retry" class="px-3 py-1.5 text-sm font-semibold text-blue-600 border border-blue-600 bg-transparent rounded hover:bg-blue-600 hover:text-white transition-colors">
                Riprova
            </button>
        </div>
    @elseif ($widgetData && is_array($widgetData) && count($widgetData) > 0)
        <div class="divide-y divide-gray-200 dark:divide-zinc-700">
            @foreach ($widgetData as $index => $product)
                <div class="{{ $index > 0 ? 'pt-4' : '' }}">
                    @include('laravel-shortcode-plus::livewire.layouts.widgetbay-hero', ['product' => $product])
                </div>
            @endforeach
        </div>
    @else
        <div class="p-4 text-center text-gray-600 border border-gray-200 rounded dark:text-zinc-400 dark:border-zinc-600 bg-gray-50 dark:bg-zinc-700">
            <p class="text-gray-600 dark:text-zinc-400">Widget non disponibile</p>
        </div>
    @endif
</div>
