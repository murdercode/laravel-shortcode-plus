<?php

namespace Murdercode\LaravelShortcodePlus\AltShortcodes;

class PhotoShortcode
{
//    public static function parse($content)
//    {
//        return preg_replace_callback(
//            '/\[photo id="(.*?)"(?: didascalia="(.*?)")?.*?\]/',
//            function ($matches) {
//                $id = $matches[1];
//                $didascalia = $matches[2] ?? null;
//
//                $ids = explode(',', $id);
//
//                $imagesHtml = '';
//                $images = \Outl1ne\NovaMediaHub\Models\Media::whereIn('id', $ids)->get();
//
//                foreach ($images as $key => $image) {
//                    $alt = isset($image->data['alt']) && $image->data['alt'] !== null ? $image->data['alt'] : '';
//                    $figCaption = '';
//                    if ($alt) {
//                        $figCaption = "<figcaption>{$alt}</figcaption>";
//                    }
//                    $title = $didascalia ?? ($image->data['title'] ?? '');
//                    $imagesHtml .= "<figure><img src='{$image->path}' title='{$title}' alt='{$alt}'>{$figCaption}</figure>";
//                }
//
//                if (count($images) > 1) { //If gallery, wrap images in Bing Gallery Feed format
//                    $titleOnGallery = $didascalia ? "<title>{$didascalia}</title>" : '';
//                    return "<div class='gallery'>{$titleOnGallery} {$imagesHtml}</div>";
//                }
//
//                return $imagesHtml;
//            },
//            $content
//        );

    public function register($shortcode): string
    {
        if (!class_exists('\Outl1ne\NovaMediaHub\Models\Media')) {
            return '';
        }

        $multipleIds = preg_match('/\d+(,\s*\d+)*/', $shortcode->id, $matches) ? $matches[0] : null;

        if ($multipleIds) {
            $ids = explode(',', $multipleIds);
            if (count($ids) > 1) {
                $images = \Outl1ne\NovaMediaHub\Models\Media::whereIn('id', $ids)->get();

                //order images by shortcode order
                $images = $images->sortBy(function ($image) use ($ids) {
                    return array_search($image->id, $ids);
                });

                $imagesHtml = '';

                foreach ($images as $key => $image) {
                    $alt = $image['data']['alt'] ?? null;
                    $figCaption = $alt ? "<figcaption>{$alt}</figcaption>" : '';
                    $path = $image->path . $image->file_name;
                    $title = $image['data']['title'] ?? null;

                    $imagesHtml .= "<figure><img src='{$path}' title='{$title}' alt='{$alt}'>{$figCaption}</figure>";
                }

                $titleOnGallery = $shortcode->didascalia ? "<title>{$shortcode->didascalia}</title>" : '';
                return "<div class='gallery'>{$titleOnGallery} {$imagesHtml}</div>";
            }
        }

        // Single image
        $media = \Outl1ne\NovaMediaHub\Models\Media::find($shortcode->id);

        if (!$media) {
            return '';
        }


        $alt = $media['data']['alt'] ?? null;
        $figCaption = $alt ? "<figcaption>{$alt}</figcaption>" : '';
        $path = $media->path . $media->file_name;
        $title = $media['data']['title'] ?? null;

        return "<figure><img src='{$path}' title='{$title}' alt='{$alt}'>{$figCaption}</figure>";
    }
}
