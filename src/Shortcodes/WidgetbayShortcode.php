<?php

namespace Murdercode\LaravelShortcodePlus\Shortcodes;

class WidgetbayShortcode
{
    public function register($shortcode)
    {
        $id = $shortcode->id ?? '';
        return view('shortcode-plus::widgetbay', compact('id'))->render();
    }
}
