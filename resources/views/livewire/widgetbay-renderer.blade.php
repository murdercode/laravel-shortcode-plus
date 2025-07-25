<div class="border border-gray-300 rounded-lg p-4 my-4 bg-white shadow-sm widgetbay-layout-{{ $layout }}" data-product-count="{{ $productCount }}">

    @if ($error)
        <div class="text-center p-4 bg-red-50 text-red-800 border border-red-200 rounded">
            <h5 class="font-semibold mb-2">Contenuto non disponibile</h5>
            <p class="mb-3">{{ $errorMessage }}</p>
            <button wire:click="retry" class="px-3 py-1.5 text-sm font-semibold text-blue-600 border border-blue-600 bg-transparent rounded hover:bg-blue-600 hover:text-white transition-colors">
                Riprova
            </button>
        </div>
    @elseif ($widgetData && is_array($widgetData) && count($widgetData) > 0)
        @if ($layout === 'hero')
            @include('laravel-shortcode-plus::livewire.layouts.widgetbay-hero', ['product' => $widgetData[0]])
        @elseif ($layout === 'compact')
            @include('laravel-shortcode-plus::livewire.layouts.widgetbay-compact', ['products' => $widgetData])
        @elseif ($layout === 'vertical')
            @include('laravel-shortcode-plus::livewire.layouts.widgetbay-vertical', ['products' => $widgetData])
        @else
            {{-- Fallback a hero per singolo prodotto o compact per multipli --}}
            @if (count($widgetData) === 1)
                @include('laravel-shortcode-plus::livewire.layouts.widgetbay-hero', ['product' => $widgetData[0]])
            @else
                @include('laravel-shortcode-plus::livewire.layouts.widgetbay-compact', ['products' => $widgetData])
            @endif
        @endif
    @else
        <div class="text-center p-4 bg-gray-50 text-gray-600 border border-gray-200 rounded">
            <p>Widget non disponibile</p>
        </div>
    @endif
</div>
