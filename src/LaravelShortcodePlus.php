<?php

namespace Murdercode\LaravelShortcodePlus;

use Murdercode\LaravelShortcodePlus\AltShortcodes\ButtonShortcode;
use Murdercode\LaravelShortcodePlus\AltShortcodes\DisticoShortcode;
use Murdercode\LaravelShortcodePlus\AltShortcodes\FacebookShortcode;
use Murdercode\LaravelShortcodePlus\AltShortcodes\InstagramShortcode;
use Murdercode\LaravelShortcodePlus\AltShortcodes\LeggiancheShortcode;
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

    /**
     * Return the content for feed. (Parse button and widgetbay shortcodes to <a> tags)
     */
    public function parseSimpleContent(): string
    {
        $compiler = new ShortcodeCompiler;
        $compiler->add('button', ButtonShortcode::class);

        if (config('shortcode-plus.simpleContent.enable_widgetbay')) {
            $compiler->add('widgetbay', WidgetbayShortcode::class);
        }

        $compiler->enable();

        $this->content = $compiler->compile($this->content);

        return self::cleanHtmlAndShortcodes($this->content);
    }

    /**
     * Cleans the content by removing shortcodes and empty paragraphs.
     *
     * @param  string  $content  The content to be cleaned.
     */
    public static function cleanHtmlAndShortcodes(string $content): string
    {
        $content = preg_replace('/\[.*?]/', '', $content);

        return preg_replace('/<p><\/p>\r\n/', '', $content);
    }

    /**
     * Return the content for Bing Feed.
     */
    public function parseBingContent(): string
    {
        $compiler = new ShortcodeCompiler;
        $compiler->add('button', ButtonShortcode::class);

        if (config('shortcode-plus.bingContent.enable_widgetbay')) {
            $compiler->add('widgetbay', WidgetbayShortcode::class);
        }

        $compiler->add('photo', PhotoShortcode::class);
        $compiler->add('distico', DisticoShortcode::class);
        $compiler->add('leggianche', LeggiancheShortcode::class);
        // SOCIALS
        $compiler->add('facebook', FacebookShortcode::class);
        $compiler->add('instagram', InstagramShortcode::class);
        $compiler->add('twitter', TwitterShortcode::class);
        $compiler->add('reddit', RedditShortcode::class);
        $compiler->add('youtube', YoutubeShortcode::class);
        $compiler->add('tiktok', TikTokShortcode::class);
        $compiler->enable();

        $this->content = $compiler->compile($this->content);

        return self::cleanHtmlAndShortcodes($this->content);
    }
}
