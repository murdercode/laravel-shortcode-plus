<?php

namespace Murdercode\LaravelShortcodePlus\Parsers;

class Spotify
{
    public static function parse(string $content): string
    {
    }

    private static function parseWithUri(string $content): string
    {
        return preg_replace_callback('/\[spotify uri="(.+)"]/', function ($matches) {
            $uri = $matches[1] ?? null;
            $uri = str_contains($uri, 'spotify') ? $uri : null;
            $url = $uri ? self::getUrlFromUri($uri) : null;

            if ($url) {
                return view('shortcode-plus::spotify', ['url' => $url]);
            }

            return 'No spotify URI defined';
        }, $content);
    }

    private static function getUrlFromUri(string $uri): string
    {
        $uri = str_replace('spotify:', '', $uri);
        $uri = explode(':', $uri);
        $type = $uri[0] ?? null;
        $id = $uri[1] ?? null;

        return 'https://open.spotify.com/embed/' . $type . '/' . $id;
    }
}
