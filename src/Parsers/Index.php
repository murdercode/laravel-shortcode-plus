<?php

namespace Murdercode\LaravelShortcodePlus\Parsers;

use Illuminate\Support\Str;

class Index
{
    /**
     * This method will parse the [index] shortcode.
     */
    public static function parse(string $content): string
    {
        // Get index list and new content with ID
        $index = self::getHeadings($content);

        return preg_replace_callback(
            '/\[index]/',
            function ($matches) use ($index, $content) {
                return view('shortcode-plus::index', compact('index'))->render();
            },
            $content
        );
    }

    /**
     * This method will extract the headlines from the content.
     * And return the headlines with a tree structure.
     */
    public static function getHeadings(string $content, bool $showChildren = true): array
    {
        // Get all the headlines from the content
        $headings = [];

        // Regex pattern to get all the headlines
        $pattern = '/<(h[1-6])(.*?)id="(.*?)"(.*?)>(.*?)<\/h[1-6]>/';

        // If there are no headlines, return empty array
        if (! preg_match_all($pattern, $content, $matches)) {
            return [];
        }

        // Generate the headlines array
        foreach ($matches[1] as $key => $value) {
            $headings[] = [
                'id' => $matches[3][$key],
                'title' => $matches[5][$key],
                'level' => (int) Str::substr($matches[1][$key], 1),
                'childrens' => [],
            ];
        }

        // Generate the tree structure
        return $showChildren ? self::generateTree($headings) : $headings;
    }

    protected static function generateTree($headings)
    {
        $headlines = [];

        foreach ($headings as $heading) {

            $level = $heading['level'];
            [$lastHeadline, $lastHeadlineKey] = self::getLastHeadline($headlines, []);
            [$lastHeadlineChildren, $lastHeadlineChildrenKey] = self::getLastHeadline($headlines, $lastHeadline);

            // Third level
            if (count($headlines) > 0 && isset($lastHeadlineChildren['level']) && $lastHeadlineChildren['level'] < $level) {
                $headlines[$lastHeadlineKey]['childrens'][$lastHeadlineChildrenKey]['childrens'][] = $heading;
            }
            // Second level
            elseif (count($headlines) > 0 && $headlines[$lastHeadlineKey]['level'] < $level) {
                $headlines[$lastHeadlineKey]['childrens'][] = $heading;
            }
            // First level
            else {
                $headlines[] = $heading;
            }
        }

        return $headlines;
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
     * This method will add id to the headlines.
     */
    public static function addIdsToHeadlines(string $content): string
    {
        if (! preg_match('/<h[1-6]/', $content)) {
            return $content;
        }

        $pattern = '/<(h[1-6])(.*?)>(.*?)<\/h[1-6]>/';

        return preg_replace_callback($pattern, function ($matches) {
            // Check if id already exists
            if (str_contains($matches[2], 'id=')) {
                return $matches[0]; // Return the whole match without changes
            }

            $title = $matches[3];
            $id = strip_tags(Str::slug($title));

            return "<$matches[1]$matches[2] id=\"$id\">$title</$matches[1]>";
        }, $content);
    }
}
