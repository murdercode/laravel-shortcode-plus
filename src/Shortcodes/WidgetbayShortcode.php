<?php

namespace Murdercode\LaravelShortcodePlus\Shortcodes;

class WidgetbayShortcode
{
    public function register($shortcode)
    {
        if (! isset($shortcode->id) || ! is_numeric($shortcode->id)) {
            return 'No Widgetbay parameter id defined';
        }

        $id = $shortcode->id;

        return view('shortcode-plus::widgetbay', compact('id'))->render();
    }
}
