<?php

namespace Murdercode\LaravelShortcodePlus\Helpers;

use Illuminate\Database\Eloquent\Model;

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

    public static function getInstance(int $id)
    {
        return Config::getImageClass()::find($id);
    }

    public static function getValue(Model $model, string $key)
    {
        return $model->{config(Config::getImageConfigKey().'.attributes.'.$key)};
    }
}
