<?php

namespace Murdercode\LaravelShortcodePlus\Shortcodes;

class WidgetbayShortcode
{
    public function register($shortcode)
    {

        if (! $shortcode->id && ! $shortcode->link || $shortcode->id && $shortcode->link || $shortcode->id && ! is_numeric($shortcode->id)) {
            return 'No Widgetbay parameter id or link defined';
        }

        $id = $shortcode->id ? (number_format($shortcode->id)) : null;
        $link = $shortcode->link;

        return view('shortcode-plus::widgetbay', compact('id', 'link'))->render();
    }
}
