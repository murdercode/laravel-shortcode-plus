<?php

use Murdercode\LaravelShortcodePlus\LaravelShortcodePlus;

it('can parse twitter shortcode', function() {
    $html = "[twitter url=\"https://twitter.com/elonmusk/status/1585841080431321088\"]";
    $twitterOembed = LaravelShortcodePlus::source($html)->parseTwitterTag();
    expect($twitterOembed)->toContain('<blockquote class="twitter-tweet" data-conversation="none" data-dnt="true" data-theme="light">');
});
