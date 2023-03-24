<?php

namespace Murdercode\LaravelShortcodePlus\Shortcodes;

class SpotifyShortcode
{

    public function register($shortcode, $content, $compiler, $name, $viewData)
    {
        [$url, $uri] = [$shortcode->url, $shortcode->uri];

        $convertedUrl = $url ? self::getUrlFromUrl($url) : ($uri ? self::getUrlFromUri($uri) : null);

        return $convertedUrl ? view('shortcode-plus::spotify', compact('convertedUrl'))->render() : ($url ?? $uri);

    }

    private static function getUrlFromUri(string $uri): string
    {
        $uri = str_replace('spotify:', '', $uri);
        $uri = explode(':', $uri);
        $type = $uri[0] ?? null;
        $id = $uri[1] ?? null;

        return 'https://open.spotify.com/embed/'.$type.'/'.$id;
    }

    private static function getUrlFromUrl(string $url): string
    {
        $url = str_replace('https://open.spotify.com/', '', $url);
        $url = explode('/', $url);
        $type = $url[0] ?? null;
        $id = $url[1] ?? null;

        return 'https://open.spotify.com/embed/'.$type.'/'.$id;
    }

}