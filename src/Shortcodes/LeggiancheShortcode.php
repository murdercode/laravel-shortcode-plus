<?php

namespace Murdercode\LaravelShortcodePlus\Shortcodes;

use App\Models\Article;
use App\Models\Post;

class LeggiancheShortcode
{
    public function register($shortcode): string
    {

        $id = preg_match('/\d+/', $shortcode->get('id'), $matches) ? $matches[0] : null;

        // If App\Models\Article is not found, try \App\Models\Post
        if (class_exists('\App\Models\Article')) {
            $article = Article::find($id);
        } elseif (class_exists('\App\Models\Post')) {
            $article = Post::find($id);
        }

        if (! isset($article)) {
            return '';
        }

        $title = $article->title ?? '';
        $route = $article->route ?? '';

        return view('shortcode-plus::leggianche', compact('title', 'route'))->render();
    }
}
