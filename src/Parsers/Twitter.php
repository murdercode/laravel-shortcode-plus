<?php

namespace Murdercode\LaravelShortcodePlus\Parsers;

class Twitter
{
    public static function parse(string $content): string
    {
        return preg_replace_callback(
            '/\[twitter url="(.*?)"]/',
            function ($matches) {
                $url = $matches[1] ?? null;
                $url = str_contains($url, 'twitter.com') ? $url : null;

                if ($url) {
                    $html = str_contains($url, 'twitter.com') ? self::getOembed($url) : null;

                    return view('shortcode-plus::twitter', ['html' => $html])->render();
                }

                return 'No twitter URL defined';
            }, $content
        );
    }

    private static function getOembed(string $url): string|null
    {
        curl_setopt_array($curl = curl_init(), [
            CURLOPT_URL => "https://publish.twitter.com/oembed?url=$url",
            CURLOPT_RETURNTRANSFER => true,
        ]);
        $response = curl_exec($curl);
        curl_close($curl);

        return json_decode($response)->html ?? null;
    }
}
