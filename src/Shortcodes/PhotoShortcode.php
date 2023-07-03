<?php

namespace Murdercode\LaravelShortcodePlus\Shortcodes;

use Outl1ne\NovaMediaHub\Models\Media as Media;

class PhotoShortcode
{
    public function register($shortcode, $content, $compiler, $name, $viewData)
    {
        $multipleIds = preg_match('/\d+(,\s*\d+)*/', $shortcode->id, $matches) ? $matches[0] : null;

        if (! class_exists('\Outl1ne\NovaMediaHub\Models\Media')) {
            return '';
        }

        // Multiple images
        if ($multipleIds) {
            $ids = explode(',', $multipleIds);
            if (count($ids) > 1) {
                $images = Media::whereIn('id', $ids)->get();
                foreach ($images as $key => $image) {
                    $images[$key]['src'] = $image->path.$image->file_name;
                    $images[$key]['title'] = $image['data']['title'][0] ?? null;
                    $images[$key]['alt'] = $image['data']['alt'][0] ?? null;
                }
                $title = $shortcode->didascalia ?? '';

                return view('shortcode-plus::new-gallery', compact('images', 'title'))->render();
            }
        }

        // Single image
        $media = Media::find($shortcode->id);
        if (! $media) {
            return '';
        }

        $path = $media->path.$media->file_name;
        $align = $shortcode->align ?? null;
        $link = $shortcode->link ? str_replace("'", '%27', $shortcode->link) : null;

        $didascalia = $shortcode->didascalia ?? $media->data['caption'] ?? null;
        // If didascalia is array, get first element
        if (is_array($didascalia)) {
            $didascalia = $didascalia[0];
        }

        $didascalia = htmlentities($didascalia, ENT_QUOTES, 'UTF-8');

        $credits = $media->data['credits'] ?? null;
        if (is_array($credits)) {
            $credits = $credits[0];
        }
        $alt = $media->data['alt'] ?? null;
        if (is_array($alt)) {
            $alt = $alt[0];
        }
        $title = $media->data['title'] ?? null;
        if (is_array($title)) {
            $title = $title[0];
        }

        $maxWidth = preg_match(
            '/max-width="(\d+)"/',
            $shortcode->get(0),
            $matches
        )
            ? $matches[1]
            : 896;

        $maxHeight = preg_match(
            '/max-height="(\d+)"/',
            $shortcode->get(0),
            $matches
        )
            ? $matches[1]
            : null;

        $sizes = self::getImageSizes($path);

        $width = $shortcode->width ?? $maxWidth;
        $height = $shortcode->height ?? $sizes['height'] * ($width / $sizes['width']);

        return view('shortcode-plus::media', compact('path', 'align', 'maxWidth', 'link', 'didascalia', 'credits', 'alt', 'title', 'width', 'height'))->render();
    }

    /**
     * Calculate image sizes based on max width and height
     *
     * @return array
     */
    public static function getImageSizes(string $path)
    {

        // Check if file exists
        if (! file_exists(asset('storage/'.$path))) {
            $sizes['width'] = 0;
            $sizes['height'] = 0;
        }

        // Get image sizes
        $sizes = [];
        $imageSizes = getimagesize(asset('storage/'.$path));
        $sizes['width'] = $imageSizes[0];
        $sizes['height'] = $imageSizes[1];

        return $sizes;
    }
}
