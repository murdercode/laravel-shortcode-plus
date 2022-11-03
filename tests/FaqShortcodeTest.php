<?php

use Murdercode\LaravelShortcodePlus\LaravelShortcodePlus;


it('can parse faq shortcode', function ()
{
    $html = '[faq title="What is the difference between a shortcode and a tag?"]Boh![/faq]';
    $faqOembed = LaravelShortcodePlus::source($html)->parseFaqTag();
    expect($faqOembed)
        ->toContain('What is the difference between a shortcode and a tag?')
        ->and($faqOembed)->toContain('Boh!');
});

it('cannot parse faq shortcode if title is missing', function ()
{
    $html = '[faq]Boh![/faq]';
    $faqOembed = LaravelShortcodePlus::source($html)->parseFaqTag();
    expect($faqOembed)->toContain('[faq]Boh![/faq]');
});
