<?php

use Murdercode\LaravelShortcodePlus\LaravelShortcodePlus;

it('can parse reddit shortcode', function () {
    $html = '[reddit url="https://www.reddit.com/r/aww/comments/owx3x/this_is_my_friend_bob/"]';
    $redditOembed = LaravelShortcodePlus::source($html)->parseBingContent();
    expect($redditOembed)
        ->toContain('<blockquote class="reddit-card"')
        ->toContain('<a href="https://www.reddit.com/r/aww/comments/owx3x/this_is_my_friend_bob/">');
});

it('can parse reddit shortcode with empty url', function () {
    $html = '[reddit url=""]';
    $redditOembed = LaravelShortcodePlus::source($html)->parseBingContent();
    expect($redditOembed)
        ->toContain('<blockquote class="reddit-card"')
        ->toContain('<a href=""></a>');
});
