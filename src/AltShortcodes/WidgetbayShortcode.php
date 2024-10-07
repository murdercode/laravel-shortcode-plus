<?php

namespace Murdercode\LaravelShortcodePlus\AltShortcodes;

use The3LabsTeam\Widgetbay\Facades\Widgetbay;

class WidgetbayShortcode
{
    public static function parse($content): string
    {
        return preg_replace_callback(
            '/\[widgetbay link="(.*?)".*?\]/',
            function ($matches) {
                $link = $matches[1];
                $links = explode(',', $link);
                $htmlLinks = '';
                foreach ($links as $link) {
                    $htmlLinks .= self::getRandomHtmlLinkFromWidgetbay($link).'<br />';
                }

                return $htmlLinks;
            },
            $content
        );
    }

    protected static function getRandomHtmlLinkFromWidgetbay(string $link): string
    {
        $data = Widgetbay::make()->getByLink($link)[0];

        $title = $data->title ?? null;
        $price = $data->price ?? 0;
        $link = $data->link ?? '';
        $originalPrice = $data->original_price ?? null;
        $percentages = $originalPrice ? round(($price / $originalPrice) * 100, 2) : 0;
        $percentages = $percentages > 20 ? "(-{$percentages}%)" : '';
        $shopName = self::getLabelFromUrl($link);

        $labels = [
            "Acquista {$title} a {$price}€".($originalPrice ? " invece {$originalPrice}€" : '')."{$percentages}{$shopName}",
            "Vedi {$title}{$shopName}",
            "Scopri il prezzo di {$title}{$shopName}",
        ];

        $randomNumber = rand(1, count($labels));
        $randomLabel = $labels[$randomNumber - 1];

        if ($link) {
            return "<a href='{$link}' target='_blank' rel='nofollow sponsored noreferrer' class='noshortcode_button_{$randomNumber}'>{$randomLabel}</a>";
        } else {
            return '';
        }
    }

    protected static function getLabelFromUrl(string $url)
    {
        $domain = parse_url($url, PHP_URL_HOST);
        $domain = str_replace('www.', '', $domain);
        $domain = explode('.', $domain);

        return $domain[0] ? ' su '.ucwords($domain[0]) : null;
    }
}
