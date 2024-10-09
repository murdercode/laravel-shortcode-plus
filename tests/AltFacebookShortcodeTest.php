<?php

use Murdercode\LaravelShortcodePlus\LaravelShortcodePlus;

it('can parse facebook shortcode', function () {
    $html = '[facebook url="https://www.facebook.com/elonmusk/posts/10157710103910177"]';
    $facebookOembed = LaravelShortcodePlus::source($html)->parseBingContent();
    expect($facebookOembed)->toContain(
        '<div class="fb-post" data-href="https://www.facebook.com/elonmusk/posts/10157710103910177"'
    );
});

it('can parse facebook shortcode, even if the url is incorrect', function () {
    $html = '[facebook url="blablabla"]';
    $facebookOembed = LaravelShortcodePlus::source($html)->parseBingContent();
    expect($facebookOembed)->toContain('No Facebook URL found');
});

it('cannot parse facebook shortcode if no url is defined', function () {
    $html = '[facebook]';
    $facebookOembed = LaravelShortcodePlus::source($html)->parseBingContent();
    expect($facebookOembed)->toContain('No Facebook parameter url defined');
});
