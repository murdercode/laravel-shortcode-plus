<?php

use Murdercode\LaravelShortcodePlus\LaravelShortcodePlus;

it('can parse widgetbay shortcode', function () {
    $html = '[widgetbay id="1"]';
    $shortcoded = LaravelShortcodePlus::source($html)->parseAll();
    expect($shortcoded)->toContain('<iframe src="https://widgetbay.3labs.it/widgetbox/1"');
});
