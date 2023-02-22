<?php

namespace Murdercode\LaravelShortcodePlus\Parsers;

class Instagram
{
    public static function parse(string $content): string
    {
        return preg_replace_callback(
            '/\[instagram url="(.*?)"]/',
            function ($matches) {
                $url = str_contains($matches[1], 'instagram.com') ? $matches[1] : null;

                $regex = '/\/p\/([a-zA-Z0-9_-]+)/';
                preg_match($regex, $url, $matches);
                $post_id = $matches[1];

                $embed_url = 'https://www.instagram.com/p/'.$post_id.'/embed';
                if ($url) {
                    return view('shortcode-plus::instagram', compact('embed_url'))->render();
                }

                return 'No Facebook URL found';
            },
            $content
        );
    }
}
