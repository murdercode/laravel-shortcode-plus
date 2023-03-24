<?php

namespace Murdercode\LaravelShortcodePlus;

use Illuminate\Support\Facades\Blade;
use Murdercode\LaravelShortcodePlus\Shortcodes\FacebookShortcode;
use Murdercode\LaravelShortcodePlus\Shortcodes\FaqShortcode;
use Murdercode\LaravelShortcodePlus\Shortcodes\InstagramShortcode;
use Murdercode\LaravelShortcodePlus\Shortcodes\RedditShortcode;
use Murdercode\LaravelShortcodePlus\Shortcodes\SpoilerShortcode;
use Murdercode\LaravelShortcodePlus\Shortcodes\SpotifyShortcode;
use Murdercode\LaravelShortcodePlus\Shortcodes\TwitterShortcode;
use Murdercode\LaravelShortcodePlus\Shortcodes\YoutubeShortcode;
use Spatie\LaravelPackageTools\Package;
use Spatie\LaravelPackageTools\PackageServiceProvider;
use Webwizo\Shortcodes\Facades\Shortcode;

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
        //->hasCommand(LaravelShortcodePlusCommand::class);
    }

    public function packageRegistered()
    {

    }

    public function packageBooted()
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

    public function register()
    {
        parent::register();
        $this->app->register(\Webwizo\Shortcodes\ShortcodesServiceProvider::class);

        Shortcode::register('reddit', RedditShortcode::class);
        Shortcode::register('facebook', FacebookShortcode::class);
        Shortcode::register('youtube', YoutubeShortcode::class);
        Shortcode::register('spotify', SpotifyShortcode::class);
        Shortcode::register('instagram', InstagramShortcode::class);
        Shortcode::register('faq', FaqShortcode::class);
        Shortcode::register('spoiler', SpoilerShortcode::class);
        Shortcode::register('twitter', TwitterShortcode::class);

    }
}
