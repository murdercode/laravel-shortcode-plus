<?php

namespace Murdercode\LaravelShortcodePlus\Parsers;

use Murdercode\LaravelShortcodePlus\Helpers\ConfigHelper;
use Murdercode\LaravelShortcodePlus\Helpers\ModelHelper;
use Murdercode\LaravelShortcodePlus\Helpers\Sanitizer;

class Image
{
    public static function parse(string $content): string
    {
        $enable_modal = ConfigHelper::enableImageModal();

        return preg_replace_callback(
            '/\[image id="(\d+)"(?:\scaption="(.*?)")?(?:(.*?))\]/',
            function ($matches) use ($enable_modal) {
                $id_image = $matches[1];
                $caption = $matches[2] ? Sanitizer::escapeQuotes($matches[2]) : null;

                $model = new ModelHelper('image');
                $image = $model->getModelClass()::find($id_image);

                if (! $image) {
                    return 'Image not found';
                }

                $model->setModelInstance($image);
                $caption = $caption ?: $model->getValueFromInstance('caption') ?: null;
                $credits = $model->getValueFromInstance('credits') ?: null;
                $width = $model->getValueFromInstance('width') ?: '1920';
                $height = $model->getValueFromInstance('height') ?: '1080';
                $path = $model->getValueFromInstance('path') ?: null;
                $alternative_text = $model->getValueFromInstance('alternative_text') ?: null;
                $title = $model->getValueFromInstance('title') ?: null;

                return view(
                    'shortcode-plus::image',
                    compact(
                        'caption',
                        'path',
                        'credits',
                        'width',
                        'height',
                        'alternative_text',
                        'title',
                        'enable_modal'
                    )
                )->render();
            },
            $content
        );
    }
}
