<?php

use Murdercode\LaravelShortcodePlus\LaravelShortcodePlus;

it('can parse spotify shortcode with uri', function () {
    $html = '[spotify uri="spotify:album:1DFixLWuPkv3KT3TnV35m3"]';
    $spotifyOembed = LaravelShortcodePlus::source($html)->parseSpotifyTag();
    expect($spotifyOembed)->toContain(
        'src="https://open.spotify.com/embed/album/1DFixLWuPkv3KT3TnV35m3"'
    );
});

it('can parse spotify shortcode with url', function () {
    $html = '[spotify url="https://open.spotify.com/album/1DFixLWuPkv3KT3TnV35m3"]';
    $spotifyOembed = LaravelShortcodePlus::source($html)->parseSpotifyTag();
    expect($spotifyOembed)->toContain(
        'src="https://open.spotify.com/embed/album/1DFixLWuPkv3KT3TnV35m3"'
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
