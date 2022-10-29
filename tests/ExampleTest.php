<?php

use Illuminate\View\View;
use Murdercode\LaravelShortcodePlus\LaravelShortcodePlus;

it('can parse all shortcodes', function() {
    $source = "[twitter url=\"https://twitter.com/elonmusk/status/1585841080431321088\"]";
    $convertedSource = LaravelShortcodePlus::source($source)->parseAll();
    expect($convertedSource)->toBeString()
        ->and($convertedSource)->toContain('the bird is freed');
});

it('can parse twitter shortcode', function() {
    $html = "[twitter url=\"https://twitter.com/elonmusk/status/1585841080431321088\"]";
    $twitterOembed = LaravelShortcodePlus::source($html)->parseTwitterTag();
    expect($twitterOembed)->toContain('>the bird is freed');
});

it('can parse twitter shortcode, even if the url is incorrect', function() {
    $html = "[twitter url=\"blablabla\"]";
    $twitterOembed = LaravelShortcodePlus::source($html)->parseTwitterTag();
    expect($twitterOembed)->toContain('No twitter URL defined');
});

it('can parse youtube shortcode', function() {
    $html = "[youtube url=\"https://www.youtube.com/watch?v=9bZkp7q19f0\"]";
    $youtubeOembed = LaravelShortcodePlus::source($html)->parseYoutubeTag();
    expect($youtubeOembed)->toContain('https://www.youtube-nocookie.com/embed/9bZkp7q19f0&autoplay=1');
});

it('can parse youtube shortcode, even if the url is incorrect', function() {
    $html = "[youtube url=\"blablabla\"]";
    $youtubeOembed = LaravelShortcodePlus::source($html)->parseYoutubeTag();
    expect($youtubeOembed)->toContain('No youtube URL defined');
});