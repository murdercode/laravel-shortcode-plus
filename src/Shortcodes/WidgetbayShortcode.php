<?php

namespace Murdercode\LaravelShortcodePlus\Shortcodes;

class WidgetbayShortcode
{
    public function register($shortcode)
    {

        $widgetbayLink = '';

        if ($shortcode->id) {
            $widgetbayLink = 'https://widgetbay.3labs.it/widgetbox/'.$shortcode->id;
        }

        if ($shortcode->link) {
            $shortcode->link = str_replace('&', '%26', $shortcode->link);
            $widgetbayLink = 'https://widgetbay.3labs.it/widgetbox?link='.$shortcode->link;
        }

        if($shortcode->type === 'iframe'){
            if (empty($widgetbayLink)) {
                return 'No Widgetbay parameter id or link defined';
            }

            return view('shortcode-plus::widgetbay', compact('widgetbayLink'))->render();
        } else {
            $oembed = self::getOembed($shortcode->link ?? null, $shortcode->id ?? null);

            return view('shortcode-plus::widgetbay', compact('oembed'))->render();
        }

    }

    // Get oEmbed from Widgetbay apibox
    private static function getOembed(?string $url, ?int $id)
    {
        curl_setopt_array($curl = curl_init(), [
            CURLOPT_URL => 'http://widgetbay.test/apibox' . ($url != null ? '?link=' . $url : '/' . $id),
            CURLOPT_RETURNTRANSFER => true,
            CURLOPT_HTTPHEADER => [
                'Token: ' . config('shortcode-plus.widgetbox-token'),
                'Content-Type: application/json',
            ],
        ]);
        $response = curl_exec($curl);
        curl_close($curl);

        return json_decode($response) ?? null;
    }
}
