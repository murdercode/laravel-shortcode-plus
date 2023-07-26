<?php

namespace Murdercode\LaravelShortcodePlus\Shortcodes;

class RedditShortcode
{
    public function register($shortcode): string
    {

        $url = $shortcode->url;

        return view('shortcode-plus::reddit', compact('url'))->render();
    }
}
