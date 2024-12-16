<?php

namespace Murdercode\LaravelShortcodePlus\Shortcodes;

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

        if (! isset($html)) {
            return 'Cannot get X.com oEmbed';
        }

        return view('shortcode-plus::twitter', compact('html'))->render();
    }

    private static function getOembed(string $url): ?string
    {
        $curl = curl_init();
        curl_setopt($curl, CURLOPT_URL, 'https://publish.twitter.com/oembed?url='.urlencode($url).'&omit_script=1');
        curl_setopt($curl, CURLOPT_RETURNTRANSFER, true);
        $response = curl_exec($curl);
        curl_close($curl);

        if ($response === false) {
            return null;
        }

        $data = json_decode($response, true);

        return $data['html'] ?? null;
    }
}
