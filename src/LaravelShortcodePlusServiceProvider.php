<?php

namespace Murdercode\LaravelShortcodePlus;

use Illuminate\Support\Facades\Blade;
use Murdercode\LaravelShortcodePlus\Shortcodes\BlueskyShortcode;
use Murdercode\LaravelShortcodePlus\Shortcodes\ButtonShortcode;
use Murdercode\LaravelShortcodePlus\Shortcodes\DisticoShortcode;
use Murdercode\LaravelShortcodePlus\Shortcodes\FacebookShortcode;
use Murdercode\LaravelShortcodePlus\Shortcodes\FaqShortcode;
use Murdercode\LaravelShortcodePlus\Shortcodes\InstagramShortcode;
use Murdercode\LaravelShortcodePlus\Shortcodes\LeggiancheShortcode;
use Murdercode\LaravelShortcodePlus\Shortcodes\PhotoShortcode;
use Murdercode\LaravelShortcodePlus\Shortcodes\RedditShortcode;
use Murdercode\LaravelShortcodePlus\Shortcodes\SpoilerShortcode;
use Murdercode\LaravelShortcodePlus\Shortcodes\SpotifyShortcode;
use Murdercode\LaravelShortcodePlus\Shortcodes\SurveyShortcode;
use Murdercode\LaravelShortcodePlus\Shortcodes\TikTokShortcode;
use Murdercode\LaravelShortcodePlus\Shortcodes\TmdbShortcode;
use Murdercode\LaravelShortcodePlus\Shortcodes\TriviaShortcode;
use Murdercode\LaravelShortcodePlus\Shortcodes\TwitterShortcode;
use Murdercode\LaravelShortcodePlus\Shortcodes\WidgetbayShortcode;
use Murdercode\LaravelShortcodePlus\Shortcodes\YoutubeShortcode;
use Spatie\LaravelPackageTools\Package;
use Spatie\LaravelPackageTools\PackageServiceProvider;
use Webwizo\Shortcodes\Facades\Shortcode;
use Webwizo\Shortcodes\ShortcodesServiceProvider;

class LaravelShortcodePlusServiceProvider extends PackageServiceProvider
{
    public function configurePackage(Package $package): void
    {
        /*
         * This class is a Package Service Provider
         *
         * More info: https://github.com/spatie/laravel-package-tools
         */
        $package
            ->name('laravel-shortcode-plus')
            ->hasConfigFile()
            ->hasViews()
            ->hasAssets()
            ->hasMigration('create_laravel-shortcode-plus_table');
    }

    public function packageRegistered()
    {
    }

    public function packageBooted(): void
    {
        Blade::componentNamespace(
            'Murdercode\LaravelShortcodePlus\View\Components',
            'laravel-shortcode-plus'
        );

        Blade::componentNamespace(
            'Murdercode\LaravelShortcodePlus\View\Components',
            'laravel-shortcode-plus'
        );
    }

    public function register(): void
    {
        parent::register();
        $this->app->register(ShortcodesServiceProvider::class);

        Shortcode::register('reddit', RedditShortcode::class);
        Shortcode::register('facebook', FacebookShortcode::class);
        Shortcode::register('youtube', YoutubeShortcode::class);
        Shortcode::register('spotify', SpotifyShortcode::class);
        Shortcode::register('instagram', InstagramShortcode::class);
        Shortcode::register('faq', FaqShortcode::class);
        Shortcode::register('spoiler', SpoilerShortcode::class);
        Shortcode::register('twitter', TwitterShortcode::class);
        Shortcode::register('distico', DisticoShortcode::class);
        Shortcode::register('widgetbay', WidgetbayShortcode::class);
        Shortcode::register('leggianche', LeggiancheShortcode::class);
        Shortcode::register('photo', PhotoShortcode::class);
        Shortcode::register('button', ButtonShortcode::class);
        Shortcode::register('tmdb', TmdbShortcode::class);
        Shortcode::register('tiktok', TikTokShortcode::class);
        Shortcode::register('survey', SurveyShortcode::class);
        Shortcode::register('trivia', TriviaShortcode::class);
        Shortcode::register('bluesky', BlueskyShortcode::class);
    }
}
