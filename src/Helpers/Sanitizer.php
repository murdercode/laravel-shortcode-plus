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

        $linksToParse = config('shortcode-plus.linksToParse');

        foreach ($linksToParse as $rel => $links) {
            if ($links === null) {
                continue;
            }
            $content = self::parseLink($content, $links, $rel);
        }

        return $content;
    }

    protected static function parseLink(string $content, array $linksToCheck, string $rel)
    {
        return preg_replace_callback('/<a\s+([^>]+)>/', function ($matches) use ($linksToCheck, $rel) {
            if (preg_match('/href="([^"]*)"/', $matches[1], $hrefMatches)) {
                $link = $hrefMatches[1];
                foreach ($linksToCheck as $linkToCheck) {
                    if ((@preg_match($linkToCheck, $link) || strpos($link, $linkToCheck) === 0)) {
                        if ($rel === 'dofollow') {
                            if (preg_match('/rel="noopener"/', $matches[0])) {
                                return str_replace('rel="noopener"', 'rel="' . $rel . '"', $matches[0]);
                            } elseif (!preg_match('/rel="/', $matches[0])) {
                                return str_replace('<a ' . $matches[1], '<a ' . $matches[1] . ' rel="' . $rel . '"', $matches[0]);
                            }
                        } else {
                            if (preg_match('/rel="noopener"/', $matches[0])) {
                                return str_replace('rel="noopener"', 'rel="' . $rel . ' noopener"', $matches[0]);
                            } elseif (!preg_match('/rel="/', $matches[0])) {
                                return str_replace('<a ' . $matches[1], '<a ' . $matches[1] . ' rel="' . $rel . ' noopener"', $matches[0]);
                            }
                        }
                    }
                }
            }

            return $matches[0];
        }, $content);
    }

    /**
     * Remove square brackets from the link inside the shortcode.
     * [shortname link="https://example.com/[link]"] => [shortname link="https://example.com/%5Blink%5D"]
     * @param string $content
     * @return string
     */
    public static function parseLinkWithSquareBrackets(string $content): string
    {
        $pattern = '/(\[[^\]]+link=")([^"]*?)(".*?\])/i';

        $replacement = function ($matches) {
            $encodedLink = str_replace(['[', ']'], ['%5B', '%5D'], $matches[2]);
            return $matches[1] . $encodedLink . $matches[3];
        };

        return preg_replace_callback($pattern, $replacement, $content);
    }
}
