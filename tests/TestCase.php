<?php

namespace Murdercode\LaravelShortcodePlus\Tests;

use Illuminate\Database\Eloquent\Factories\Factory;
use Livewire\LivewireServiceProvider;
use Murdercode\LaravelShortcodePlus\LaravelShortcodePlusServiceProvider;
use Orchestra\Testbench\TestCase as Orchestra;

class TestCase extends Orchestra
{
    protected function setUp(): void
    {
        parent::setUp();

        Factory::guessFactoryNamesUsing(
            fn(string $modelName
            ) => 'Murdercode\\LaravelShortcodePlus\\Database\\Factories\\' . class_basename(
                    $modelName
                ) . 'Factory'
        );

        $this->loadMigrationsFrom(__DIR__ . '/../database/migrations');
    }

    protected function getPackageProviders($app)
    {
        return [
            LaravelShortcodePlusServiceProvider::class,
            LivewireServiceProvider::class,
        ];
    }

    public function getEnvironmentSetUp($app)
    {
        config()->set('database.default', 'testing');
    }
}
