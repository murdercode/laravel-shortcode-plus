<?php

namespace Murdercode\LaravelShortcodePlus\Shortcodes;

class PhotoShortcode
{
    public function register($shortcode): string
    {
        if (! class_exists('\Outl1ne\NovaMediaHub\Models\Media')) {
            return '';
        }

        $multipleIds = preg_match('/\d+(,\s*\d+)*/', $shortcode->id, $matches) ? $matches[0] : null;

        if ($multipleIds) {
            $ids = explode(',', $multipleIds);
            if (count($ids) > 1) {
                $images = \Outl1ne\NovaMediaHub\Models\Media::whereIn('id', $ids)->get();
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
        $media = \Outl1ne\NovaMediaHub\Models\Media::find($shortcode->id);
        if (! $media) {
            return '';
        }

        $path = $media->path.$media->file_name;
        $align = $shortcode->align ?? null;
        $link = $shortcode->link ? str_replace("'", '%27', $shortcode->link) : null;

        $didascalia = $shortcode->didascalia ?? $media->data['caption'] ?? null;

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

        $width = $shortcode->width ?? $maxWidth;
        $height = $shortcode->height ?? self::getImageHeight($path, $width);

        return view('shortcode-plus::media', compact('path', 'align', 'maxWidth', 'link', 'didascalia', 'credits', 'alt', 'title', 'width', 'height'))->render();
    }

    /**
     * Calculate image sizes based on max width and height
     */
    public static function getImageHeight(string $path, int $width = 0): float|int
    {

        $localPath = storage_path('app/public/'.$path);

        // Check if file exists
        if (! file_exists($localPath)) {
            return 0;
        }

        // Get image sizes
        $sizes = [];
        $imageSizes = @getimagesize($localPath);
        $sizes['width'] = $imageSizes[0];
        $sizes['height'] = $imageSizes[1];

        // Calculate height
        return $sizes['height'] * $width / $sizes['width'];
    }
}
