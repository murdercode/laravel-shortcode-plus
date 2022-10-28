<?php

use Murdercode\LaravelShortcodePlus\LaravelShortcodePlus;

it('can parse twitter shortcode', function () {
    $html = '[twitter url="https://twitter.com/elonmusk/status/1585841080431321088"]';
    $twitterOembed = LaravelShortcodePlus::source($html)->parseTwitterTag();
    expect($twitterOembed)->toContain('>the bird is freed');
});

it('can parse youtube shortcode', function () {
    $html = '[youtube url="https://www.youtube.com/watch?v=9bZkp7q19f0"]';
    $youtubeOembed = LaravelShortcodePlus::source($html)->parseYoutubeTag();
    expect($youtubeOembed)->toContain('https://www.youtube.com/embed/9bZkp7q19f0');
});
