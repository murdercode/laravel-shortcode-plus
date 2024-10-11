<?php

namespace Murdercode\LaravelShortcodePlus\AltShortcodes;

class DisticoShortcode
{
    public function register($shortcode): string
    {
        $content = $shortcode->content ?? '';

        return "<blockquote>{$content}</blockquote>";
    }
}
