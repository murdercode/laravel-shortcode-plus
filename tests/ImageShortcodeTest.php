<?php

use Murdercode\LaravelShortcodePlus\LaravelShortcodePlus;
use Murdercode\LaravelShortcodePlus\Models\ShortcodeImage;

it('can parse an image shortcode', function () {
    $image = ShortcodeImage::factory()->create();
    $id = $image->id;
    $path = $image->path;

    $this->assertModelExists($image);

    $html = '[image id="'.$id.'"]';
    $imageOembed = LaravelShortcodePlus::source($html)->parseImageTag();
    expect($imageOembed)->toContain('src="'.asset('storage/'.$path).'"');
});

it('can parse an image shortcode with custom caption', function () {
    $image = ShortcodeImage::factory()->create();
    $id = $image->id;
    $path = $image->path;

    $this->assertModelExists($image);

    $html = '[image id="'.$id.'" caption="This is a custom caption"]';
    $imageOembed = LaravelShortcodePlus::source($html)->parseImageTag();
    expect($imageOembed)->toContain('src="'.asset('storage/'.$path).'"')
        ->and($imageOembed)->toContain('This is a custom caption');
});

it('can parse an image shortcode when an image id is not found', function () {
    $id = 99999;

    $html = '[image id="'.$id.'"]';
    $imageOembed = LaravelShortcodePlus::source($html)->parseImageTag();
    expect($imageOembed)->toContain('');
});
