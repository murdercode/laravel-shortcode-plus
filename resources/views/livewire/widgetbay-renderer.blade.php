<div class="relative p-4 my-4 bg-white border border-gray-300 rounded-lg shadow-lg dark:bg-zinc-950 dark:border-zinc-700" data-product-count="{{ $productCount }}">

    @if ($error)
        <div class="p-4 text-center text-red-800 border border-red-200 rounded dark:text-red-200 dark:border-red-700 bg-red-50 dark:bg-red-900/20">
            <h5 class="mb-2 font-semibold text-red-800 dark:text-red-200">Contenuto non disponibile</h5>
            <p class="mb-3 text-red-800 dark:text-red-200">{{ $errorMessage }}</p>
            <button wire:click="retry" class="px-3 py-1.5 text-sm font-semibold text-blue-600 border border-blue-600 bg-transparent rounded hover:bg-blue-600 hover:text-white transition-colors">
                Riprova
            </button>
        </div>
    @elseif ($widgetData && is_array($widgetData) && count($widgetData) > 0)
        @if (count($widgetData) === 1)
            @include('laravel-shortcode-plus::livewire.layouts.widgetbay-hero', ['product' => $widgetData[0]])
        @else
            <div class="divide-y divide-gray-200 dark:divide-zinc-700">
                @foreach ($widgetData as $product)
                    <div class="{{ !$loop->first ? 'pt-4' : '' }}">
                        @include('laravel-shortcode-plus::livewire.layouts.widgetbay-hero-compact', ['product' => $product])
                    </div>
                @endforeach
            </div>
        @endif
    @elseif ($loaded && $availableProductCount === 0 && $productCount > 0)
        {{-- Mostra messaggio quando ci sono prodotti ma nessuno è disponibile --}}
        <div class="p-6 text-center border rounded-lg text-amber-800 border-amber-200 dark:text-amber-200 dark:border-amber-700 bg-amber-50 dark:bg-amber-900/20">
            <div class="mb-3">
                <svg class="w-12 h-12 mx-auto text-amber-600 dark:text-amber-400" fill="none" stroke="currentColor" viewBox="0 0 24 24">
                    <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M12 9v2m0 4h.01m-6.938 4h13.856c1.54 0 2.502-1.667 1.732-2.5L13.732 4c-.77-.833-1.732-.833-2.5 0L4.314 18.5c-.77.833.192 2.5 1.732 2.5z"></path>
                </svg>
            </div>
            <h5 class="mb-2 font-semibold text-amber-800 dark:text-amber-200">{{ $productCount === 1 ? 'Prodotto non disponibile' : 'Prodotti non disponibili' }}</h5>
            <p class="mb-3 text-sm text-amber-700 dark:text-amber-300">{{ $productCount === 1 ? 'Il prodotto selezionato' : 'I prodotti selezionati' }} al momento non {{ $productCount === 1 ? 'è disponibile' : 'sono disponibili' }}. Riprova più tardi.</p>
            <button wire:click="retry" class="px-4 py-2 text-sm font-semibold transition-colors bg-transparent border rounded-md text-amber-800 border-amber-600 hover:bg-amber-600 hover:text-white dark:text-amber-200 dark:border-amber-400 dark:hover:bg-amber-600">
                <svg class="inline w-4 h-4 mr-1" fill="none" stroke="currentColor" viewBox="0 0 24 24">
                    <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M4 4v5h.582m15.356 2A8.001 8.001 0 004.582 9m0 0H9m11 11v-5h-.581m0 0a8.003 8.003 0 01-15.357-2m15.357 2H15"></path>
                </svg>
                Riprova
            </button>
        </div>
    @else
        <div class="p-4 text-center text-gray-600 border border-gray-200 rounded dark:text-zinc-400 dark:border-zinc-600 bg-gray-50 dark:bg-zinc-700">
            <p class="text-gray-600 dark:text-zinc-400">Prodotto al momento non disponibile</p>
        </div>
    @endif

    @if (config('shortcode-plus.widgetbay.debug'))
        @php
            $heights = [
                'mobile' => $this->calculateResponsivePlaceholderHeight()['mobile'] ?? 0,
                'tablet' => $this->calculateResponsivePlaceholderHeight()['tablet'] ?? 0,
                'desktop' => $this->calculateResponsivePlaceholderHeight()['desktop'] ?? 0,
            ];
        @endphp
        <div x-data="{
            currentHeight: {{ $heights['mobile'] }},
            currentDevice: 'mobile',
            updateHeight() {
                if (window.innerWidth >= 768) {
                    this.currentDevice = 'desktop';
                    this.currentHeight = {{ $heights['desktop'] }};
                } else if (window.innerWidth >= 405) {
                    this.currentDevice = 'tablet';
                    this.currentHeight = {{ $heights['tablet'] }};
                } else {
                    this.currentDevice = 'mobile';
                    this.currentHeight = {{ $heights['mobile'] }};
                }
            },
            actualHeight: 0,
            measureHeight() {
                const container = this.$el.parentElement;
                this.actualHeight = container.offsetHeight;
            }
        }" 
        x-init="
            updateHeight();
            measureHeight();
            window.addEventListener('resize', () => { updateHeight(); measureHeight(); });
            setTimeout(() => measureHeight(), 100);
        "
        style="position: absolute; top: 8px; right: 8px; background: rgba(0,0,0,0.9); color: white; padding: 6px 10px; border-radius: 6px; font-size: 11px; font-family: monospace; z-index: 20; box-shadow: 0 2px 8px rgba(0,0,0,0.3);">
            <div style="color: #ff6b6b; font-weight: bold; margin-bottom: 4px;">📊 DEBUG WIDGETBAY</div>
            <div>📦 Total: {{ $productCount }} | ✅ Available: {{ $availableProductCount }}</div>
            @if ($availableProductCount === 0 && $productCount > 0)
                <div style="color: #ff9f43; font-weight: bold;">⚠️ NO PRODUCTS AVAILABLE</div>
            @endif
            <div>📱 Mobile: {{ $heights['mobile'] }}px</div>
            <div>📱 Tablet: {{ $heights['tablet'] }}px</div>
            <div>💻 Desktop: {{ $heights['desktop'] }}px</div>
            <div style="border-top: 1px solid #666; margin: 4px 0; padding-top: 4px;">
                <div style="color: #4ecdc4; font-weight: bold;" x-text="'Expected: ' + currentHeight + 'px (' + currentDevice + ')'"></div>
                <div style="color: #ffe66d; font-weight: bold;" x-text="'Actual: ' + actualHeight + 'px'"></div>
                <div x-show="Math.abs(actualHeight - currentHeight) > 5" style="color: #ff6b6b; font-weight: bold; margin-top: 2px;">
                    ⚠️ CLS: <span x-text="Math.abs(actualHeight - currentHeight)"></span>px
                </div>
                <div x-show="Math.abs(actualHeight - currentHeight) <= 5" style="color: #51cf66; font-weight: bold; margin-top: 2px;">
                    ✅ Perfect match!
                </div>
            </div>
        </div>
    @endif
</div>
