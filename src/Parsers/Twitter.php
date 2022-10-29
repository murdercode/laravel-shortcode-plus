<?php

namespace Murdercode\LaravelShortcodePlus\Parsers;

class Twitter
{
    public static function parse(string $content): string {
        return preg_replace_callback(
            '/\[twitter url="(.*?)"]/',
            function ($matches) {
                curl_setopt_array($curl = curl_init(), [
                    CURLOPT_URL => "https://publish.twitter.com/oembed?url=$matches[1]",
                    CURLOPT_RETURNTRANSFER => true,
                ]);
                $response = curl_exec($curl);
                curl_close($curl);

                return json_decode($response)->html
                    ? view('shortcode-plus::twitter', ['html' => json_decode($response)->html])
                        ->render()
                    : 'No twitter URL defined';
            },
            $content
        );
    }
}