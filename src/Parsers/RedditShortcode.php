<?php

namespace Murdercode\LaravelShortcodePlus\Parsers;

class RedditShortcode
{

    public function register($shortcode, $content, $compiler, $name, $viewData)
    {
        $url = $shortcode->url;
        return view('shortcode-plus::reddit', compact('url'))->render();
    }

}