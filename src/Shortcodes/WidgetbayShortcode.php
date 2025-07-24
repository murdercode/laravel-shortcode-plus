<?php

namespace Murdercode\LaravelShortcodePlus\Shortcodes;

use Illuminate\Support\Facades\Cache;
use Illuminate\Support\Facades\Log;
use The3LabsTeam\LaravelWidgetbay\Facades\Widgetbay;

class WidgetbayShortcode
{
    public function register($shortcode)
    {
        // Verifica se utilizzare il nuovo rendering
        $useNewRender = config('shortcode-plus.widgetbay.use_new_render', false);

        if ($useNewRender) {
            return $this->renderWithLivewire($shortcode);
        }

        return $this->renderWithIframe($shortcode);
    }

    /**
     * Nuovo rendering con Livewire (Lazy Loading)
     */
    protected function renderWithLivewire($shortcode)
    {
        // Estrae il link dal shortcode
        $link = $this->extractLinkFromShortcode($shortcode);

        if (empty($link)) {
            return '<div class="widgetbay-error">Errore: parametro link mancante per il widget</div>';
        }

        // Determina il layout dal shortcode o usa default
        $layout = $shortcode->layout ?? 'default';

        // Renderizza il componente Livewire come placeholder che si caricherà lazy
        return view('shortcode-plus::widgetbay-lazy', compact('link', 'layout'))->render();
    }

    /**
     * Ottiene i dati del widget dall'API con cache
     */
    protected function getWidgetDataFromApi($link)
    {
        // Crea una cache key unica per questo link
        $cacheKey = 'widgetbay_'.md5($link);

        // Prova a ottenere i dati dalla cache (TTL: 1 ora)
        return Cache::remember($cacheKey, 3600, function () use ($link) {
            try {
                return Widgetbay::make()->getByLink($link);
            } catch (\Exception $e) {
                Log::error('Widgetbay API error: '.$e->getMessage(), ['link' => $link]);

                return null;
            }
        });
    }

    /**
     * Rendering tradizionale con iframe
     */
    protected function renderWithIframe($shortcode)
    {
        $endpoint = config('shortcode-plus.widgetbay.endpoint');

        $widgetbayLink = '';
        $heightListClass = null;
        if ($shortcode->id) {
            $widgetbayLink = $endpoint.'/'.$shortcode->id;
        }

        if ($shortcode->link) {
            $shortcode->link = urlencode($shortcode->link);
            $heightListClass = $this->calculateIframeHeight($shortcode->link, $shortcode->layout);
            $widgetbayLink = $endpoint.'?link='.$shortcode->link;
        }

        if ($shortcode->title) {
            $widgetbayLink .= '&title='.$shortcode->title;
        }

        if ($shortcode->forcelink) {
            $shortcode->forceLink = urlencode($shortcode->forceLink);
            $widgetbayLink .= '&forceLink='.$shortcode->forcelink;
        }

        if ($shortcode->layout) {
            $widgetbayLink .= '&layout='.$shortcode->layout;
        }

        if (empty($widgetbayLink)) {
            return 'No Widgetbay parameter id or link defined';
        }

        return view('shortcode-plus::widgetbay', compact('widgetbayLink', 'heightListClass'))->render();
    }

    /**
     * Estrae il link dal shortcode per il nuovo rendering
     */
    protected function extractLinkFromShortcode($shortcode)
    {
        if ($shortcode->link) {
            return urldecode($shortcode->link);
        }

        if ($shortcode->id) {
            // Se abbiamo solo un ID, costruiamo il link completo
            $endpoint = config('shortcode-plus.widgetbay.endpoint');

            return $endpoint.'/'.$shortcode->id;
        }

        return null;
    }

    protected function calculateIframeHeight($products, $layout = null)
    {
        $products = explode('%2C', $products);
        $count = count($products);
        $prefix = $layout === 'hero' ? 'shortcode_widgetbay_list_hero_' : 'shortcode_widgetbay_list_';

        if ($count > 1) {
            return $prefix.$count;
        }

        return null;
    }
}
