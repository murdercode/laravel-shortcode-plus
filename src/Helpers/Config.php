<?php

namespace Murdercode\LaravelShortcodePlus\Helpers;

class Config
{
    private static function getImageConfigKey()
    {
        return 'shortcode-plus.model.image';
    }

    public static function getImageClass()
    {
        return config(Config::getImageConfigKey().'.class');
    }

    public static function getImageAttribute(string $key)
    {
        return config(Config::getImageConfigKey().'.attributes.'.$key);
    }
}
