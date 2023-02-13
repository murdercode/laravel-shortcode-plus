<?php

namespace Murdercode\LaravelShortcodePlus\Helpers;

class ConfigHelper
{
    public static function enableImageModal(): bool
    {
        return config('shortcode-plus.livewire.modal') && config('shortcode-plus.livewire.enabled');
    }
}
