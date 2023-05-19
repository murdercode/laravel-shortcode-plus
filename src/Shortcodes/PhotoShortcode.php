<?php

namespace Murdercode\LaravelShortcodePlus\Shortcodes;

use Illuminate\Support\Facades\Blade;
use Outl1ne\NovaMediaHub\Models\Media as Media;

class PhotoShortcode
{
    public function register($shortcode, $content, $compiler, $name, $viewData)
    {
        $multipleIds = preg_match('/\d+(,\s*\d+)*/', $shortcode->id, $matches) ? $matches[0] : null;

        // Multiple images
        if ($multipleIds) {
            $ids = explode(',', $multipleIds);
            if (count($ids) > 1) {
                $images = Media::whereIn('id', $ids)->get();
                foreach ($images as $key => $image) {
                    $images[$key]['src'] = $image->path . $image->file_name;
                    $images[$key]['title'] = $image['data']['title'][0] ?? null;
                    $images[$key]['alt'] = $image['data']['alt'][0] ?? null;
                }
                $title = $shortcode->didascalia ?? '';
//                return Blade::render(
//                    "<x-shortcodes.gallery images='$images' title='$title'></x-shortcodes.gallery>"
//                );

                return view('shortcode-plus::new-gallery', compact('images', 'title'))->render();
            }
        }

        // Single image
        $media = Media::find($shortcode->id);
        if (!$media) {
            return '';
        }
        $path = $media->path . $media->file_name;
        $align = $shortcode->align ?? null;
        $link = $shortcode->link ? str_replace("'", "%27", $shortcode->link) : null;

        $didascalia = $shortcode->didascalia ?? $media->data['caption'] ?? null;
        $didascalia = htmlentities($didascalia, ENT_QUOTES, 'UTF-8');

        $credits = $media->data['credits'] ?? null;
        $alt = $media->data['alt'] ?? null;
        $title = $media->data['title'] ?? null;

        $width = $shortcode->width ?? $maxWidth ?? 1920;
        $height = $shortcode->height ?? $maxHeight ?? 1080;

        $maxWidth = preg_match(
            '/max-width="(\d+)"/',
            $shortcode->get(0),
            $matches
        ) ? $matches[1] : 896;

//        return Blade::render(
//            "<x-articles.shortcodes.media path='$path' align='$align' maxWidth=$maxWidth link='$link' didascalia='$didascalia' credits='$credits' alt='$alt' title='$title'></x-articles.shortcodes.media>"
//        );

        return view('shortcode-plus::media', compact('path', 'align', 'maxWidth', 'link', 'didascalia', 'credits', 'alt', 'title', 'width', 'height'))->render();
    }
}
