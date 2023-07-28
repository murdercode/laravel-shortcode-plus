<?php

namespace Murdercode\LaravelShortcodePlus\Tests;

use Illuminate\Database\Eloquent\Factories\Factory;
use Murdercode\LaravelShortcodePlus\LaravelShortcodePlusServiceProvider;
use Orchestra\Testbench\TestCase as Orchestra;

class TestCase extends Orchestra
{
    public function getEnvironmentSetUp($app)
    {
        config()->set('database.default', 'testing');

        // Get .env from .env.testing
        $envPath = __DIR__.'/../.env.testing';
        if (file_exists($envPath)) {
            $dotenv = \Dotenv\Dotenv::createImmutable(__DIR__.'/../', '.env.testing');
            $dotenv->load();
        }

        // Get TMDB API key from .env
        $tmdbApiKey = env('TMDB_API_KEY');
        config()->set('shortcode-plus.tmdb.api_key', $tmdbApiKey);

    }

    protected function setUp(): void
    {
        parent::setUp();

        Factory::guessFactoryNamesUsing(
            fn (
                string $modelName
            ) => 'Murdercode\\LaravelShortcodePlus\\Database\\Factories\\'.class_basename(
                $modelName
            ).'Factory'
        );

        $this->loadMigrationsFrom(__DIR__.'/../database/migrations');
    }

    protected function getPackageProviders($app)
    {
        return [
            LaravelShortcodePlusServiceProvider::class,
        ];
    }
}
