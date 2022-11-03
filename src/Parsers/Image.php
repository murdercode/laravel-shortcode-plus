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
                $idImage = $matches[1];
                $caption = $matches[2] ? Helper::escapeQuotes($matches[2]) : null;

                $image = Config::getImageClass()::find($idImage);

                if (! $image) {
                    return 'Image not found';
                }

                $caption = $caption ?: $image->{Config::getImageAttribute('caption')} ?: null;

                $credits = $image->{Config::getImageAttribute('credits')} ?: null;

                $width = $image->{Config::getImageAttribute('width')} ?: '1920';
                $height = $image->{Config::getImageAttribute('height')} ?: '1080';
                $path = $image->{Config::getImageAttribute('path')} ?: null;

                $alternative_text = $image->{Config::getImageAttribute('alternative_text')} ?: null;

                $title = $image->{Config::getImageAttribute('title')} ?: null;

                return view('shortcode-plus::image', compact('caption', 'path', 'credits', 'width', 'height', 'alternative_text', 'title'))->render();
            },
            $content
        );
    }
}
