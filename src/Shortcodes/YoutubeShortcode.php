<?php

namespace Murdercode\LaravelShortcodePlus\Shortcodes;

class YoutubeShortcode
{

    public function register($shortcode, $content, $compiler, $name, $viewData)
    {
        $url = $shortcode->url;

        // Extract Video ID from URL
        $queryString = parse_url($url, PHP_URL_QUERY);
        parse_str($queryString, $queryParams);
        $youtubeId = $queryParams['v'] ?? null;

        return view('shortcode-plus::youtube', compact('youtubeId'))->render();
    }

}