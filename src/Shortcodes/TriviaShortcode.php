<?php

namespace Murdercode\LaravelShortcodePlus\Shortcodes;

use The3labsTeam\NovaTriviaPackage\App\Models\Trivia;

class TriviaShortcode
{
    public function register($shortcode): string
    {
        $trivia = Trivia::find($shortcode->id);

        if (!$trivia) {
            return '';
        }

        return view('shortcode-plus::trivia', compact('trivia'))->render();
    }
}