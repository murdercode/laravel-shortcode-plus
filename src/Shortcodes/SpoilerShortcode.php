<?php

namespace Murdercode\LaravelShortcodePlus\Shortcodes;

class SpoilerShortcode
{
    public function register($shortcode): string
    {

        $title = $shortcode->title ?? __('Show hidden content');
        $content = $shortcode->content ?? '';

        return view('shortcode-plus::spoiler', compact('title', 'content'))->render();

    }
}
