<?php

namespace Murdercode\LaravelShortcodePlus\Shortcodes;

class YoutubeShortcode
{
    public function register($shortcode): string
    {
        $url = $shortcode->url ?? '';

        if (empty($url)) {
            return 'No Youtube parameter url defined';
        }

        // Extract Video ID from URL
        $queryString = parse_url($url, PHP_URL_QUERY);
        parse_str($queryString, $queryParams);

        // $shortcode->url can be also a shorter URL version like https://youtu.be/VIDEO_ID
        $youtubeId = $queryParams['v'] ?? substr($url, strrpos($url, '/') + 1);

        return view('shortcode-plus::youtube', compact('youtubeId'))->render();
    }
}
