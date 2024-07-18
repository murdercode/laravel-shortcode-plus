<?php

namespace Murdercode\LaravelShortcodePlus\Shortcodes;

class WidgetbayShortcode
{
    public function register($shortcode)
    {
        $endpoint = 'https://widgetbay.3labs.it/widgetbox';
//        $endpoint = 'https://widgetbay.test/widgetbox';

        $widgetbayLink = '';
        $heightListClass = null;
        if ($shortcode->id) {
            $widgetbayLink = $endpoint . '/' . $shortcode->id;
        }

        if ($shortcode->link) {
            $shortcode->link = str_replace('&', '%26', $shortcode->link);
            $heightListClass = $this->calculateIframeHeight($shortcode->link);
            $widgetbayLink = $endpoint . '?link=' . $shortcode->link;
        }

        if ($shortcode->title) {
            $widgetbayLink .= '&title=' . $shortcode->title;
        }

        if (empty($widgetbayLink)) {
            return 'No Widgetbay parameter id or link defined';
        }

        return view('shortcode-plus::widgetbay', compact('widgetbayLink', 'heightListClass'))->render();
    }

    protected function calculateIframeHeight($products)
    {
        $products = explode(',', $products);
        $count = count($products);

        if ($count > 1) {
            return 'shortcode_widgetbay_list_' . $count;
        }

        return null;
    }
}
