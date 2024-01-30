<?php

namespace Murdercode\LaravelShortcodePlus;

use Murdercode\LaravelShortcodePlus\Parsers\Gallery;
use Murdercode\LaravelShortcodePlus\Parsers\Image;
use Murdercode\LaravelShortcodePlus\Parsers\Index;
use Webwizo\Shortcodes\Facades\Shortcode;

final class LaravelShortcodePlus
{
    public function __construct(protected string $content = '')
    {
    }

    public static function source(string $source): LaravelShortcodePlus
    {
        return new self($source);
    }

    /**
     * A function that add heading id to the content.
     */
    public function withHeadingIds()
    {
        $this->content = Index::parse($this->content);
    }

    /**
     * A function that returns the parsed content.
     */
    public function parseAll(): string
    {
        $this->content = Image::parse($this->content);
        $this->content = Gallery::parse($this->content);

        return Shortcode::compile($this->content);
    }
}
