<?php

namespace Murdercode\LaravelShortcodePlus\Livewire;

use Livewire\Component;
use Illuminate\Support\Facades\Cache;
use Illuminate\Support\Facades\Log;
use Illuminate\Support\Str;
use Livewire\Attributes\Lazy;
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
    public bool $loaded = false;

    public function mount(string $link, string $layout = 'default')
    {
        $this->link = $link;
        $this->layout = $layout;
    }

    public function placeholder()
    {
        return view('laravel-shortcode-plus::livewire.widgetbay-placeholder', [
            'link' => $this->link
        ]);
    }


    public function render()
    {
        // Con lazy loading, carichiamo i dati solo se non sono già stati caricati
        if (!$this->loaded && $this->widgetData === null && !$this->error) {
            $this->loadWidget();
        }
        
        return view('laravel-shortcode-plus::livewire.widgetbay-renderer');
    }

    public function loadWidget()
    {
        if ($this->loaded) {
            return; // Già caricato
        }
        
        // Verifica che la dipendenza sia disponibile
        if (!class_exists('\The3LabsTeam\Widgetbay\Facades\Widgetbay')) {
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
                $cacheKey = 'widgetbay_' . md5($singleLink);
                
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
            $this->widgetData = $this->normalizeWidgetData($allWidgetData);
            $this->productCount = count($this->widgetData);
            
            // Auto-detect layout se non specificato
            if ($this->layout === 'default') {
                $this->layout = $this->detectOptimalLayout($this->productCount);
            }
            
            // Marca come caricato solo se tutto è andato a buon fine
            $this->loaded = true;

        } catch (\Exception $e) {
            $this->handleError($e->getMessage());
            Log::error('WidgetbayRenderer error: ' . $e->getMessage(), [
                'link' => $this->link,
                'trace' => $e->getTraceAsString()
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
            $cacheKey = 'widgetbay_' . md5($singleLink);
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
                if (is_array($item) && !empty($item)) {
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
            return [
                'title' => $this->sanitizeTitle($item->title ?? null),
                'description' => $this->sanitizeDescription($item->description ?? null),
                'image' => $this->optimizeImageUrl($item->external_image ?? $item->image ?? null),
                'price' => $this->formatPrice($item->price ?? null),
                'original_price' => $this->formatPrice($item->original_price ?? null),
                'link' => $item->link ?? null,
                'cta_text' => $item->cta_text ?? 'Visualizza offerta',
                'additional_info' => $item->additional_info ?? []
            ];
        }
        
        // Se è già un array, accediamo agli indici
        if (is_array($item)) {
            return [
                'title' => $this->sanitizeTitle($item['title'] ?? null),
                'description' => $this->sanitizeDescription($item['description'] ?? null),
                'image' => $this->optimizeImageUrl($item['external_image'] ?? $item['image'] ?? null),
                'price' => $this->formatPrice($item['price'] ?? null),
                'original_price' => $this->formatPrice($item['original_price'] ?? null),
                'link' => $item['link'] ?? null,
                'cta_text' => $item['cta_text'] ?? 'Visualizza offerta',
                'additional_info' => $item['additional_info'] ?? []
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
            'cta_text' => 'Visualizza offerta',
            'additional_info' => []
        ];
    }
    
    /**
     * Sanitize and truncate title for display
     */
    private function sanitizeTitle(?string $title): ?string
    {
        if (!$title) return null;
        
        // Remove HTML tags and limit length
        $clean = strip_tags($title);
        return Str::limit($clean, 100);
    }
    
    /**
     * Sanitize description and preserve basic HTML
     */
    private function sanitizeDescription(?string $description): ?string
    {
        if (!$description) return null;
        
        // Allow only safe HTML tags
        $allowed = '<p><br><strong><b><em><i><ul><ol><li>';
        return strip_tags($description, $allowed);
    }
    
    /**
     * Optimize image URL for performance
     */
    private function optimizeImageUrl(?string $imageUrl): ?string
    {
        if (!$imageUrl) return null;
        
        // Add image optimization parameters if supported
        if (Str::contains($imageUrl, ['cdn', 'cloudfront', 'cloudinary'])) {
            // Add basic optimization params (this depends on the CDN used)
            if (!Str::contains($imageUrl, '?')) {
                $imageUrl .= '?w=400&q=85&f=auto';
            }
        }
        
        return $imageUrl;
    }
    
    /**
     * Format price consistently - returns numeric value for calculations
     */
    private function formatPrice($price)
    {
        if (!$price) return null;
        
        // Convert to string if it's numeric
        $clean = is_numeric($price) ? (string)$price : trim((string)$price);
        
        // Remove currency symbols and normalize
        $clean = str_replace(['€', ','], ['', '.'], $clean);
        $clean = trim($clean);
        
        // If it's numeric, return the float value (not formatted string)
        if (is_numeric($clean)) {
            return (float)$clean;
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

}
