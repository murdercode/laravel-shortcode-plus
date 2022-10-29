<?php

namespace Murdercode\LaravelShortcodePlus\Parsers;


class Youtube
{
    public static function parse(string $content): string
    {
        return preg_replace_callback(
            '/\[youtube url="(.*?)"]/',
            function ($matches) {
                $url = $matches[1] ?? null;
                $url = str_contains($url, 'youtube.com') ? $url : null;
                preg_match('/youtube.com\/watch\?v=(.*)/', $url, $matches);

                $youtubeId = $matches[1] ?? null;

                if ($youtubeId) {
                    return view(
                        'shortcode-plus::youtube',
                        ['youtubeId' => $youtubeId]
                    )->render();
                }
                return 'No youtube URL defined';
            },
            $content
        );
    }

}