<?php

namespace Murdercode\LaravelShortcodePlus\Helpers;

class Sanitizer
{
    public static function escapeQuotes(?string $content): string
    {
        if ($content == null) {
            return '';
        }
        $content = str_replace('"', '&quot;', $content);
        $content = str_replace("'", '&#39;', $content);

        return $content;
    }

    public static function parseAllLinks(?string $content): string
    {
        if ($content == null) {
            return '';
        }

        $content = self::parseSponsoredLink($content);
        $content = self::parseDoFollowLink($content);
        $content = self::parseNoFollowLink($content);

        return $content;
    }

    public static function parseSponsoredLink(string $content): string
    {
        $linksToCheck = [
            'https://www.amazon.it',
            'https://www.ebay.it',
            'https://www.instant-gaming.com',
        ];

        return preg_replace_callback('/<a\s+([^>]+)>/', function ($matches) use ($linksToCheck) {
            if (!preg_match('/rel="/', $matches[0])) {
                preg_match('/href="([^"]*)"/', $matches[1], $hrefMatches);
                $link = $hrefMatches[1];
                foreach ($linksToCheck as $linkToCheck) {
                    if (strpos($link, $linkToCheck) === 0) {
                        return str_replace('<a ' . $matches[1], '<a ' . $matches[1] . ' rel="sponsored"', $matches[0]);
                    }
                }
            }
            return $matches[0];
        }, $content);
    }

    public static function parseDoFollowLink(string $content): string
    {
        $siteDomain = config('app.url');
        $linksToCheck = [
            $siteDomain,
            'https://forum.tomshw.it/'
        ];

        return preg_replace_callback('/<a\s+([^>]+)>/', function ($matches) use ($linksToCheck) {
            if (!preg_match('/rel="/', $matches[0])) {
                preg_match('/href="([^"]*)"/', $matches[1], $hrefMatches);
                $link = $hrefMatches[1];
                foreach ($linksToCheck as $linkToCheck) {
                    if (strpos($link, $linkToCheck) === 0) {
                        return str_replace('<a ' . $matches[1], '<a ' . $matches[1] . ' rel="dofollow"', $matches[0]);
                    }
                }
            }
            return $matches[0];
        }, $content);
    }


    public static function parseNoFollowLink(string $content): string
    {
        return preg_replace_callback('/<a\s+([^>]+)>/', function ($matches) {
            if (!preg_match('/rel="/', $matches[0])) {
                return str_replace('<a ' . $matches[1] . '>', '<a ' . $matches[1] . ' rel="nofollow">', $matches[0]);
            }
            return $matches[0];
        }, $content);
    }
}
