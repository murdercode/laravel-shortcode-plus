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

        return self::parseLink($content, $linksToParse);
    }

    protected static function parseLink(string $content, array $linksToParse)
    {
        // Create an associative array for more efficient lookups
        $linksToRel = [];
        foreach ($linksToParse as $rel => $links) {
            foreach ($links as $link) {
                $linksToRel[$link] = $rel;
            }
        }

        // Use DOMDocument for parsing HTML
        $doc = new \DOMDocument();
        @$doc->loadHTML($content, LIBXML_HTML_NOIMPLIED | LIBXML_HTML_NODEFDTD);

        // Iterate over all 'a' elements
        $aElements = $doc->getElementsByTagName('a');
        foreach ($aElements as $a) {
            $href = $a->getAttribute('href');
            $oldRel = $a->getAttribute('rel');

            foreach ($linksToRel as $link => $rel) {
                if (@preg_match($link, $href)) {

                    if ($rel === 'sponsored' || $rel === 'nofollow') {
                        $rel .= ' noopener';
                    }

                    if ($oldRel === 'nofollow' || $oldRel === 'dofollow' || $oldRel === 'sponsored') {
                        $a->setAttribute('rel', $oldRel); //return the old rel
                    } else {
                        $a->setAttribute('rel', $rel); // set the new rel
                    }

                    break;
                }
            }
        }

        // Return the modified HTML
        return htmlspecialchars_decode($doc->saveHTML());
    }

}
