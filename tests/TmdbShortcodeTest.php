<?php

use Murdercode\LaravelShortcodePlus\Facades\LaravelShortcodePlus;

it('can render tmdb button', function () {

    $html = '[tmdb type="movie" id="tt0111161"]';
    $parsedHtml = LaravelShortcodePlus::source($html)->parseAll();

    dd($parsedHtml);

});
