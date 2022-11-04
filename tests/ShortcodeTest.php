<?php

use Murdercode\LaravelShortcodePlus\LaravelShortcodePlus;

it('can parse all shortcodes', function () {
    $source = '[twitter url="https://twitter.com/elonmusk/status/1585841080431321088"]';
    $convertedSource = LaravelShortcodePlus::source($source)->parseAll();
    expect($convertedSource)->toBeString()
        ->and($convertedSource)->toContain('the bird is freed');
});
