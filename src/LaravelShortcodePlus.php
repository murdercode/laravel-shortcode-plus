<?php

namespace Murdercode\LaravelShortcodePlus;

use Murdercode\LaravelShortcodePlus\Parsers\Gallery;
use Murdercode\LaravelShortcodePlus\Parsers\Image;
use Webwizo\Shortcodes\Facades\Shortcode;

final class LaravelShortcodePlus
{
    public static function css(): string
    {
        return '<link rel="stylesheet" href="'.route('shortcode-plus.css').'">';
    }

    public static function source(string $source): static
    {
        return new self($source);
    }

    public function __construct(protected string $content = '')
    {
    }

    /**
     * A function that returns the parsed content.
     *
     * @return string
     */
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
