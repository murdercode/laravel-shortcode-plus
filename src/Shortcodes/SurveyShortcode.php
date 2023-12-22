<?php

namespace Murdercode\LaravelShortcodePlus\Shortcodes;

class SurveyShortcode
{
    public function register($shortcode): string
    {
        $ids =explode(',', $shortcode->id) ?? '';

        if (empty($ids)) {
            return 'No Survey parameter id defined';
        }

        return view('shortcode-plus::survey', compact('ids'))->render();
    }
}
