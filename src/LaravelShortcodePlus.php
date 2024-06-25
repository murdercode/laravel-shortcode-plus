<?php

namespace Murdercode\LaravelShortcodePlus;

use Murdercode\LaravelShortcodePlus\Helpers\Sanitizer;
use Murdercode\LaravelShortcodePlus\Parsers\Gallery;
use Murdercode\LaravelShortcodePlus\Parsers\Image;
use Murdercode\LaravelShortcodePlus\Parsers\Index;
use Webwizo\Shortcodes\Facades\Shortcode;

final class LaravelShortcodePlus
{
    public function __construct(protected string $content = '') {}

    public static function source(string $source): LaravelShortcodePlus
    {
        return new self($source);
    }

    /**
     * A function that add heading id to the content.
     */
    public function withAutoHeadingIds()
    {
        $this->content = Index::addIdsToHeadlines($this->content);

        return $this;
    }

    public function forceRel()
    {
        try {
            $this->content = Sanitizer::parseAllLinks($this->content);
        } catch (\Exception $e) {
            // Do nothing
        }

        return $this;
    }

    /**
     * A function that returns the parsed content.
     */
    public function parseAll(): string
    {
        $this->content = Index::parse($this->content);
        $this->content = Image::parse($this->content);
        $this->content = Gallery::parse($this->content);

        return Shortcode::compile($this->content);
    }
}
