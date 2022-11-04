<?php

use Murdercode\LaravelShortcodePlus\LaravelShortcodePlus;

it('can parse spoiler shortcode', function () {
    $html = '[spoiler]This is a spoiler![/spoiler]';
    $spoilerOembed = LaravelShortcodePlus::source($html)->parseSpoilerTag();
    expect($spoilerOembed)->toContain('This is a spoiler!');
});
