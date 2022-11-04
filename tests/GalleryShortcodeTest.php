<?php

use Murdercode\LaravelShortcodePlus\LaravelShortcodePlus;
use Murdercode\LaravelShortcodePlus\Models\ShortcodeImage;

it('can parse a Gallery shortcode', function () {
    $images = ShortcodeImage::factory(2)->create();

    $html = '[gallery title="This is a custom title" images="'.$images->pluck('id')->implode(',').'"]';

    $paths = $images->pluck('path')->toArray();
    $alternative_texts = $images->pluck('alternative_text')->toArray();

    $content = LaravelShortcodePlus::source($html)->parseGalleryTag();

    expect($content)->toContain('This is a custom title')
        ->and($content)->toContain('src="'.asset('storage/'.$paths[0]).'"')
        ->and($content)->toContain('src="'.asset('storage/'.$paths[1]).'"')
        ->and($content)->toContain('alt="'.$alternative_texts[0].'"')
        ->and($content)->toContain('alt="'.$alternative_texts[1].'"');
});
