<?php

use Murdercode\LaravelShortcodePlus\Helpers\Sanitizer;
use Murdercode\LaravelShortcodePlus\LaravelShortcodePlus;

it('can parse widgetbay shortcode', function () {
    $html = '[widgetbay id="1"]';
    $shortcoded = LaravelShortcodePlus::source($html)->parseAll();
    expect($shortcoded)->toContain('<iframe src="https://widgetbay.3labs.it/widgetbox/1"');
});

// it('cannot parse widgetbay shortcode if the id is not defined', function () {
//    $html = '[widgetbay]';
//    $shortcoded = LaravelShortcodePlus::source($html)->parseAll();
//    expect($shortcoded)->toContain('No Widgetbay parameter id defined');
// });
//
// it('cannot parse widgetbay shortcode if the id is not a number', function () {
//    $html = '[widgetbay id="blablabla"]';
//    $shortcoded = LaravelShortcodePlus::source($html)->parseAll();
//    expect($shortcoded)->toContain('No Widgetbay parameter id defined');
// });

it('can parse widgetbay shortcode with link', function () {
    $html = '[widgetbay link="https://www.amazon.it/videocamera-interna-inclinabile-ring-pan-tilt-indoor-camera-videocamera-di-sicurezza-plug-in-per-animali-domestici-panoramica-360-inclinazione-169-ring-protect-30-gg-prova-gratuita/dp/B0CG2TB6H9?pf_rd_r=ZYMJNB4P4DP9X7GQ2BW6&pf_rd_p=6c15f635-e9a3-4dac-b721-b591d05ccd93"]';
    $html = Sanitizer::parseLinkWithSquareBrackets($html);
    $shortcoded = LaravelShortcodePlus::source($html)->parseAll();
    expect($shortcoded)->toContain('<iframe src="https://widgetbay.3labs.it/widgetbox?link=https%3A%2F%2Fwww.amazon.it%2Fvideocamera-interna-inclinabile');
});

it('can parse widgetbay shortcode with link with square brackets', function () {
    $html = '[widgetbay link="https://www.amazon.it/videocamera]-interna-inclinabile-ring-pan-tilt-indoor-camera-videocamera-di-sicurezza-plug-in-per-animali-domestici-panoramica-360-inclinazione-169-ring-protect-30-gg-prova-gratuita/dp/B0CG2TB6H9?pf_rd_r=ZYMJNB4P4DP9X7GQ2BW6&pf_rd_p=6c15f635-e9a3-4dac-b721-b591d05ccd93"]';
    $html = Sanitizer::parseLinkWithSquareBrackets($html);
    $shortcoded = LaravelShortcodePlus::source($html)->parseAll();
    expect($shortcoded)->toContain('<iframe src="https://widgetbay.3labs.it/widgetbox?link=https%3A%2F%2Fwww.amazon.it%2Fvideocamera%255D-interna-inclinabile');
});
