<?php

use Murdercode\LaravelShortcodePlus\Facades\LaravelShortcodePlus;

it('can parse tiktok shortcode', function () {
    $html = '[tiktok url="https://www.tiktok.com/@tomshardwareita/video/7264641716760628513?lang=it-IT"]';
    $tiktokOembed = LaravelShortcodePlus::source($html)->parseAll();
    expect($tiktokOembed)->toContain('Non sappiamo come pensasse di farla franca');
});

it('can parse tiktok shortcode, even if the url is incorrect', function () {
    $html = '[tiktok url="blablabla"]';
    $tiktokOembed = LaravelShortcodePlus::source($html)->parseAll();
    expect($tiktokOembed)->toContain('No tiktok.com URL defined');
});

it('can parse tiktok shortcode if the url is not defined ', function () {
    $html = '[tiktok]';
    $tiktokOembed = LaravelShortcodePlus::source($html)->parseAll();
    expect($tiktokOembed)->toContain('No TikTok parameter url defined');
});

it('cannot get tiktok oembed', function () {
    $html = '[twitter url="https://www.tiktok.com/@tomshardwareita/video/72643?lang=it-IT"]';
    $tiktokOembed = LaravelShortcodePlus::source($html)->parseAll();
    expect($tiktokOembed)->toContain('Cannot get TikTok oembed');
});
