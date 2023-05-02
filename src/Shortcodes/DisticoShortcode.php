<?php

namespace Murdercode\LaravelShortcodePlus\Shortcodes;

class DisticoShortcode
{
    public function register($shortcode)
    {
        $content = $shortcode->content ?? '';

        return view('shortcode-plus::distico', compact('content'))->render();
    }
}
