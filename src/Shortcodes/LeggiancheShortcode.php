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

        if (!$article) {
            return '';
        }
        return sprintf(
            '<div class="font-sans border-l-[8px] border-red-600 p-4"><span class="uppercase font-bold text-red-600">Leggi anche</span><a class="text-2xl block !no-underline font-bold" href="%s">%s</a></div>',
            $article->route,
            $article->title
        );
    }
}
