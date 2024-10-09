<?php

namespace Murdercode\LaravelShortcodePlus\AltShortcodes;

class TwitterShortcode
{
    public function register($shortcode): string
    {
        $url = $shortcode->url ?? '';

        if (empty($url)) {
            return 'No X.com parameter url defined';
        }

        if (str_contains($url, 'twitter.com') === false && str_contains($url, 'x.com') === false) {
            return 'No X.com URL defined';
        }

        $html = self::getOembed($url) ?? null;

        if (!isset($html)) {
            return 'Cannot get X.com oEmbed';
        }
        
        return $html;
    }

    private static function getOembed(string $url): ?string
    {
        curl_setopt_array($curl = curl_init(), [
            CURLOPT_URL => "https://publish.twitter.com/oembed?url=$url&omit_script=1",
            CURLOPT_RETURNTRANSFER => true,
        ]);
        $response = curl_exec($curl);
        curl_close($curl);

        return json_decode($response)->html ?? null;
    }
}
