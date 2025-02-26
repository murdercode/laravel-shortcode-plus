<?php

use Murdercode\LaravelShortcodePlus\LaravelShortcodePlus;

it('can parse bluesky shortcode', function () {
    $html = '[bluesky url="https://bsky.app/profile/karaswisher.bsky.social/post/3lizqwmwikk2v"]';
    $blueskyOembed = LaravelShortcodePlus::source($html)->parseAll();
    expect($blueskyOembed)->toContain('Kara Swisher');
});

it('can parse bluesky shortcode, even if the url is incorrect', function () {
    $html = '[bluesky url="blablabla"]';
    $blueskyOembed = LaravelShortcodePlus::source($html)->parseAll();
    expect($blueskyOembed)->toContain('No bsky.app URL defined');
});

it('cannot parse bluesky shortcode if the url is not bsky.app', function () {
    $html = '[bluesky url="https://google.com"]';
    $blueskyOembed = LaravelShortcodePlus::source($html)->parseAll();
    expect($blueskyOembed)->toContain('No bsky.app URL defined');
});

it('cannot parse bluesky shortcode if the url is not defined', function () {
    $html = '[bluesky]';
    $blueskyOembed = LaravelShortcodePlus::source($html)->parseAll();
    expect($blueskyOembed)->toContain('No bsky.app parameter url defined');
});

it('cannot get bluesky oembed', function () {
    $html = '[bluesky url="https://bsky.app/profile/karaswisher.bsky.social/post/xxx"]';
    $blueskyOembed = LaravelShortcodePlus::source($html)->parseAll();
    expect($blueskyOembed)->toContain('Cannot get bsky.app oEmbed');
});
