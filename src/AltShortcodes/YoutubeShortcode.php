<?php

namespace Murdercode\LaravelShortcodePlus\AltShortcodes;

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

        //remove query string
        $youtubeId = explode('?', $youtubeId)[0];

        return '<iframe width="100%" height="100%" frameborder="0" allowfullscreen="true"  src="https://www.youtube.com/embed/' . $youtubeId . '?rel=0" ></iframe>';
    }
}
