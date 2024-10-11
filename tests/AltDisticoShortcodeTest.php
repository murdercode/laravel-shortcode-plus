<?php

use Murdercode\LaravelShortcodePlus\LaravelShortcodePlus;

it('can parse distico shortcode', function () {
    $html = '[distico]Lorem ipsum dolor sit amet, consectetur adipiscing elit. Sed non risus. Suspendisse lectus tortor, dignissim sit amet, adipiscing nec, ultricies sed, dolor.[/distico]';
    $distico = LaravelShortcodePlus::source($html)->parseBingContent();
    expect($distico)->toContain('<blockquote');
    expect($distico)->toContain('Lorem ipsum dolor sit amet, consectetur adipiscing elit. Sed non risus. Suspendisse lectus tortor, dignissim sit amet, adipiscing nec, ultricies sed, dolor.');
    expect($distico)->toContain('</blockquote>');
});

it('can parse distico shortcode with empty content', function () {
    $html = '[distico][/distico]';
    $distico = LaravelShortcodePlus::source($html)->parseBingContent();
    expect($distico)->toContain('');
});
