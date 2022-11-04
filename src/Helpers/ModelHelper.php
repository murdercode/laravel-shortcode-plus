<?php

namespace Murdercode\LaravelShortcodePlus\Helpers;

use Illuminate\Database\Eloquent\Model;

class ModelHelper
{
    private static function getImageConfigKey()
    {
        return 'shortcode-plus.model.image';
    }

    public static function getImageClass()
    {
        return config(ModelHelper::getImageConfigKey().'.class');
    }

    public static function getInstance(int $id)
    {
        return ModelHelper::getImageClass()::find($id);
    }

    public static function getValue(Model $model, string $key)
    {
        return $model->{config(ModelHelper::getImageConfigKey().'.attributes.'.$key)};
    }
}
