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
}
