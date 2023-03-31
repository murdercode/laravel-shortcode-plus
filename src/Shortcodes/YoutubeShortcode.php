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

        // $shortcode->url can be also a shortner URL version like https://youtu.be/VIDEO_ID
        $youtubeId = $queryParams['v'] ?? substr($url, strrpos($url, '/') + 1);

        return view('shortcode-plus::youtube', compact('youtubeId'))->render();
    }

}