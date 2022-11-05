<?php

namespace Murdercode\LaravelShortcodePlus;

use Murdercode\LaravelShortcodePlus\Parsers\Facebook;
use Murdercode\LaravelShortcodePlus\Parsers\Faq;
use Murdercode\LaravelShortcodePlus\Parsers\Gallery;
use Murdercode\LaravelShortcodePlus\Parsers\Image;
use Murdercode\LaravelShortcodePlus\Parsers\Spoiler;
use Murdercode\LaravelShortcodePlus\Parsers\Spotify;
use Murdercode\LaravelShortcodePlus\Parsers\Twitter;
use Murdercode\LaravelShortcodePlus\Parsers\Youtube;

final class LaravelShortcodePlus
{
    public static function css(): string
    {
        return '<link rel="stylesheet" href="'.route('shortcode-plus.css').'">';
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
        $this->content = $this->parseFacebookTag();
        $this->content = $this->parseTwitterTag();
        $this->content = $this->parseYoutubeTag();
        $this->content = $this->parseSpotifyTag();
        $this->content = $this->parseFaqTag();
        $this->content = $this->parseSpoilerTag();
        $this->content = $this->parseImageTag();
        $this->content = $this->parseGalleryTag();

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

    public function parseSpotifyTag(): string
    {
        return Spotify::parse($this->content);
    }

    public function parseFaqTag(): string
    {
        return Faq::parse($this->content);
    }

    public function parseSpoilerTag(): string
    {
        return Spoiler::parse($this->content);
    }

    public function parseFacebookTag(): string
    {
        return Facebook::parse($this->content);
    }

    public function parseImageTag(): string
    {
        return Image::parse($this->content);
    }

    public function parseGalleryTag(): string
    {
        return Gallery::parse($this->content);
    }
}
