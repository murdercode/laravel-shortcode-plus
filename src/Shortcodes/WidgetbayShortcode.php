<?php

namespace Murdercode\LaravelShortcodePlus\Shortcodes;

class WidgetbayShortcode
{
    public function register($shortcode)
    {

        if (! $shortcode->id || ! is_numeric($shortcode->id)
        ) {
            return 'No Widgetbay parameter id defined';
        }

        $id = (number_format($shortcode->id));

        return view('shortcode-plus::widgetbay', compact('id'))->render();
    }
}
