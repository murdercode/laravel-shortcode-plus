<?php

use Murdercode\LaravelShortcodePlus\LaravelShortcodePlus;

it('can parse twitter shortcode', function () {
    $html = '[twitter url="https://twitter.com/elonmusk/status/1585841080431321088"]';
    $twitterOembed = LaravelShortcodePlus::source($html)->parseBingContent();
    expect($twitterOembed)->toContain('<blockquote class="twitter-tweet"><p lang="en" dir="ltr">the bird is freed');
});

it('can parse twitter shortcode, even if the url is incorrect', function () {
    $html = '[twitter url="blablabla"]';
    $twitterOembed = LaravelShortcodePlus::source($html)->parseBingContent();
    expect($twitterOembed)->toContain('No X.com URL defined');
});

it('cannot parse twitter shortcode if the url is not twitter.com', function () {
    $html = '[twitter url="https://google.com"]';
    $twitterOembed = LaravelShortcodePlus::source($html)->parseBingContent();
    expect($twitterOembed)->toContain('No X.com URL defined');
});

it('cannot parse twitter shortcode if the url is not defined', function () {
    $html = '[twitter]';
    $twitterOembed = LaravelShortcodePlus::source($html)->parseBingContent();
    expect($twitterOembed)->toContain('No X.com parameter url defined');
});

it('cannot get twitter oembed', function () {
    $html = '[twitter url="https://twitter.com/elonmusk/status/000"]';
    $twitterOembed = LaravelShortcodePlus::source($html)->parseBingContent();
    expect($twitterOembed)->toContain('Cannot get X.com oEmbed');
});
