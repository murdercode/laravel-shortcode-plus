<?php

use Murdercode\LaravelShortcodePlus\LaravelShortcodePlus;

it('can parse a Sponsored link (amazon.it)', function () {
    $html = '<a href="https://www.amazon.it/WYBOT-Cordless-aspirapolvere-Automatico-interrate/dp/B0B27WRG45">Amazon Link</a>';
    $parsedHtml = LaravelShortcodePlus::source($html)->parseAll();
    expect($parsedHtml)
        ->toContain('<a href="https://www.amazon.it/WYBOT-Cordless-aspirapolvere-Automatico-interrate/dp/B0B27WRG45" rel="sponsored">Amazon Link</a>');
});

it('can parse a Sponsored link (amazon.com)', function () {
    $html = '<a href="https://www.amazon.com/DJI-Mini-RC-Lightweight-Intelligent/dp/B0BL3NZT5D">Amazon.com Link</a>';
    $parsedHtml = LaravelShortcodePlus::source($html)->parseAll();
    expect($parsedHtml)
        ->toContain('<a href="https://www.amazon.com/DJI-Mini-RC-Lightweight-Intelligent/dp/B0BL3NZT5D" rel="sponsored">Amazon.com Link</a>');
});

it('can parse a DoFollow link', function () {
    $html = '<a href="https://forum.tomshw.it/forums/presentati-alla-community.138/">Forum Link</a>';
    $parsedHtml = LaravelShortcodePlus::source($html)->parseAll();
    expect($parsedHtml)
        ->toContain('<a href="https://forum.tomshw.it/forums/presentati-alla-community.138/" rel="dofollow">Forum Link</a>');
});

it('can parse a NoFollow link', function () {
    $html = '<a href="https://www.youtube.com/watch?v=L9G60Mlig2Q&t=4s">Youtube Link</a>';
    $parsedHtml = LaravelShortcodePlus::source($html)->parseAll();
    expect($parsedHtml)
        ->toContain('<a href="https://www.youtube.com/watch?v=L9G60Mlig2Q&t=4s" rel="nofollow">Youtube Link</a>');
});

it('is not possible parse whether the connection already has a rel (sponsored)', function () {
    $html = '<a href="https://www.youtube.com/watch?v=L9G60Mlig2Q&t=4s" rel="sponsored">Youtube Link</a>';
    $parsedHtml = LaravelShortcodePlus::source($html)->parseAll();
    expect($parsedHtml)
        ->toContain('<a href="https://www.youtube.com/watch?v=L9G60Mlig2Q&t=4s" rel="sponsored">Youtube Link</a>');
});


it('is not possible parse whether the connection already has a rel (dofollow)', function () {
    $html = '<a href="https://www.youtube.com/watch?v=L9G60Mlig2Q&t=4s" rel="dofollow">Youtube Link</a>';
    $parsedHtml = LaravelShortcodePlus::source($html)->parseAll();
    expect($parsedHtml)
        ->toContain('<a href="https://www.youtube.com/watch?v=L9G60Mlig2Q&t=4s" rel="dofollow">Youtube Link</a>');
});
