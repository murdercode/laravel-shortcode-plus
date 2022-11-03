<?php

namespace Murdercode\LaravelShortcodePlus\Database\Factories;

use Illuminate\Database\Eloquent\Factories\Factory;
use Murdercode\LaravelShortcodePlus\Models\ShortcodeImage;

class ShortcodeImageFactory extends Factory
{
    protected $model = ShortcodeImage::class;

    public function definition()
    {
        return [
            'path' => basename($this->faker->imageUrl()),
            'title' => $this->faker->sentence,
            'alternative_text' => $this->faker->sentence,
            'caption' => $this->faker->sentence,
            'credits' => $this->faker->sentence,
            'width' => $this->faker->numberBetween(100, 1000),
            'height' => $this->faker->numberBetween(100, 1000),

        ];
    }
}
