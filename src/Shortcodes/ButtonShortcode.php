<?php

namespace Murdercode\LaravelShortcodePlus\Shortcodes;

class ButtonShortcode
{
    public function register($shortcode)
    {
        $link = $shortcode->link ?? '#';
        $label = $shortcode->label ?? 'Click here';

        $level = match ($shortcode->level) {
            'secondary' => 'secondary',
            default => 'primary',
        };

        return view('shortcode-plus::button', compact('link', 'label', 'level'))->render();
    }
}
