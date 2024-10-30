<?php

use Murdercode\LaravelShortcodePlus\LaravelShortcodePlus;

it('can parse youtube shortcode', function () {
    $html = '[youtube url="https://www.youtube.com/watch?v=9bZkp7q19f0"]';
    $youtubeOembed = LaravelShortcodePlus::source($html)->parseBingContent();
    expect($youtubeOembed)
        ->toContain('iframe width="100%" height="100%"')
        ->toContain('https://www.youtube.com/embed/9bZkp7q19f0?rel=0');
});

it('can parse youtube shortcode, even if the url is incorrect', function () {
    $html = '[youtube url="blablabla"]';
    $youtubeOembed = LaravelShortcodePlus::source($html)->parseBingContent();
    expect($youtubeOembed)
        ->toContain('iframe width="100%" height="100%"')
        ->toContain('https://www.youtube.com/embed/lablabla?rel=0');
});

it('cannot parse youtube shortcode if the url is not defined', function () {
    $html = '[youtube link="https://www.youtube.com/watch?v=9bZkp7q19f0"]';
    $youtubeOembed = LaravelShortcodePlus::source($html)->parseBingContent();
    expect($youtubeOembed)->toContain('No Youtube parameter url defined');
});
