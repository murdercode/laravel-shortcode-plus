<?php

use Murdercode\LaravelShortcodePlus\Facades\LaravelShortcodePlus;

it('can render tmdb button', function () {

    $html = '[tmdb type="movie" id="tt0111161"]';
    $parsedHtml = LaravelShortcodePlus::source($html)->parseAll();

    expect($parsedHtml)
        ->toContain('img src="https://image.tmdb.org/t/p/w154/9OxcvTJwZDjQTFvY2NxiwnSrQS6.jpg"')
        ->toContain('Le ali della libertà (1994)')
        ->toContain('<a href="https://example.com/movies/tt0111161"');
})->skip();

it('can render tmdb button with tv type', function () {
    $html = '[tmdb type="tv" id="2004"]';
    $parsedHtml = LaravelShortcodePlus::source($html)->parseAll();

    expect($parsedHtml)
        ->toContain('https://image.tmdb.org/t/p/w154/kkEyQQro7M0Avxfiio81alDPdTd.jpg"')
        ->toContain('Malcolm (2000)')
        ->toContain('<a href="https://example.com/tvs/2004"');
})->skip();
