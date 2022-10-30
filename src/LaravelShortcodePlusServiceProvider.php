<?php

namespace Murdercode\LaravelShortcodePlus;

use Illuminate\Support\Facades\Blade;
use Illuminate\Support\Facades\Route;
use Murdercode\LaravelShortcodePlus\Commands\LaravelShortcodePlusCommand;
use Spatie\LaravelPackageTools\Package;
use Spatie\LaravelPackageTools\PackageServiceProvider;

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

    public function packageRegistered()
    {
        Route::prefix('shortcode-plus')->name('shortcode-plus.')->group(function () {
            Route::get('/style.css', function () {
                $contents = view('shortcode-plus::css.shortcodes')->render();

                return response($contents, 200)->header('Content-Type', 'text/css');
            })
                ->name('css');
        });
    }

    public function packageBooted()
    {
        Blade::componentNamespace('Murdercode\LaravelShortcodePlus\View\Components', 'laravel-shortcode-plus');
    }
}
