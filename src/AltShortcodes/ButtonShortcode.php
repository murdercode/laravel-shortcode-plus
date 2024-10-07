<?php

namespace Murdercode\LaravelShortcodePlus\AltShortcodes;

class ButtonShortcode
{
    public static function parse($content): string
    {
        return preg_replace_callback(
            '/\[button link="(.*?)" label="(.*?)" .*?\]/',
            function ($matches) {
                $link = $matches[1];
                $label = $matches[2];

                return "<a href='$matches[1]' target='_blank' rel='nofollow noopener sponsored'>$matches[2]</a>";
            },
            $content
        );
    }
}
