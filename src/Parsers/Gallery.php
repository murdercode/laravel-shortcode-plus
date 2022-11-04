<?php

namespace Murdercode\LaravelShortcodePlus\Parsers;

use Murdercode\LaravelShortcodePlus\Models\ShortcodeImage;

class Gallery
{
    public static function parse(string $content): string
    {
        return preg_replace_callback(
            '/\[gallery title="(.*?)" images="(.*?)"\]/',
            function ($matches) {
                $title = Helper::escapeQuotes($matches[1]);

                $imagesArray = explode(',', $matches[2]);
                $images = ShortcodeImage::whereIn('id', $imagesArray)->get()->toArray();

                return view('shortcode-plus::gallery', compact('title', 'images'))
                    ->render();
            },
            $content
        );
    }
}
