<?php

namespace Murdercode\LaravelShortcodePlus\Shortcodes;

class WidgetbayShortcode
{
    public function register($shortcode)
    {

        $widgetbayLink = '';

        if ($shortcode->id) {
            $widgetbayLink = 'https://widgetbay.it/widgetbox/'.$shortcode->id;
        }

        if ($shortcode->link) {
            $widgetbayLink = 'https://widgetbay.it/widgetbox?link='.$shortcode->link;
        }

        if (empty($widgetbayLink)) {
            return 'No Widgetbay parameter id or link defined';
        }

        return view('shortcode-plus::widgetbay', compact('widgetbayLink'))->render();
    }
}
