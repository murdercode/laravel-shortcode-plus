<?php

namespace Murdercode\LaravelShortcodePlus\Shortcodes;

class TikTokShortcode
{
    public function register($shortcode): string
    {
        $url = $shortcode->url ?? '';

        if (empty($url)) {
            return 'No TikTok parameter url defined';
        }

        if (str_contains($url, 'tiktok.com') === false) {
            return 'No tiktok.com URL defined';
        }

        $html = self::getOembed($url) ?? null;

        if (!isset($html)) {
            return 'Cannot get TikTok oembed';
        }

        return view('shortcode-plus::tiktok', compact('html'))->render();
    }

    private static function getOembed(string $url): ?string{
        curl_setopt_array($curl = curl_init(), [
            CURLOPT_URL => "https://www.tiktok.com/oembed?url=$url",
            CURLOPT_RETURNTRANSFER => true,
        ]);
        $response = curl_exec($curl);
        curl_close($curl);

        return json_decode($response)->html ?? null;
    }
}
