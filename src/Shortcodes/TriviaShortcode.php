<?php

namespace Murdercode\LaravelShortcodePlus\Shortcodes;

class TriviaShortcode
{
    public function register($shortcode): string
    {
        $id = $shortcode->id ?? '';

        return view('shortcode-plus::trivia', compact('id'))->render();
    }
}
