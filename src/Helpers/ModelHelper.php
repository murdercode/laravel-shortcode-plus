<?php

namespace Murdercode\LaravelShortcodePlus\Helpers;

class ModelHelper
{
    private $config_key;

    private $model;

    public function __construct(string $class_name)
    {
        $this->config_key = 'shortcode-plus.model.' . strtolower($class_name);
        $this->model = null;
    }

    public function getModelClass()
    {
        return config($this->config_key . '.class');
    }

    public function setModelInstance($model)
    {
        $this->model = $model;
    }

    public function getValueFromInstance(string $field)
    {
        if (!$this->model) {
            return null;
        }

        return $this->model->{config($this->config_key . '.attributes.' . $field)};
    }
}
