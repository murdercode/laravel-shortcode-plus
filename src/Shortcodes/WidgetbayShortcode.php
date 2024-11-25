<?php

namespace Murdercode\LaravelShortcodePlus\Shortcodes;

class WidgetbayShortcode
{
    public function register($shortcode)
    {
        $endpoint = config('shortcode-plus.widgetbay.endpoint') . '/widgetbox';

        $widgetbayLink = '';
        $heightListClass = null;
        if ($shortcode->id) {
            $widgetbayLink = $endpoint . '/' . $shortcode->id;
        }

        if ($shortcode->link) {
            $shortcode->link = str_replace('&', '%26', $shortcode->link);
            $heightListClass = $this->calculateIframeHeight($shortcode->link, $shortcode->layout);
            $widgetbayLink = $endpoint . '?link=' . $shortcode->link;
        }

        if ($shortcode->title) {
            $widgetbayLink .= '&title=' . $shortcode->title;
        }

        if ($shortcode->forcelink) {
            $widgetbayLink .= '&forceLink=' . $shortcode->forcelink;
        }

        if ($shortcode->layout) {
            $widgetbayLink .= '&layout=' . $shortcode->layout;
        }

        if (empty($widgetbayLink)) {
            return 'No Widgetbay parameter id or link defined';
        }

        return view('shortcode-plus::widgetbay', compact('widgetbayLink', 'heightListClass'))->render();
    }

    protected function calculateIframeHeight($products, $layout = null)
    {
        $endpoint = config('shortcode-plus.widgetbay.endpoint') . '/api/widgetbox-count-available-products?link=' . $products;


        //create HTTP request
        $request = new \GuzzleHttp\Client();
        $response = $request->get($endpoint);
        $count = json_decode($response->getBody()->getContents(), true);

        $prefix = $layout === 'hero' ? 'shortcode_widgetbay_list_hero_' : 'shortcode_widgetbay_list_';

        if ($count > 1) {
            return $prefix . $count;
        }

        return null;
    }

    protected function checkIfProductIsAvailable($product)
    {
        return $product->isAvailable();
    }
}
