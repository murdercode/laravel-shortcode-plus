<?php

namespace Murdercode\LaravelShortcodePlus\Shortcodes;

class LeggiancheShortcode
{
    public function register($shortcode): string
    {

        $id = preg_match('/\d+/', $shortcode->get('id'), $matches) ? $matches[0] : null;

        if (class_exists('\App\Models\Article')) {
            $article = \App\Models\Article::find($id);
        } elseif (class_exists('\App\Models\Post')) {
            $article = \App\Models\Post::find($id);
        } else {
            $article = null;
        }

        if (! isset($article)) {
            return '';
        }

        $title = $article->title ?? '';
        $route = $article->route ?? '';

        return view('shortcode-plus::leggianche', compact('title', 'route'))->render();
    }
}
