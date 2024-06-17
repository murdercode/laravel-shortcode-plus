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
            'tv-prefix' => 'tvs',
        ],
        'cache_ttl' => 60 * 60 * 24, // 1 day
        'justwatch_api_key' => env('JUSTWATCH_API_KEY'),
    ],
    'button' => [
        'sponsored' => [
            // If the domain is not in the whitelist, the link will be nofollow
            'whitelist' => ['example.com', 'example2.com'],
        ],
    ],
    'nocookie' => [
        'text' => 'Questo contenuto è ospitato su una piattaforma esterna. Per visualizzarlo, è necessario <a href="javascript:void(0)" class="iubenda-cs-preferences-link">accettare i cookie</a>',
    ],

    'linksToParse' => [
        'sponsored' => [
            '#https://www\\.amazon\\.[A-Za-z]+#i',
            '#https://www\\.ebay\\.[A-Za-z]+#i',
            'https://www.instant-gaming.com',
        ],
        'dofollow' => [
            'https://forum.tomshw.it/',
            'https://forum.spaziogames.it/',
            'https://www.tomshw.it/',
            'https://www.spaziogames.it/',
            'https://cpop.it',
            'https://data4biz.com',
            'https://global.techradar.com/',
            'https://soshomegarden.com',
            'https://aibay.it',
            'https://3labs.it',
        ],
        'nofollow' => [
            'https://www.youtube.com',
            'https://multiplayer.it',
            'https://www.everyeye.it',
        ],
    ],
];
