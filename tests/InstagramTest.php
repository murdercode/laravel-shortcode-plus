<?php

use Murdercode\LaravelShortcodePlus\LaravelShortcodePlus;

it('can parse instagram shortcode, even if the url is incorrect', function () {
    $html = '[instagram url="blablabla"]';
    $instagramOembed = LaravelShortcodePlus::source($html)->parseAll();
    expect($instagramOembed)->toContain('No Instagram.com URL defined');
});

it('cannot parse instagram shortcode if the url is not instagram.com', function () {
    $html = '[instagram url="https://google.com"]';
    $instagramOembed = LaravelShortcodePlus::source($html)->parseAll();
    expect($instagramOembed)->toContain('No Instagram.com URL defined');
});

it('cannot parse instagram shortcode if the url is not defined', function () {
    $html = '[instagram]';
    $instagramOembed = LaravelShortcodePlus::source($html)->parseAll();
    expect($instagramOembed)->toContain('No Instagram parameter url defined');
});

it('can parse instagram shortcode with reel url', function () {
    $html = '[instagram url="https://www.instagram.com/reel/CQ1Zxq1n1Zq/"]';
    $instagramOembed = LaravelShortcodePlus::source($html)->parseAll();
    expect($instagramOembed)->toContain('<iframe src="https://www.instagram.com/reel/CQ1Zxq1n1Zq/embed"');
});

it('can parse instagram shortcode with post url', function () {
    $html = '[instagram url="https://www.instagram.com/p/CQ1Zxq1n1Zq/"]';
    $instagramOembed = LaravelShortcodePlus::source($html)->parseAll();
    expect($instagramOembed)->toContain('<iframe src="https://www.instagram.com/p/CQ1Zxq1n1Zq/embed"');
});

it('cannot parse instagram shortcode without reel or post url', function () {
    $html = '[instagram url="https://www.instagram.com/"]';
    $instagramOembed = LaravelShortcodePlus::source($html)->parseAll();
    expect($instagramOembed)->toContain('No Instagram parameter url defined');
});
