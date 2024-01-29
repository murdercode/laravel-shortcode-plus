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
        [$headings, $dom] = self::getHeadings($content);

        //If there are no headlines, return empty array and content
        if ($headings->count() == 0) {
            return [[], $content];
        }

        foreach ($headings as $heading) {

            //Create and add id to the heading
            $headingId = Str::slug($heading->textContent);
            $heading->setAttribute('id', $headingId);
            $newContent = $dom->saveHTML();

            $level = (int) substr($heading->tagName, 1);

            [$lastHeadline, $lastHeadlineKey] = self::getLastHeadline($headlines, []);
            [$lastHeadlineChildren, $lastHeadlineChildrenKey] = self::getLastHeadline($headlines, $lastHeadline);

            // Third level
            if (count($headlines) > 0 && isset($lastHeadlineChildren['level']) && $lastHeadlineChildren['level'] < $level) {
                $headlines[$lastHeadlineKey]['childrens'][$lastHeadlineChildrenKey]['childrens'][] = self::indexTemplate($headingId, $heading->textContent, $level);
            }
            //Second level
            elseif (count($headlines) > 0 && $headlines[$lastHeadlineKey]['level'] < $level) {
                $headlines[$lastHeadlineKey]['childrens'][] = self::indexTemplate($headingId, $heading->textContent, $level);
            }
            //First level
            else {
                $headlines[] = self::indexTemplate($headingId, $heading->textContent, $level);
            }
        }

        return [$headlines, $newContent];
    }

    public static function getHeadings($content)
    {
        $dom = new \DOMDocument();
        $dom->loadHTML('<?xml encoding="utf-8" ?>'.$content);
        $xpath = new \DOMXPath($dom);
        $headings = $xpath->query('//h2 | //h3 | //h4');

        return [$headings, $dom];
    }

    /**
     * Get last headline or last headline children and key, if present.
     */
    protected static function getLastHeadline($headlines, $lastHeadline): array
    {
        $headline = isset($lastHeadline['childrens']) ? end($lastHeadline['childrens']) : end($headlines) ?? [];
        $key = isset($lastHeadline['childrens']) ? array_key_last($lastHeadline['childrens']) : array_key_last($headlines) ?? null;

        return [$headline, $key];
    }

    /**
     * Index template, used to create the index array [id, title, level, childrens]
     */
    protected static function indexTemplate($id, $title, $level): array
    {
        return [
            'id' => $id,
            'title' => $title,
            'level' => $level,
            'childrens' => [],
        ];

    }
}
