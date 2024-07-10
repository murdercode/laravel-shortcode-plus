<?php

namespace Murdercode\LaravelShortcodePlus\Shortcodes;

class WidgetbayShortcode
{
    public function register($shortcode)
    {

        $widgetbayLink = '';
        $height = null;
        if ($shortcode->id) {
            $widgetbayLink = 'https://widgetbay.test/widgetbox/' . $shortcode->id;
        }

        if ($shortcode->link) {
            $shortcode->link = str_replace('&', '%26', $shortcode->link);
            $height = $this->calculateIframeHeight($shortcode->link);
            $widgetbayLink = 'https://widgetbay.test/widgetbox?link=' . $shortcode->link;
        }

        if ($shortcode->title) {
            $widgetbayLink .= '&title=' . $shortcode->title;
        }

        if (empty($widgetbayLink)) {
            return 'No Widgetbay parameter id or link defined';
        }

        return view('shortcode-plus::widgetbay', compact('widgetbayLink', 'height'))->render();
    }

    protected function calculateIframeHeight($products)
    {
        $products = explode(',', $products);
        $count = count($products);


        if ($count > 1) {
            $defaultHeightDesktop = 92;
            $defaultHeightMobile = 142;

            return [
                "desktop" => $defaultHeightDesktop * $count,
                "mobile" => $defaultHeightMobile * $count
            ];
        }

        return null;
    }
}
