<?php

namespace Murdercode\LaravelShortcodePlus\Livewire;

use Illuminate\Support\Facades\Cache;
use Illuminate\Support\Facades\Log;
use Illuminate\Support\Str;
use Livewire\Attributes\Lazy;
use Livewire\Component;
use The3LabsTeam\Widgetbay\Facades\Widgetbay;

#[Lazy]
class WidgetbayRenderer extends Component
{
    public string $link;

    public ?array $widgetData = null;

    public bool $error = false;

    public string $errorMessage = '';

    public string $layout = 'default'; // default, compact, vertical, hero

    public int $productCount = 0;

    public int $availableProductCount = 0;

    public bool $loaded = false;

    public function mount(string $link, string $layout = 'default')
    {
        $this->link = $link;
        $this->layout = $layout;
    }

    public function placeholder(array $params = [])
    {
        $heights = $this->calculateResponsivePlaceholderHeight();
        $isDebug = config('shortcode-plus.widgetbay.debug', false);
        $debugInfo = '';
        if ($isDebug) {
            $debugInfo = <<<HTML
    <div style="position: absolute; bottom: 8px; right: 8px; background: rgba(0,0,0,0.8); color: white; padding: 4px 8px; border-radius: 4px; font-size: 11px; font-family: monospace; z-index: 10;">
        <div x-text="'📱 M: {$heights['mobile']}px'"></div>
        <div x-text="'📱 T: {$heights['tablet']}px'"></div>
        <div x-text="'💻 D: {$heights['desktop']}px'"></div>
        <div x-text="'Current: ' + currentHeight + 'px'" style="border-top: 1px solid #666; margin-top: 2px; padding-top: 2px; font-weight: bold;"></div>
    </div>
HTML;
        }

        return <<<HTML
<div class="widgetbay-loading" x-data="{ 
    currentHeight: {$heights['mobile']},
    currentDevice: 'mobile',
    updateHeight() {
        if (window.innerWidth >= 768) {
            this.currentHeight = {$heights['desktop']};
            this.currentDevice = 'desktop';
        } else if (window.innerWidth >= 405) {
            this.currentHeight = {$heights['tablet']};
            this.currentDevice = 'tablet';
        } else {
            this.currentHeight = {$heights['mobile']};
            this.currentDevice = 'mobile';
        }
    }
}" x-init="
    updateHeight();
    window.addEventListener('resize', () => updateHeight());
    setTimeout(() => \$wire.\$refresh(), 100);
" style="position: relative;">
    <div style="border: 1px solid #e0e0e0; padding: 16px; text-align: center; background: #f9f9f9; border-radius: 0.5rem;">
        <div x-bind:style="'height: ' + currentHeight + 'px; background: linear-gradient(90deg, #f0f0f0 25%, #e0e0e0 50%, #f0f0f0 75%); background-size: 200% 100%; animation: skeleton-loading 1.5s infinite; border-radius: 0.5rem;'"></div>
        <p style="margin: 8px 0 0 0; font-size: 14px; color: #666;">Caricamento prodotto...</p>
    </div>
    $debugInfo
    <style>
    @keyframes skeleton-loading {
        0% { background-position: 200% 0; }
        100% { background-position: -200% 0; }
    }
    </style>
</div>
HTML;
    }

    public function render()
    {
        $this->loadWidget();

        return view('laravel-shortcode-plus::livewire.widgetbay-renderer');
    }

    public function loadWidget()
    {
        Log::info('WidgetbayRenderer: loadWidget() called', [
            'loaded' => $this->loaded,
            'link' => $this->link,
        ]);

        if ($this->loaded) {
            Log::info('WidgetbayRenderer: Widget already loaded, skipping');

            return; // Già caricato
        }

        // Verifica che la dipendenza sia disponibile
        if (! class_exists('\The3LabsTeam\Widgetbay\Facades\Widgetbay')) {
            Log::error('WidgetbayRenderer: lWidgetbay package is not available');
            $this->handleError('LaravelWidgetbay package is not installed. Please install the-3labs-team/laravel-widgetbay package.');

            return;
        }

        try {
            // Supporta link multipli separati da virgola
            $links = $this->parseLinks($this->link);
            $allWidgetData = [];

            foreach ($links as $singleLink) {
                // Crea una cache key unica per questo link
                $cacheKey = 'widgetbay_'.md5($singleLink);

                // Prova a ottenere i dati dalla cache (TTL: 1 ora)
                $data = Cache::remember($cacheKey, 3600, function () use ($singleLink) {
                    $apiResponse = Widgetbay::make()->getByLink($singleLink);

                    // L'API restituisce un array, prendiamo tutti i prodotti
                    return is_array($apiResponse) ? $apiResponse : [$apiResponse];
                });

                if ($data && is_array($data)) {
                    $allWidgetData = array_merge($allWidgetData, $data);
                }
            }

            if (empty($allWidgetData)) {
                Log::warning('WidgetbayRenderer: No widget data found');
                $this->handleError('Widget data not found');

                return;
            }

            // Converti oggetti in array per compatibilità con le viste
            $normalizedData = $this->normalizeWidgetData($allWidgetData);

            // Filtra solo i prodotti disponibili (che hanno link valido)
            $this->widgetData = $this->filterAvailableProducts($normalizedData);
            $this->productCount = count($normalizedData);
            $this->availableProductCount = count($this->widgetData);

            // Auto-detect layout se non specificato
            if ($this->layout === 'default') {
                $this->layout = $this->detectOptimalLayout($this->availableProductCount);
            }

            // Marca come caricato solo se tutto è andato a buon fine
            $this->loaded = true;
            Log::info('WidgetbayRenderer: Widget loaded successfully', [
                'totalProducts' => $this->productCount,
                'availableProducts' => $this->availableProductCount,
                'layout' => $this->layout,
            ]);

        } catch (\Exception $e) {
            $this->handleError($e->getMessage());
            Log::error('WidgetbayRenderer error: '.$e->getMessage(), [
                'link' => $this->link,
                'trace' => $e->getTraceAsString(),
            ]);
        }
    }

    public function retry()
    {
        $this->error = false;
        $this->errorMessage = '';
        $this->loaded = false;
        $this->widgetData = null;

        // Rimuovi dalla cache per tutti i link e riprova
        $links = $this->parseLinks($this->link);
        foreach ($links as $singleLink) {
            $cacheKey = 'widgetbay_'.md5($singleLink);
            Cache::forget($cacheKey);
        }

        $this->loadWidget();
    }

    private function handleError(string $message)
    {
        $this->error = true;
        $this->errorMessage = $message;
        $this->widgetData = null;
        $this->productCount = 0;
        $this->availableProductCount = 0;
    }

    /**
     * Parse links separated by comma and clean them
     */
    private function parseLinks(string $link): array
    {
        $links = str_replace('&', '%26', $link);
        $links = explode(',', $links);

        return array_map('trim', array_filter($links));
    }

    /**
     * Normalize widget data from objects to arrays for view compatibility
     */
    private function normalizeWidgetData(array $rawData): array
    {
        return array_map(function ($item) {
            // Se è una Collection Laravel, convertiamo in array e processiamo ricorsivamente
            if ($item instanceof \Illuminate\Support\Collection) {
                $item = $item->toArray();

                // Se la Collection contiene ancora array/oggetti, processiamo il primo elemento
                if (is_array($item) && ! empty($item)) {
                    $firstItem = reset($item);

                    return $this->extractWidgetDataFromItem($firstItem);
                }
            }

            return $this->extractWidgetDataFromItem($item);
        }, $rawData);
    }

    /**
     * Extract widget data from a single item (object or array)
     */
    private function extractWidgetDataFromItem($item): array
    {
        // Se è ancora una Collection, convertiamola
        if ($item instanceof \Illuminate\Support\Collection) {
            $item = $item->toArray();
        }

        // Se è un oggetto, accediamo alle proprietà
        if (is_object($item)) {
            $shopName = $item->type ?? null;

            return [
                'title' => $this->sanitizeTitle($item->title ?? null),
                'description' => $this->sanitizeDescription($item->description ?? null),
                'image' => $this->optimizeImageUrl($item->external_image ?? $item->image ?? null),
                'price' => $this->formatPrice($item->price ?? null),
                'original_price' => $this->formatPrice($item->original_price ?? null),
                'link' => $item->link ?? null,
                'shop_name' => $shopName,
                'shop_label' => $this->formatShopLabel($shopName),
                'isPrimeExclusive' => $item->isPrimeExclusive ?? false,
            ];
        }

        // Se è già un array, accediamo agli indici
        if (is_array($item)) {
            $shopName = $item['shop_name'] ?? null;

            return [
                'title' => $this->sanitizeTitle($item['title'] ?? null),
                'description' => $this->sanitizeDescription($item['description'] ?? null),
                'image' => $this->optimizeImageUrl($item['external_image'] ?? $item['image'] ?? null),
                'price' => $this->formatPrice($item['price'] ?? null),
                'original_price' => $this->formatPrice($item['original_price'] ?? null),
                'link' => $item['link'] ?? null,
                'shop_name' => $shopName,
                'shop_label' => $this->formatShopLabel($shopName),
                'isPrimeExclusive' => $item['isPrimeExclusive'] ?? false,
            ];
        }

        // Fallback per casi imprevisti
        return [
            'title' => null,
            'description' => null,
            'image' => null,
            'price' => null,
            'original_price' => null,
            'link' => null,
            'shop_name' => null,
            'shop_label' => null,
            'isPrimeExclusive' => false,
        ];
    }

    /**
     * Sanitize and truncate title for display
     */
    private function sanitizeTitle(?string $title): ?string
    {
        if (! $title) {
            return null;
        }

        // Remove HTML tags and limit length
        $clean = strip_tags($title);

        return Str::limit($clean, 100);
    }

    /**
     * Sanitize description and preserve basic HTML
     */
    private function sanitizeDescription(?string $description): ?string
    {
        if (! $description) {
            return null;
        }

        // Allow only safe HTML tags
        $allowed = '<p><br><strong><b><em><i><ul><ol><li>';

        return strip_tags($description, $allowed);
    }

    /**
     * Optimize image URL for performance
     */
    private function optimizeImageUrl(?string $imageUrl): ?string
    {
        if (! $imageUrl) {
            return null;
        }

        // Replace Amazon image size from 500 to 160
        $imageUrl = $this->replaceAmazonImageSize($imageUrl, 160);

        // Add image optimization parameters if supported
        if (Str::contains($imageUrl, ['cdn', 'cloudfront', 'cloudinary'])) {
            // Add basic optimization params (this depends on the CDN used)
            if (! Str::contains($imageUrl, '?')) {
                $imageUrl .= '?w=400&q=85&f=auto';
            }
        }

        return $imageUrl;
    }

    /**
     * Replace Amazon image size in URL
     */
    private function replaceAmazonImageSize(string $imageUrl, int $newSize): string
    {
        // Replace _SL500 with the new size (e.g., _SL160)
        return str_replace('_SL500', '_SL'.$newSize, $imageUrl);
    }

    /**
     * Format price consistently - returns numeric value for calculations
     */
    private function formatPrice($price)
    {
        if (! $price) {
            return null;
        }

        // Convert to string if it's numeric
        $clean = is_numeric($price) ? (string) $price : trim((string) $price);

        // Remove currency symbols and normalize
        $clean = str_replace(['€', ','], ['', '.'], $clean);
        $clean = trim($clean);

        // If it's numeric, return the float value (not formatted string)
        if (is_numeric($clean)) {
            return (float) $clean;
        }

        return null;
    }

    /**
     * Detect optimal layout based on product count
     */
    private function detectOptimalLayout(int $count): string
    {
        if ($count === 1) {
            return 'hero';
        } elseif ($count <= 3) {
            return 'compact';
        } else {
            return 'vertical';
        }
    }

    /**
     * Format shop name for display with proper capitalization
     */
    private function formatShopLabel(?string $shopName): ?string
    {
        if (! $shopName) {
            return null;
        }

        // Map di shop specifici con i loro nomi formattati
        $shopLabels = [
            'instantgaming' => 'Instant Gaming',
            'amazon' => 'Amazon',
            'ebay' => 'eBay',
            'mediaworld' => 'MediaWorld',
            'unieuro' => 'Unieuro',
            'euronics' => 'Euronics',
        ];

        $lowerShopName = strtolower($shopName);

        // Se abbiamo una mappatura specifica, usala
        if (isset($shopLabels[$lowerShopName])) {
            return $shopLabels[$lowerShopName];
        }

        // Altrimenti capitalizza ogni parola
        return Str::title($shopName);
    }

    /**
     * Filter products that are available (have valid link and price/title)
     */
    private function filterAvailableProducts(array $products): array
    {
        return array_filter($products, function ($product) {
            // Un prodotto è considerato disponibile se ha:
            // 1. Un link valido
            // 2. Un titolo
            // 3. Un prezzo O un'immagine (alcuni prodotti potrebbero non avere prezzo visibile)
            return ! empty($product['link']) &&
                   ! empty($product['title']) &&
                   (! empty($product['price']) || ! empty($product['image']));
        });
    }

    /**
     * Calculate responsive placeholder heights for all device types
     */
    private function calculateResponsivePlaceholderHeight(): array
    {
        // Get expected product count from links
        $links = $this->parseLinks($this->link);
        $expectedProducts = count($links);

        // Se abbiamo già caricato i dati, usa il conteggio effettivo dei prodotti disponibili
        if ($this->loaded) {
            $expectedProducts = $this->availableProductCount;
        }

        // Se non ci sono prodotti disponibili, calcola l'altezza per il messaggio di fallback
        if ($this->loaded && $this->availableProductCount === 0) {
            return $this->calculateUnavailableProductsHeight();
        }
        // Detect layout based on expected products if not set
        $currentLayout = $this->layout === 'default' ? $this->detectOptimalLayout($expectedProducts) : $this->layout;

        // Base container padding and styling
        $baseHeight = 32; // 16px padding top + 16px padding bottom

        if ($currentLayout === 'hero' || $expectedProducts === 1) {
            // Hero layout - single product with large image
            return [
                'mobile' => $this->calculateHeroHeight($baseHeight, 'mobile'),
                'tablet' => $this->calculateHeroHeight($baseHeight, 'tablet'),
                'desktop' => $this->calculateHeroHeight($baseHeight, 'desktop'),
            ];
        } else {
            // Compact layout - multiple products
            return [
                'mobile' => $this->calculateCompactHeight($baseHeight, $expectedProducts, 'mobile'),
                'tablet' => $this->calculateCompactHeight($baseHeight, $expectedProducts, 'tablet'),
                'desktop' => $this->calculateCompactHeight($baseHeight, $expectedProducts, 'desktop'),
            ];
        }
    }

    /**
     * Calculate height for hero layout (single product) per device
     * Updated with real measurements from debug data
     */
    private function calculateHeroHeight(int $baseHeight, string $device): int
    {
        // Hero layout dimensions based on real measurements from screenshots
        switch ($device) {
            case 'mobile': // <405px
                // Based on real measurement: actual=324px, so content=292px
                // Mobile hero layout is taller due to vertical stacking of content
                return $baseHeight + 292; // 324px total

            case 'tablet': // 405-767px
                // Based on real measurement: actual=322px, so content=290px
                return $baseHeight + 290; // 322px total

            case 'desktop': // ≥768px
                // Desktop: horizontal layout, image height determines total
                return $baseHeight + 160; // 192px total

            default:
                return $baseHeight + 292; // Use mobile as default for narrow screens
        }
    }

    /**
     * Calculate height for compact layout (multiple products) per device
     * Updated with real measurements from debug data
     */
    private function calculateCompactHeight(int $baseHeight, int $productCount, string $device): int
    {
        // Compact layout per-product height based on real measurements:
        // Reverse engineered from actual widget heights:
        // Desktop: 2prod=227px, 3prod=332px, 4prod=437px → ~89px per product
        switch ($device) {
            case 'mobile': // <405px
                // Updated based on real measurements from screenshot:
                // 2prod: actual=213px, expected=232px → (213-32-16)/2 = 82.5px per product
                // 3prod: actual=311px, expected=340px → (311-32-32)/3 = 82.3px per product
                $perProductHeight = 82;
                break;

            case 'tablet': // 405-767px
                // Based on real measurements: 2prod=213px, 3prod=311px → ~82px per product
                $perProductHeight = 82;
                break;

            case 'desktop': // ≥768px
                // Based on real measurements: ~89px per product
                $perProductHeight = 89;
                break;

            default:
                $perProductHeight = 92;
        }

        // Spacing between products: pt-4 class = 16px, not 4px
        $spacingHeight = ($productCount - 1) * 16;

        return $baseHeight + ($productCount * $perProductHeight) + $spacingHeight;
    }

    /**
     * Calculate height for unavailable products message
     */
    private function calculateUnavailableProductsHeight(): array
    {
        // Altezze misurate effettivamente per il messaggio "prodotti non disponibili"
        return [
            'mobile' => 148,  // Misurazione reale per smartphone
            'tablet' => 148,  // Misurazione reale per tablet
            'desktop' => 152,  // Misurazione reale per desktop
        ];
    }
}
