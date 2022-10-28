<?php

namespace Murdercode\LaravelShortcodePlus\Facades;

use Illuminate\Support\Facades\Facade;

/**
 * @see \Murdercode\LaravelShortcodePlus\LaravelShortcodePlus
 */
class LaravelShortcodePlus extends Facade
{
    protected static function getFacadeAccessor()
    {
        return \Murdercode\LaravelShortcodePlus\LaravelShortcodePlus::class;
    }
}
