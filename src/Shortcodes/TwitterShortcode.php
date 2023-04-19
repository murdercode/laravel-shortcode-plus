<?php

namespace Murdercode\LaravelShortcodePlus\Shortcodes;

class TwitterShortcode
{
    public function register($shortcode, $content, $compiler, $name, $viewData)
    {
        $url = $shortcode->url;
        $url = str_contains($url, 'twitter.com') ? $url : null;

        if ($url) {
            $html = str_contains($url, 'twitter.com') ? self::getOembed($url) : null;
        } else {
            return 'No twitter URL defined';
        }

        return view('shortcode-plus::twitter', compact('html'))->render();
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
