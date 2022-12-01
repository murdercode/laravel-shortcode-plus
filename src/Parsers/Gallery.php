<?php

namespace Murdercode\LaravelShortcodePlus\Parsers;

use Murdercode\LaravelShortcodePlus\Helpers\ModelHelper;
use Murdercode\LaravelShortcodePlus\Helpers\Sanitizer;
use Murdercode\LaravelShortcodePlus\Helpers\ConfigHelper;

class Gallery
{
    public static function parse(string $content): string
    {
        $enable_modal = ConfigHelper::enableImageModal();

        return preg_replace_callback(
            '/\[gallery title="(.*?)" images="(.*?)"\]/',
            function ($matches) use ($enable_modal)
            {
                $title = Sanitizer::escapeQuotes($matches[1]);

                $imagesArray = explode(',', $matches[2]);

                $model = new ModelHelper('image');
                $images = $model->getModelClass()::whereIn('id', $imagesArray)->get()->toArray();

                return view('shortcode-plus::gallery', compact('title', 'images', 'enable_modal'))
                    ->render();
            },
            $content
        );
    }
}
