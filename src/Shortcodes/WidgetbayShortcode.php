<?php

namespace Murdercode\LaravelShortcodePlus\Shortcodes;

class WidgetbayShortcode
{
    public function register($shortcode)
    {

        if (!$shortcode->id || !is_numeric($shortcode->id) && !$shortcode->link || $shortcode->id && $shortcode->link) {
            return 'No Widgetbay parameter id or link defined';
        }

        $id = $shortcode->id ? (number_format($shortcode->id)) : null;
        $link = $shortcode->link;

//        if (!$id && !$link || $id && $link) {
//            return 'No Widgetbay parameter id or link defined';
//        }


        return view('shortcode-plus::widgetbay', compact('id', 'link'))->render();
    }
}
