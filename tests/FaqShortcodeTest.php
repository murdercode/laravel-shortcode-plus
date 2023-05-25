<?php

use Murdercode\LaravelShortcodePlus\LaravelShortcodePlus;

it('can parse faq shortcode', function () {
    $html = '[faq title="What is the difference between a shortcode and a tag?"]Boh![/faq]';
    $faqOembed = LaravelShortcodePlus::source($html)->parseAll();
    expect($faqOembed)->toContain('<summary><span>What is the difference between a shortcode and a tag?</span></summary>')
        ->and($faqOembed)->toContain('<p>Boh!</p>');
});

it('can parse faq shortcode, even if title is missing', function () {
    $html = '[faq]Boh![/faq]';
    $faqOembed = LaravelShortcodePlus::source($html)->parseAll();
    expect($faqOembed)->toContain('Show hidden content');
});
