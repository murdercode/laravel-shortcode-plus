<?php

use Murdercode\LaravelShortcodePlus\LaravelShortcodePlus;

it('can parse reddit shortcode', function () {
    $html = '[reddit url="https://www.reddit.com/r/aww/comments/owx3x/this_is_my_friend_bob/"]';
    $redditOembed = LaravelShortcodePlus::source($html)->parseAll();
    expect($redditOembed)
        ->toContain('<blockquote class="reddit-embed-bq" data-embed-height="500">')
        ->toContain('<a href="https://www.reddit.com/r/aww/comments/owx3x/this_is_my_friend_bob/"></a>');
});

it('can parse reddit shortcode with empty url', function () {
    $html = '[reddit url=""]';
    $redditOembed = LaravelShortcodePlus::source($html)->parseAll();
    expect($redditOembed)
        ->toContain('<blockquote class="reddit-embed-bq" data-embed-height="500">')
        ->toContain('<a href=""></a>');
});
