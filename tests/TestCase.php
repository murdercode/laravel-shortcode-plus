<?php

namespace Murdercode\LaravelShortcodePlus\Tests;

use Illuminate\Database\Eloquent\Factories\Factory;
use Murdercode\LaravelShortcodePlus\LaravelShortcodePlusServiceProvider;
use Orchestra\Testbench\TestCase as Orchestra;

class TestCase extends Orchestra
{
    protected function setUp(): void
    {
        parent::setUp();

        Factory::guessFactoryNamesUsing(
            fn (string $modelName) => 'Murdercode\\LaravelShortcodePlus\\Database\\Factories\\'.class_basename($modelName).'Factory'
        );
    }

    protected function getPackageProviders($app)
    {
        return [
            LaravelShortcodePlusServiceProvider::class,
        ];
    }

    public function getEnvironmentSetUp($app)
    {
        config()->set('database.default', 'testing');

        /*
        $migration = include __DIR__.'/../database/migrations/create_laravel-shortcode-plus_table.php.stub';
        $migration->up();
        */
    }
}
