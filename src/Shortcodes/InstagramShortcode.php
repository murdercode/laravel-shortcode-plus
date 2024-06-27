<?php

namespace Murdercode\LaravelShortcodePlus\Shortcodes;

class InstagramShortcode
{
    public function register($shortcode): string
    {
        $url = $shortcode->url ?? '';

        if (empty($url)) {
            return 'No Instagram parameter url defined';
        }

        if (str_contains($url, 'instagram.com') === false) {
            return 'No Instagram.com URL defined';
        }

        $pathType = self::getPathType($url);

        if (empty($pathType)) {
            return 'No Instagram parameter url defined';
        }

        $post_id = self::getPostId($url);
        $embed_url = 'https://www.instagram.com/' . $pathType . '/' . $post_id;

        return view('shortcode-plus::instagram', compact('embed_url'))->render();
    }

    private static function getPathType($url)
    {
        $isPost = str_contains($url, '/p/');
        $isReel = str_contains($url, '/reel/');

        if ($isPost) {
            return 'p';
        }
        if ($isReel) {
            return 'reel';
        }

        return null;
    }

    private static function getPostId($url)
    {
        $regex = '/\/(?:p|reel)\/([a-zA-Z0-9_-]+)/';
        preg_match($regex, $url, $matches);

        return $matches[1] ?? null;
    }
}
