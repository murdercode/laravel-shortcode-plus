<?php

use Murdercode\LaravelShortcodePlus\LaravelShortcodePlus;

it('can render a button', function () {
    $html = '[button link="https://example.com" label="Example"]';
    $parsedHtml = LaravelShortcodePlus::source($html)->parseAll();
    expect($parsedHtml)
        ->toContain('<a class="shortcode_button primary" href="https://example.com"')
        ->toContain('target="_blank"')
        ->toContain('Example');
});

it('can render a button without a link or a label', function () {
    $html = '[button]';
    $parsedHtml = LaravelShortcodePlus::source($html)->parseAll();
    expect($parsedHtml)
        ->toContain('<a class="shortcode_button primary" href="#"')
        ->toContain('Click here');

});

it('can render a button with a secondary level', function () {
    $html = '[button level="secondary"]';
    $parsedHtml = LaravelShortcodePlus::source($html)->parseAll();
    expect($parsedHtml)->toContain('<a class="shortcode_button secondary"');
});

it('can render a button if the domain is not in the whitelist', function () {
    $html = '[button link="https://google.com" label="Google"]';
    $parsedHtml = LaravelShortcodePlus::source($html)->parseAll();
    expect($parsedHtml)
        ->toContain('<a class="shortcode_button primary" href="https://google.com"')
        ->toContain('target="_blank"')
        ->toContain('rel="nofollow noopener sponsored"')
        ->toContain('Google');
});

it('can render a button if the config whitelist is not set', function () {
    config(['shortcode-plus.button.sponsored.whitelist' => null]);
    $html = '[button link="https://google.com" label="Google"]';
    $parsedHtml = LaravelShortcodePlus::source($html)->parseAll();
    expect($parsedHtml)
        ->toContain('<a class="shortcode_button primary" href="https://google.com"')
        ->toContain('target="_blank"')
        ->toContain('rel="nofollow noopener sponsored"')
        ->toContain('Google');
});
