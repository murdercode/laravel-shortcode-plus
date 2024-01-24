<?php

namespace Murdercode\LaravelShortcodePlus\Parsers;

class Index
{
    public static function parse(string $content): string
    {

        return preg_replace_callback(
            '/\[index\]/',
            function ($matches) use($content) {
                $index = self::extractHeadlines($content);
                return view('shortcode-plus::index', compact('index'))->render();
            },
            $content
        );
    }
    public static function extractHeadlines($content)
    {
        //Get all the headlines from the content
        $headlines = [];
        $dom = new \DOMDocument();
        $dom->loadHTML('<?xml encoding="utf-8" ?>'.$content);
        $xpath = new \DOMXPath($dom);
        $headings = $xpath->query('//h2 | //h3 | //h4');
        foreach ($headings as $heading) {
            $headlines[] = [
                'id' => '',
                'title' => $heading->textContent,
                'level' => (int) substr($heading->tagName, 1),
            ];
        }

        return $headlines;
    }

}
