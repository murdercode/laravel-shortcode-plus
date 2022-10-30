<?php

use Murdercode\LaravelShortcodePlus\LaravelShortcodePlus;

it('can parse all shortcodes', function () {
    $source = '[twitter url="https://twitter.com/elonmusk/status/1585841080431321088"]';
    $convertedSource = LaravelShortcodePlus::source($source)->parseAll();
    expect($convertedSource)->toBeString()
        ->and($convertedSource)->toContain('the bird is freed');
});

it('can parse twitter shortcode', function () {
    $html = '[twitter url="https://twitter.com/elonmusk/status/1585841080431321088"]';
    $twitterOembed = LaravelShortcodePlus::source($html)->parseTwitterTag();
    expect($twitterOembed)->toContain('>the bird is freed');
});

it('can parse twitter shortcode, even if the url is incorrect', function () {
    $html = '[twitter url="blablabla"]';
    $twitterOembed = LaravelShortcodePlus::source($html)->parseTwitterTag();
    expect($twitterOembed)->toContain('No twitter URL defined');
});

it('cannot parse twitter shortcode if the url is not defined', function () {
    $html = '[twitter]';
    $twitterOembed = LaravelShortcodePlus::source($html)->parseTwitterTag();
    expect($twitterOembed)->toContain('[twitter]');
});

it('can parse youtube shortcode', function () {
    $html = '[youtube url="https://www.youtube.com/watch?v=9bZkp7q19f0"]';
    $youtubeOembed = LaravelShortcodePlus::source($html)->parseYoutubeTag();
    expect($youtubeOembed)->toContain(
        'https://www.youtube-nocookie.com/embed/9bZkp7q19f0&autoplay=1'
    );
});

it('can parse youtube shortcode, even if the url is incorrect', function () {
    $html = '[youtube url="blablabla"]';
    $youtubeOembed = LaravelShortcodePlus::source($html)->parseYoutubeTag();
    expect($youtubeOembed)->toContain('No youtube URL defined');
});

it('cannot parse youtube shortcode if the url is not defined', function () {
    $html = '[youtube]';
    $youtubeOembed = LaravelShortcodePlus::source($html)->parseYoutubeTag();
    expect($youtubeOembed)->toContain('[youtube]');
});

it('can parse spotify shortcode', function () {
    $html = '[spotify uri="spotify:album:1DFixLWuPkv3KT3TnV35m3"]';
    $spotifyOembed = LaravelShortcodePlus::source($html)->parseSpotifyTag();
    expect($spotifyOembed)->toContain(
        'https://open.spotify.com/embed/album/1DFixLWuPkv3KT3TnV35m3'
    );
});

it('can parse spotify shortcode, even if the uri is incorrect', function () {
    $html = '[spotify uri="blablabla"]';
    $spotifyOembed = LaravelShortcodePlus::source($html)->parseSpotifyTag();
    expect($spotifyOembed)->toContain('No spotify URI defined');
});

it('cannot parse spotify shortcode if the uri is not defined', function () {
    $html = '[spotify]';
    $spotifyOembed = LaravelShortcodePlus::source($html)->parseSpotifyTag();
    expect($spotifyOembed)->toContain('[spotify]');
});

it('can parse faq shortcode', function () {
    $html = '[faq title="What is the difference between a shortcode and a tag?"]Boh![/faq]';
    $faqOembed = LaravelShortcodePlus::source($html)->parseFaqTag();
    expect($faqOembed)
        ->toContain('What is the difference between a shortcode and a tag?')
        ->and($faqOembed)->toContain('Boh!');
});

it('cannot parse faq shortcode if title is missing', function () {
    $html = '[faq]Boh![/faq]';
    $faqOembed = LaravelShortcodePlus::source($html)->parseFaqTag();
    expect($faqOembed)->toContain('[faq]Boh![/faq]');
});

it('can parse spoiler shortcode', function () {
    $html = '[spoiler]This is a spoiler![/spoiler]';
    $spoilerOembed = LaravelShortcodePlus::source($html)->parseSpoilerTag();
    expect($spoilerOembed)->toContain('This is a spoiler!');
});
