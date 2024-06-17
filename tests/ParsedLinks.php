<?php

use Murdercode\LaravelShortcodePlus\LaravelShortcodePlus;

// === SPONSORED (regex) ===
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

it('can parse a Sponsored link (ebay.it)', function () {
    $html = '<a href="https://www.ebay.it/itm/256462052414?_trkparms=5373:0%7C5374:Featured">Ebay Link</a>';
    $parsedHtml = LaravelShortcodePlus::source($html)->parseAll();
    expect($parsedHtml)
        ->toContain('<a href="https://www.ebay.it/itm/256462052414?_trkparms=5373:0%7C5374:Featured" rel="sponsored">Ebay Link</a>');
});

it('can parse a Sponsored link (ebay.com)', function () {
    $html = '<a href="https://www.ebay.com/itm/364847373184?_trkparms=5373:0%7C5374:Featured">Ebay.com Link</a>';
    $parsedHtml = LaravelShortcodePlus::source($html)->parseAll();
    expect($parsedHtml)
        ->toContain('<a href="https://www.ebay.com/itm/364847373184?_trkparms=5373:0%7C5374:Featured" rel="sponsored">Ebay.com Link</a>');
});

// === DOFOLLOW LINKS ===
it('can parse a DoFollow link', function () {
    $html = '<a href="https://forum.tomshw.it/forums/presentati-alla-community.138/">Forum Link</a>';
    $parsedHtml = LaravelShortcodePlus::source($html)->parseAll();
    expect($parsedHtml)
        ->toContain('<a href="https://forum.tomshw.it/forums/presentati-alla-community.138/" rel="dofollow">Forum Link</a>');
});

// === NOFOLLOW LINKS ===
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

// === LINK WITH DEFAULT REL ===
it('is not possible parse whether the connection already has a rel (youtube with dofollow)', function () {
    $html = '<a href="https://www.youtube.com/watch?v=L9G60Mlig2Q&t=4s" rel="dofollow">Youtube Link</a>';
    $parsedHtml = LaravelShortcodePlus::source($html)->parseAll();
    expect($parsedHtml)
        ->toContain('<a href="https://www.youtube.com/watch?v=L9G60Mlig2Q&t=4s" rel="dofollow">Youtube Link</a>');
});

it('is not possible parse whether the connection already has a rel (amazon with nofollow)', function () {
    $html = '<a href="https://www.amazon.it/WYBOT-Cordless-aspirapolvere-Automatico-interrate/dp/B0B27WRG45" rel="nofollow">Amazon Link</a>';
    $parsedHtml = LaravelShortcodePlus::source($html)->parseAll();
    expect($parsedHtml)
        ->toContain('<a href="https://www.amazon.it/WYBOT-Cordless-aspirapolvere-Automatico-interrate/dp/B0B27WRG45" rel="nofollow">Amazon Link</a>');
});
