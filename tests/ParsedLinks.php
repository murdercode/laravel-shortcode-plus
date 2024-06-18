<?php

use Murdercode\LaravelShortcodePlus\LaravelShortcodePlus;

it('can parse a sponsored link (amazon.it)', function () {
    $html = '<a href="https://www.amazon.it/WYBOT-Cordless-aspirapolvere-Automatico-interrate/dp/B0B27WRG45">Amazon Link</a>';
    $parsedHtml = LaravelShortcodePlus::source($html)->forceRel()->parseAll();
    expect($parsedHtml)
        ->toContain('<a href="https://www.amazon.it/WYBOT-Cordless-aspirapolvere-Automatico-interrate/dp/B0B27WRG45" rel="sponsored">Amazon Link</a>');
});

it('can parse a sponsored link (amazon.com)', function () {
    $html = '<a href="https://www.amazon.com/DJI-Mini-RC-Lightweight-Intelligent/dp/B0BL3NZT5D">Amazon.com Link</a>';
    $parsedHtml = LaravelShortcodePlus::source($html)->forceRel()->parseAll();
    expect($parsedHtml)
        ->toContain('<a href="https://www.amazon.com/DJI-Mini-RC-Lightweight-Intelligent/dp/B0BL3NZT5D" rel="sponsored">Amazon.com Link</a>');
});

it('can parse a sponsored link (ebay.it)', function () {
    $html = '<a href="https://www.ebay.it/itm/256462052414?_trkparms=5373:0%7C5374:Featured">Ebay Link</a>';
    $parsedHtml = LaravelShortcodePlus::source($html)->forceRel()->parseAll();
    expect($parsedHtml)
        ->toContain('<a href="https://www.ebay.it/itm/256462052414?_trkparms=5373:0%7C5374:Featured" rel="sponsored">Ebay Link</a>');
});

it('can parse a sponsored link (ebay.com)', function () {
    $html = '<a href="https://www.ebay.com/itm/364847373184?_trkparms=5373:0%7C5374:Featured">Ebay.com Link</a>';
    $parsedHtml = LaravelShortcodePlus::source($html)->forceRel()->parseAll();
    expect($parsedHtml)
        ->toContain('<a href="https://www.ebay.com/itm/364847373184?_trkparms=5373:0%7C5374:Featured" rel="sponsored">Ebay.com Link</a>');
});

// === DOFOLLOW LINKS ===
it('can parse a doFollow link', function () {
    $html = '<a href="https://forum.tomshw.it/forums/presentati-alla-community.138/">Forum Link</a>';
    $parsedHtml = LaravelShortcodePlus::source($html)->forceRel()->parseAll();
    expect($parsedHtml)
        ->toContain('<a href="https://forum.tomshw.it/forums/presentati-alla-community.138/" rel="dofollow">Forum Link</a>');
});

// === NOFOLLOW LINKS ===
it('can parse a nofollow link', function () {
    $html = '<a href="https://www.youtube.com/watch?v=L9G60Mlig2Q&t=4s">Youtube Link</a>';
    $parsedHtml = LaravelShortcodePlus::source($html)->forceRel()->parseAll();
    expect($parsedHtml)
        ->toContain('<a href="https://www.youtube.com/watch?v=L9G60Mlig2Q&t=4s" rel="nofollow">Youtube Link</a>');
});

it('cannot parse rel already sponsored', function () {
    $html = '<a href="https://www.youtube.com/watch?v=L9G60Mlig2Q&t=4s" rel="sponsored">Youtube Link</a>';
    $parsedHtml = LaravelShortcodePlus::source($html)->forceRel()->parseAll();
    expect($parsedHtml)
        ->toContain('<a href="https://www.youtube.com/watch?v=L9G60Mlig2Q&t=4s" rel="sponsored">Youtube Link</a>');
});

// === LINK WITH DEFAULT REL ===
it('cannot parse rel already dofollow', function () {
    $html = '<a href="https://www.youtube.com/watch?v=L9G60Mlig2Q&t=4s" rel="dofollow">Youtube Link</a>';
    $parsedHtml = LaravelShortcodePlus::source($html)->forceRel()->parseAll();
    expect($parsedHtml)
        ->toContain('<a href="https://www.youtube.com/watch?v=L9G60Mlig2Q&t=4s" rel="dofollow">Youtube Link</a>');
});

it('cannot parse rel already nofollow', function () {
    $html = '<a href="https://www.amazon.it/WYBOT-Cordless-aspirapolvere-Automatico-interrate/dp/B0B27WRG45" rel="nofollow">Amazon Link</a>';
    $parsedHtml = LaravelShortcodePlus::source($html)->forceRel()->parseAll();
    expect($parsedHtml)
        ->toContain('<a href="https://www.amazon.it/WYBOT-Cordless-aspirapolvere-Automatico-interrate/dp/B0B27WRG45" rel="nofollow">Amazon Link</a>');
});
