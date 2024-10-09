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

                $ids = explode(',', $id);

                $imagesHtml = '';
                $images = \Outl1ne\NovaMediaHub\Models\Media::whereIn('id', $ids)->get();

                foreach ($images as $key => $image) {
                    $alt = isset($image->data['alt']) && $image->data['alt'] !== null ? $image->data['alt'] : '';
                    $figCaption = '';
                    if ($alt) {
                        $figCaption = "<figcaption>{$alt}</figcaption>";
                    }
                    $title = $didascalia ?? ($image->data['title'] ?? '');
                    $imagesHtml .= "<figure><img src='{$image->path}' title='{$title}' alt='{$alt}'>{$figCaption}</figure>";
                }

                if (count($images) > 1) { //If gallery, wrap images in Bing Gallery Feed format
                    $titleOnGallery = $didascalia ? "<title>{$didascalia}</title>" : '';
                    return "<div class='gallery'>{$titleOnGallery} {$imagesHtml}</div>";
                }

                return $imagesHtml;
            },
            $content
        );

    }
}
