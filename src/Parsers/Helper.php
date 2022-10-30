<?php

namespace Murdercode\LaravelShortcodePlus\Parsers;

class Helper
{
    public static function escapeQuotes(string|null $content): string
    {
        if ($content == null) {
            return '';
        }
        $content = str_replace('"', '&quot;', $content);
        $content = str_replace("'", '&#39;', $content);

        return $content;
    }
}