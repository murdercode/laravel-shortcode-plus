<?php

namespace Murdercode\LaravelShortcodePlus\Parsers;

class Youtube
{
    public static function parse(string $content): string
    {
        preg_match('/\[youtube url="(.*?)"]/', $content, $matches);
        $youtubeId = $matches[1] ?? null;
        if ($youtubeId) {
            $youtubeId = explode('v=', $youtubeId)[1];
            $youtubeId = explode('&', $youtubeId)[0];
            return str_replace(
                $matches[0],
                view('shortcode-plus::youtube', ['video_id' => $youtubeId])->render(),
                $content
            );
        }

        return preg_replace(
            '/\[youtube]/',
            'No youtube URL defined',
            $content
        );
    }

}