<?php

namespace Murdercode\LaravelShortcodePlus\Shortcodes;

class FacebookShortcode
{
    public function register($shortcode, $content, $compiler, $name, $viewData)
    {
        $url = $shortcode->url;
        return view('shortcode-plus::facebook', compact('url'))->render();
    }

}
