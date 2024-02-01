<?php

use Murdercode\LaravelShortcodePlus\LaravelShortcodePlus;

it('can parse widgetbay shortcode', function () {
    $html = '[widgetbay id="1"]';
    $shortcoded = LaravelShortcodePlus::source($html)->parseAll();
    expect($shortcoded)->toContain('<iframe src="https://widgetbay.3labs.it/widgetbox/1"');
});

//it('cannot parse widgetbay shortcode if the id is not defined', function () {
//    $html = '[widgetbay]';
//    $shortcoded = LaravelShortcodePlus::source($html)->parseAll();
//    expect($shortcoded)->toContain('No Widgetbay parameter id defined');
//});
//
//it('cannot parse widgetbay shortcode if the id is not a number', function () {
//    $html = '[widgetbay id="blablabla"]';
//    $shortcoded = LaravelShortcodePlus::source($html)->parseAll();
//    expect($shortcoded)->toContain('No Widgetbay parameter id defined');
//});
