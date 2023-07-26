<?php

use Murdercode\LaravelShortcodePlus\LaravelShortcodePlus;

it('can render a button', function () {
    $html = '[button link="https://www.google.com" label="Google"]';
    $parsedHtml = LaravelShortcodePlus::source($html)->parseAll();
    expect($parsedHtml)->toContain('<a class="shortcode_distico primary" href="https://www.google.com">Google</a>');
});

it('can render a button without a link or a label', function () {
    $html = '[button]';
    $parsedHtml = LaravelShortcodePlus::source($html)->parseAll();
    expect($parsedHtml)->toContain('<a class="shortcode_distico primary" href="#">Click here</a>');
});

it('can render a button with a secondary level', function () {
    $html = '[button level="secondary"]';
    $parsedHtml = LaravelShortcodePlus::source($html)->parseAll();
    expect($parsedHtml)->toContain('<a class="shortcode_distico secondary" href="#">Click here</a>');
});
