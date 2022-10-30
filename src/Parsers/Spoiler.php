<?php

namespace Murdercode\LaravelShortcodePlus\Parsers;

class Spoiler
{

    public static function parse(string $content): string
    {
        return preg_replace_callback(
            '/\[spoiler](.*?)\[\/spoiler]/s',
            function ($matches) {
                $content = $matches[1] ?? '';
                $title = __('Spoiler alert') . '! ' . __('Click to reveal');
                return view('shortcode-plus::spoiler', compact('content', 'title'))->render();
            },
            $content
        );
    }

}