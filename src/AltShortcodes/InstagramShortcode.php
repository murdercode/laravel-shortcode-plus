<?php

namespace Murdercode\LaravelShortcodePlus\AltShortcodes;

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

        // embed_url = https://www.instagram.com/p/DA5NKFcouRS
        // <blockquote class="instagram-media" data-instgrm-captioned data-instgrm-permalink="https://www.instagram.com/p/BjxlMSWnMJ-/" data-instgrm-version="8">    <div>        <p><a href="https://www.instagram.com/p/BjxlMSWnMJ-/">Imagine putting 864 servers at the bottom of the ocean #ProjectNatick.</a></p>        <p>A post shared by <a href="https://www.instagram.com/microsoft/">  Microsoft</a> (@microsoft) on <time>Apr 22, 2018 at 11:47am PDT</time></p>    </div></blockquote>

        return '<blockquote class="instagram-media" data-instgrm-captioned data-instgrm-permalink="' . $embed_url . '" data-instgrm-version="8"></blockquote>';
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
