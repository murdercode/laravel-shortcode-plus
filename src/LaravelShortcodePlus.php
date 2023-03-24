<?php

namespace Murdercode\LaravelShortcodePlus;

use Murdercode\LaravelShortcodePlus\Parsers\Facebook;
use Murdercode\LaravelShortcodePlus\Parsers\Faq;
use Murdercode\LaravelShortcodePlus\Parsers\Gallery;
use Murdercode\LaravelShortcodePlus\Parsers\Image;
use Murdercode\LaravelShortcodePlus\Parsers\Instagram;
use Murdercode\LaravelShortcodePlus\Parsers\Spoiler;
use Murdercode\LaravelShortcodePlus\Parsers\Spotify;
use Murdercode\LaravelShortcodePlus\Parsers\Twitter;
use Murdercode\LaravelShortcodePlus\Parsers\Youtube;
use Webwizo\Shortcodes\Facades\Shortcode;

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
        $this->content = $this->parseImageTag();
        $this->content = $this->parseGalleryTag();

        $this->content = Shortcode::compile($this->content);

        return $this->content;
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
