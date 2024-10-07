<?php

namespace Murdercode\LaravelShortcodePlus\AltShortcodes;

class PhotoShortcode
{
    public static function parse($content)
    {
        return preg_replace_callback(
            '/\[photo id="(.*?)"(?: didascalia="(.*?)")?.*?\]/',
            function ($matches) {
                $id = $matches[1];
                $didascalia = $matches[2] ?? null;

                $image = \Outl1ne\NovaMediaHub\Models\Media::find($id);

                $alt = isset($didascalia) && $didascalia !== null ? $didascalia : ($image->data['alt'] !== null ? $image->data['alt'] : '');
                $figCaption = '';
                if ($alt) {
                    $figCaption = "<figcaption>{$alt}</figcaption>";
                }

                return "<figure><img src='{$image->path}' alt='{$alt}'>{$figCaption}</figure>";
            },
            $content
        );

    }
}
