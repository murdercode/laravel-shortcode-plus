<?php

namespace Murdercode\LaravelShortcodePlus;

use Murdercode\LaravelShortcodePlus\AltShortcodes\ButtonShortcode;
use Murdercode\LaravelShortcodePlus\AltShortcodes\FacebookShortcode;
use Murdercode\LaravelShortcodePlus\AltShortcodes\InstagramShortcode;
use Murdercode\LaravelShortcodePlus\AltShortcodes\PhotoShortcode;
use Murdercode\LaravelShortcodePlus\AltShortcodes\RedditShortcode;
use Murdercode\LaravelShortcodePlus\AltShortcodes\TikTokShortcode;
use Murdercode\LaravelShortcodePlus\AltShortcodes\TwitterShortcode;
use Murdercode\LaravelShortcodePlus\AltShortcodes\WidgetbayShortcode;
use Murdercode\LaravelShortcodePlus\AltShortcodes\YoutubeShortcode;
use Murdercode\LaravelShortcodePlus\Helpers\Sanitizer;
use Murdercode\LaravelShortcodePlus\Parsers\Gallery;
use Murdercode\LaravelShortcodePlus\Parsers\Image;
use Murdercode\LaravelShortcodePlus\Parsers\Index;
use Webwizo\Shortcodes\Compilers\ShortcodeCompiler;
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

    public function parseBingContent(): string
    {
        $compiler = new ShortcodeCompiler();
        $compiler->add('button', ButtonShortcode::class);
        $compiler->add('widgetbay', WidgetbayShortcode::class);
        $compiler->add('photo', PhotoShortcode::class);
        //SOCIALS
        $compiler->add('facebook', FacebookShortcode::class);
        $compiler->add('instagram', InstagramShortcode::class);
        $compiler->add('twitter', TwitterShortcode::class);
        $compiler->add('reddit', RedditShortcode::class);
        $compiler->add('youtube', YoutubeShortcode::class);
        $compiler->add('tiktok', TikTokShortcode::class);
        $compiler->enable();

        $this->content = $compiler->compile($this->content);

        $this->content = preg_replace('/\[.*?]/', '', $this->content);
        return preg_replace('/<p><\/p>\r\n/', '', $this->content);
    }
}
