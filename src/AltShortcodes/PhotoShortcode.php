<?php

namespace Murdercode\LaravelShortcodePlus\AltShortcodes;

use Outl1ne\NovaMediaHub\Models\Media;

class PhotoShortcode
{
    public function register($shortcode): string
    {
        if (!class_exists('\Outl1ne\NovaMediaHub\Models\Media')) {
            return '';
        }

        $multipleIds = preg_match('/\d+(,\s*\d+)*/', $shortcode->id, $matches) ? $matches[0] : null;
        $ids = explode(',', $multipleIds);

        $images = Media::whereIn('id', $ids)->get();

        //order images by shortcode order
        $images = $images->sortBy(function ($image) use ($ids) {
            return array_search($image->id, $ids);
        });

        $imagesHtml = '';

        foreach ($images as $key => $image) {
            $alt = isset($image['data']['alt']) && ($image['data']['alt'] !== '' || $image['data']['alt'] !== null) ? $image['data']['alt'] : 'Immagine id ' . $image->id;
            $path = $image->url;
            $title = $image['data']['title'] ?? $alt;
            $figCaption = "<figcaption>{$title}</figcaption>";

            $imagesHtml .= "<figure><img src='{$path}' title='{$title}' alt='{$alt}'>{$figCaption}</figure>";
        }


        if (count($ids) > 1) {
            $titleOnGallery = $shortcode->didascalia ? "<title>{$shortcode->didascalia}</title>" : '';
            return "<div class='gallery'>{$titleOnGallery} {$imagesHtml}</div>";
        }

        return $imagesHtml;
    }
}
