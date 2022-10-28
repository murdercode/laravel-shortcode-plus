<?php

namespace Murdercode\LaravelShortcodePlus;

use Illuminate\Support\Facades\Blade;
use Spatie\LaravelPackageTools\Package;
use Spatie\LaravelPackageTools\PackageServiceProvider;
use Murdercode\LaravelShortcodePlus\Commands\LaravelShortcodePlusCommand;

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
            ->hasMigration('create_laravel-shortcode-plus_table')
            ->hasCommand(LaravelShortcodePlusCommand::class);
    }

    public function packageBooted()
    {
        Blade::componentNamespace('Murdercode\LaravelShortcodePlus\View\Components', 'laravel-shortcode-plus');
    }
}
