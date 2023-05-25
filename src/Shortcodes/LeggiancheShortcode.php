<?php

namespace Murdercode\LaravelShortcodePlus\Shortcodes;

class LeggiancheShortcode
{
    public function register($shortcode, $content, $compiler, $name, $viewData)
    {
        $id = preg_match('/\d+/', $shortcode->get('id'), $matches) ? $matches[0] : null;

        // If App\Models\Article is not found, try \App\Models\Post
        if (class_exists('\App\Models\Article')) {
            $article = \App\Models\Article::find($id);
        } else {
            $article = \App\Models\Post::find($id);
        }

        if (! $article) {
            return '';
        }

        $title = $article->title;
        $route = $article->route;

        return view('shortcode-plus::leggianche', compact('title', 'route'))->render();
    }
}
