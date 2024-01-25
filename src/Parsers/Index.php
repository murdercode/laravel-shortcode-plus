<?php

namespace Murdercode\LaravelShortcodePlus\Parsers;

class Index
{
    public static function parse(string $content): string
    {
        //Get index list and new content with ID
        [$index, $newContent] = self::extractHeadlines($content);

        return preg_replace_callback(
            '/\[index\]/',
            function ($matches) use ($index, $newContent) {
                return view('shortcode-plus::index', compact('index'))->render();
            },
            $newContent
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

            //Create and add id to the heading
            $heading->setAttribute('id', str_replace(' ', '-', strtolower($heading->textContent)));
            $newContent = $dom->saveHTML();

            $headlines[] = [
                'id' => $heading->getAttribute('id'),
                'title' => $heading->textContent,
                'level' => (int) substr($heading->tagName, 1),
            ];
        }

        return [$headlines, $newContent];
    }
}
