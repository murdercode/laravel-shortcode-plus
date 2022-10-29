<?php

namespace Murdercode\LaravelShortcodePlus\Parsers;

class Youtube
{
    public static function parse(string $content): string
    {
        preg_match('/\[youtube url="(.*?)"]/', $content, $matches);
        $url = $matches[1] ?? null;

        $youtubeId = preg_match('/youtube.(.*)watch\?v=([a-zA-Z0-9_-]{11})/', $url, $matches)
            ? $matches[2]
            : null;

        return $youtubeId
            ? view('shortcode-plus::youtube', ['youtubeId' => $youtubeId])
                ->render()
            : 'No youtube URL defined';
    }

}