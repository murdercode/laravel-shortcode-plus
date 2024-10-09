<?php

use Murdercode\LaravelShortcodePlus\LaravelShortcodePlus;

it('can render a button', function () {
    $html = '[button link="https://example.com" label="Example"]';
    $parsedHtml = LaravelShortcodePlus::source($html)->parseBingContent();
    expect($parsedHtml)
        ->toContain("<a href='https://example.com'")
        ->toContain("target='_blank'")
        ->toContain("rel='nofollow noopener sponsored'")
        ->toContain('Example');
});

it('can render a button without a link or a label', function () {
    $html = '[button]';
    $parsedHtml = LaravelShortcodePlus::source($html)->parseBingContent();
    expect($parsedHtml)
        ->toContain("<a href='#'")
        ->toContain("rel='nofollow noopener sponsored'")
        ->toContain("Click here");

});

it('can render a button without label', function () {
    $html = '[button link="https://example.com"]';
    $parsedHtml = LaravelShortcodePlus::source($html)->parseBingContent();
    expect($parsedHtml)
        ->toContain("<a href='https://example.com'")
        ->toContain("target='_blank'")
        ->toContain("rel='nofollow noopener sponsored'")
        ->toContain("Click here");
});
