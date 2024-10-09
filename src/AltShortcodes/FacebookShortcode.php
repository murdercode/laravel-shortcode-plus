<?php

namespace Murdercode\LaravelShortcodePlus\AltShortcodes;

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

        return '<div class="fb-post" data-href="'.$url.'" data-width="500" data-show-text="true"></div>';
    }
}
