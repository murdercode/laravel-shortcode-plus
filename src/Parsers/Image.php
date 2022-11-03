<?php

namespace Murdercode\LaravelShortcodePlus\Parsers;

use Murdercode\LaravelShortcodePlus\Helpers\Config;

class Image
{
    public static function parse(string $content): string
    {
        return preg_replace_callback(
            '/\[image id="(\d+)"(?:\scaption="(.*?)")?(?:(.*?))\]/',
            function ($matches) {
                $id_image = $matches[1];
                $caption = $matches[2] ? Helper::escapeQuotes($matches[2]) : null;

                $image = Config::getInstance($id_image);

                if (! $image) {
                    return 'Image not found';
                }

                $caption = $caption ?: Config::getValue($image, 'caption') ?: null;
                $credits = Config::getValue($image, 'credits') ?: null;
                $width = Config::getValue($image, 'width') ?: '1920';
                $height = Config::getValue($image, 'height') ?: '1080';
                $path = Config::getValue($image, 'path') ?: null;
                $alternative_text = Config::getValue($image, 'alternative_text') ?: null;
                $title = Config::getValue($image, 'title') ?: null;

                return view('shortcode-plus::image', compact('caption', 'path', 'credits', 'width', 'height', 'alternative_text', 'title'))->render();
            },
            $content
        );
    }
}
