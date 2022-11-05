<?php

namespace Murdercode\LaravelShortcodePlus\Parsers;

use Murdercode\LaravelShortcodePlus\Helpers\Sanitizer;

class Faq
{
    public static function parse(string $content): string
    {
        return preg_replace_callback(
            '/\[faq title="(.*?)"](.*?)\[\/faq]/s',
            function ($matches) {
                $title = $matches[1] ? Sanitizer::escapeQuotes($matches[1]) : __(
                    'Show hidden content'
                );
                $content = $matches[2] ?? '';

                return view('shortcode-plus::faq', compact('title', 'content'))->render();
            },
            $content
        );
    }
}
