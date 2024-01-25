<?php

//
//namespace Murdercode\LaravelShortcodePlus\Shortcodes;
//
//class IndexShortcode
//{
//    public function register($shortcode, $content): string
//    {
//        dd($content);
//        $article = \App\Models\Article::where('slug', $shortcode->slug)->firstOrFail();
//
//        $index = $this->extractHeadlines($article->content);
//
//        return view('shortcode-plus::index', compact('index'))->render();
//    }
//
//    public function extractHeadlines($content)
//    {
//        //Get all the headlines from the content
//        $headlines = [];
//        $dom = new \DOMDocument();
/*        $dom->loadHTML('<?xml encoding="utf-8" ?>'.$content);*/
//        $xpath = new \DOMXPath($dom);
//        $headings = $xpath->query('//h2 | //h3 | //h4');
//        foreach ($headings as $heading) {
//            $headlines[] = [
//                'id' => '',
//                'title' => $heading->textContent,
//                'level' => (int) substr($heading->tagName, 1),
//            ];
//        }
//        return $headlines;
//    }
//
//}
