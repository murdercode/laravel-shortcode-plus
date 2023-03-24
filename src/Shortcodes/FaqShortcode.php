<?php

namespace Murdercode\LaravelShortcodePlus\Shortcodes;

class FaqShortcode
{

    public function register($shortcode, $content, $compiler, $name, $viewData) {

        $title = $shortcode->title ?? __('Show hidden content');
        $content = $shortcode->content ?? '';

        return view('shortcode-plus::faq', compact('title', 'content'))->render();

    }

}