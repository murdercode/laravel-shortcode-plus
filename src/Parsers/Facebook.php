<?php

namespace Murdercode\LaravelShortcodePlus\Parsers;

class Facebook
{
    public static function parse(string $content): string
    {
        return preg_replace_callback(
            '/\[facebook url="(.*?)"]/',
            function ($matches) {
                $url = str_contains($matches[1], 'facebook.com') ? $matches[1] : null;
                if ($url) {
                    return view('shortcode-plus::facebook', compact('url'))->render();
                }

                return 'No Facebook URL found';
            },
            $content
        );
    }
}
