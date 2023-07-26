<?php

namespace Murdercode\LaravelShortcodePlus\Shortcodes;

class TwitterShortcode
{
    public function register($shortcode, $content, $compiler, $name, $viewData)
    {
        $url = $shortcode->url ?? '';

        if (empty($url)) {
            return 'No Twitter parameter url defined';
        }

        if (str_contains($url, 'twitter.com') === false) {
            return 'No Twitter.com URL defined';
        }

        $html = self::getOembed($url) ?? null;

        if (! isset($html)) {
            return 'Cannot get Twitter oembed';
        }

        return view('shortcode-plus::twitter', compact('html'))->render();
    }

    private static function getOembed(string $url): ?string
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
