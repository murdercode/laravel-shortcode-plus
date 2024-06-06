<?php

namespace Murdercode\LaravelShortcodePlus\Shortcodes;

class WidgetbayShortcode
{
    public function register($shortcode)
    {

        $widgetbayLink = '';

        if ($shortcode->id) {
            $widgetbayLink = 'https://widgetbay.3labs.it/widgetbox/'.$shortcode->id;
        }

        if ($shortcode->link) {
            $shortcode->link = str_replace('&', '%26', $shortcode->link);
            $widgetbayLink = 'https://widgetbay.3labs.it/widgetbox?link='.$shortcode->link;
        }

        if ($shortcode->title) {
            $widgetbayLink .= '&title='.$shortcode->title;
        }

        if (empty($widgetbayLink)) {
            return 'No Widgetbay parameter id or link defined';
        }

        return view('shortcode-plus::widgetbay', compact('widgetbayLink'))->render();
    }
}
