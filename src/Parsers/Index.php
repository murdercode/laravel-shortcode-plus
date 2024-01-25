<?php

namespace Murdercode\LaravelShortcodePlus\Parsers;

use Illuminate\Support\Str;

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

        //If there are no headlines, return empty array and content
        if($headings->count() == 0) {
            return [[], $content];
        }

        foreach ($headings as $heading) {

            //Create and add id to the heading
            $headingId = Str::slug($heading->textContent);
            $heading->setAttribute('id', $headingId);
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
