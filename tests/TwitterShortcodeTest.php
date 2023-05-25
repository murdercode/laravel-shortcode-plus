<?php

use Murdercode\LaravelShortcodePlus\LaravelShortcodePlus;

it('can parse twitter shortcode', function () {
    $html = '[twitter url="https://twitter.com/elonmusk/status/1585841080431321088"]';
    $twitterOembed = LaravelShortcodePlus::source($html)->parseAll();
    expect($twitterOembed)->toContain('>the bird is freed');
});

it('can parse twitter shortcode, even if the url is incorrect', function () {
    $html = '[twitter url="blablabla"]';
    $twitterOembed = LaravelShortcodePlus::source($html)->parseAll();
    expect($twitterOembed)->toContain('No Twitter.com URL defined');
});

it('cannot parse twitter shortcode if the url is not twitter.com', function () {
    $html = '[twitter url="https://google.com"]';
    $twitterOembed = LaravelShortcodePlus::source($html)->parseAll();
    expect($twitterOembed)->toContain('No Twitter.com URL defined');
});

it('cannot parse twitter shortcode if the url is not defined', function () {
    $html = '[twitter]';
    $twitterOembed = LaravelShortcodePlus::source($html)->parseAll();
    expect($twitterOembed)->toContain('No Twitter parameter url defined');
});
