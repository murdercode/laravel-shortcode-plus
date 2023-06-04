<?php

it('can escape double quotes', function () {
    $content = 'This is a "test" string';
    $escaped = \Murdercode\LaravelShortcodePlus\Helpers\Sanitizer::escapeQuotes($content);
    expect($escaped)->toBe('This is a &quot;test&quot; string');
});

it('can escape quotes', function () {
    $content = "This is a 'test' string";
    $escaped = \Murdercode\LaravelShortcodePlus\Helpers\Sanitizer::escapeQuotes($content);
    expect($escaped)->toBe('This is a &#39;test&#39; string');
});

it('can escape quotes and double quotes', function () {
    $content = "This is a 'test' string with \"double quotes\"";
    $escaped = \Murdercode\LaravelShortcodePlus\Helpers\Sanitizer::escapeQuotes($content);
    expect($escaped)->toBe('This is a &#39;test&#39; string with &quot;double quotes&quot;');
});

it('can escape null', function () {
    $content = null;
    $escaped = \Murdercode\LaravelShortcodePlus\Helpers\Sanitizer::escapeQuotes($content);
    expect($escaped)->toBe('');
});

it('can escape empty string', function () {
    $content = '';
    $escaped = \Murdercode\LaravelShortcodePlus\Helpers\Sanitizer::escapeQuotes($content);
    expect($escaped)->toBe('');
});

it('can escape empty string with spaces', function () {
    $content = '   ';
    $escaped = \Murdercode\LaravelShortcodePlus\Helpers\Sanitizer::escapeQuotes($content);
    expect($escaped)->toBe('   ');
});
