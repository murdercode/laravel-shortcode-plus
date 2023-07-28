<?php

return [
    'model' => [
        'image' => [
            // Your model class
            'class' => Murdercode\LaravelShortcodePlus\Models\ShortcodeImage::class,
            'attributes' => [
                'caption' => 'caption',
                'credits' => 'credits',
                'alternative_text' => 'alternative_text',
                'title' => 'title',
                'width' => 'width',
                'height' => 'height',
                'path' => 'path',
            ],
        ],
    ],
    'tmdb' => [
        'api_key' => env('TMDB_API_KEY'),
        'api_version' => '3',
        'language' => 'it',
        'base_uri' => 'https://api.themoviedb.org',
        'image_base_uri' => 'https://image.tmdb.org/t/p',
        'more_link' => [
            'domain' => 'https://example.com',
            'movie-prefix' => 'movies',
            'tv-prefix' => 'tvs'
        ],
        'cache_ttl' => 60 * 60 * 24, // 1 day
        'justwatch_api_key' => env('JUSTWATCH_API_KEY'),
    ],
];
