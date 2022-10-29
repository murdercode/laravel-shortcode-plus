<?php

namespace Murdercode\LaravelShortcodePlus;

use Murdercode\LaravelShortcodePlus\Parsers\Twitter;
use Murdercode\LaravelShortcodePlus\Parsers\Youtube;

class LaravelShortcodePlus
{

    public static function css(): string
    {
        return "<link rel=\"stylesheet\" href=\"" . route('shortcode-plus.css') . "\">";
    }

    public static function source(string $source): static
    {
        return new static($source);
    }

    public function __construct(protected string $content = '')
    {
    }

    public function parseAll(): string
    {
        $this->content = $this->parseTwitterTag();
        $this->content = $this->parseYoutubeTag();
        return $this->content;
    }


    public function parseTwitterTag(): string
    {
        return Twitter::parse($this->content);
    }

    public function parseYoutubeTag(): string
    {
        return Youtube::parse($this->content);
    }

}
