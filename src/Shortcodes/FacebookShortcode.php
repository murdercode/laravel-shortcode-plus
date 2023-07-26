<?php

namespace Murdercode\LaravelShortcodePlus\Shortcodes;

class FacebookShortcode
{
    public function register($shortcode): string
    {
        $url = $shortcode->url ?? '';

        if (empty($url)) {
            return 'No Facebook parameter url defined';
        }

        if (! str_contains($url, 'facebook.com')) {
            return 'No Facebook URL found';
        }

        return view('shortcode-plus::facebook', compact('url'))->render();
    }
}
