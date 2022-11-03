<?php

use Murdercode\LaravelShortcodePlus\LaravelShortcodePlus;

it('can parse youtube shortcode', function ()
{
    $html = '[youtube url="https://www.youtube.com/watch?v=9bZkp7q19f0"]';
    $youtubeOembed = LaravelShortcodePlus::source($html)->parseYoutubeTag();
    expect($youtubeOembed)->toContain(
        'src="https://www.youtube-nocookie.com/embed/9bZkp7q19f0&autoplay=1"'
    );
});

it('can parse youtube shortcode, even if the url is incorrect', function ()
{
    $html = '[youtube url="blablabla"]';
    $youtubeOembed = LaravelShortcodePlus::source($html)->parseYoutubeTag();
    expect($youtubeOembed)->toContain('No youtube URL defined');
});

it('cannot parse youtube shortcode if the url is not defined', function ()
{
    $html = '[youtube]';
    $youtubeOembed = LaravelShortcodePlus::source($html)->parseYoutubeTag();
    expect($youtubeOembed)->toContain('[youtube]');
});
