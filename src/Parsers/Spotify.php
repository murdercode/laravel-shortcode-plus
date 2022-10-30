<?php

namespace Murdercode\LaravelShortcodePlus\Parsers;

class Spotify
{
    public static function parse(string $content): string
    {
        return preg_replace_callback('/\[spotify uri="(.+)"]/', function ($matches) {
            $url = $matches[1] ?? null;
            $url = str_contains($url, 'spotify') ? $url : null;
            $url = $url ? str_replace(
                'spotify:album:',
                'https://open.spotify.com/embed/album/',
                $url
            ) : null;

            if ($url) {
                return view('shortcode-plus::spotify', ['url' => $url]);
            }

            return 'No spotify URI defined';
        }, $content);
    }
}
