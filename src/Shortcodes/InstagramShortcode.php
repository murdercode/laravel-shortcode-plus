<?php

namespace Murdercode\LaravelShortcodePlus\Shortcodes;

class InstagramShortcode
{

    public function register($shortcode, $content, $compiler, $name, $viewData)
    {
        $url = $shortcode->url;
        $post_id = self::getPostId($url);
        $embed_url = 'https://www.instagram.com/'.self::getPathType($url).'/'.$post_id.'/embed';
        return view('shortcode-plus::instagram', compact('embed_url'))->render();

    }

    private static function getPostId($url)
    {
        $regex = '/\/(?:p|reel)\/([a-zA-Z0-9_-]+)/';
        preg_match($regex, $url, $matches);
        return $matches[1] ?? null;
    }

    private static function getPathType($url)
    {
        [$isPost, $isReel] = [str_contains($url, 'reel'), str_contains($url, 'p')];
        if ($isPost) {
            return 'p';
        }
        if ($isReel) {
            return 'reel';
        }
        return null;
    }

}