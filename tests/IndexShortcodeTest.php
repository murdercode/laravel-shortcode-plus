<?php

use Murdercode\LaravelShortcodePlus\Facades\LaravelShortcodePlus;
use Murdercode\LaravelShortcodePlus\Parsers\Index;

// Tests for Add ids to headings
it('can add ids to headings', function () {
    $html = '<h2>Title</h2> <p>Content</p>';
    $indexedContent = Index::addIdsToHeadlines($html);
    expect($indexedContent)->toContain('<h2 id="title">Title</h2> <p>Content</p>');
});

it('cannot add ids to headings if there is already an id', function () {
    $html = '<h2 id="test">Title</h2> <p>Content</p>';
    $indexedContent = Index::addIdsToHeadlines($html);
    expect($indexedContent)->toContain('<h2 id="test">Title</h2> <p>Content</p>');
});

it('cannot add ids to headings if there are no headings', function () {
    $html = '<p>Content</p>';
    $indexedContent = Index::addIdsToHeadlines($html);
    expect($indexedContent)->toContain('<p>Content</p>');
});

// Tests for Get headings
it('can get headings', function () {
    $html = '<h2>Title</h2> <p>Content</p>';
    [$headings, $indexedContent] = Index::getHeadings($html);
    expect($headings)->toBeArray()
        ->and($headings)->toContain([
            'id' => 'title',
            'title' => 'Title',
            'level' => 2,
            'childrens' => [],
        ])
        ->and($indexedContent)->toContain('<h2>Title</h2> <p>Content</p>');
});

it('can get h2 and h3', function () {
    $html = '<h2>Title</h2> <h3>Subtitle</h3> <p>Content</p>';
    [$headings, $indexedContent] = Index::getHeadings($html);
    expect($headings)->toBeArray()
        ->and($headings)->toContain([
            'id' => 'title',
            'title' => 'Title',
            'level' => 2,
            'childrens' => [
                [
                    'id' => 'subtitle',
                    'title' => 'Subtitle',
                    'level' => 3,
                    'childrens' => [],
                ],
            ],
        ])
        ->and($indexedContent)->toContain('<h2>Title</h2> <h3>Subtitle</h3> <p>Content</p>');
});

it('can get h2 and h4', function () {
    $html = '<h2>Title</h2> <h4>Subtitle</h4> <p>Content</p>';
    [$headings, $indexedContent] = Index::getHeadings($html);
    expect($headings)->toBeArray()
        ->and($headings)->toContain([
            'id' => 'title',
            'title' => 'Title',
            'level' => 2,
            'childrens' => [
                [
                    'id' => 'subtitle',
                    'title' => 'Subtitle',
                    'level' => 4,
                    'childrens' => [],
                ],
            ],
        ])
        ->and($indexedContent)->toContain('<h2>Title</h2> <h4>Subtitle</h4> <p>Content</p>');
});

it('can get articulated structure', function () {
    $html = '<h2>Title</h2> <h3>Subtitle</h3> <h3>Subtitle</h3> <h4>Subtitle</h4> <p>Content</p>';
    [$headings, $indexedContent] = Index::getHeadings($html);
    expect($headings)->toBeArray()
        ->and($headings)->toContain(
            [
                'id' => 'title',
                'title' => 'Title',
                'level' => 2,
                'childrens' => [
                    [
                        'id' => 'subtitle',
                        'title' => 'Subtitle',
                        'level' => 3,
                        'childrens' => [],
                    ],
                    [
                        'id' => 'subtitle',
                        'title' => 'Subtitle',
                        'level' => 3,
                        'childrens' => [
                            [
                                'id' => 'subtitle',
                                'title' => 'Subtitle',
                                'level' => 4,
                                'childrens' => [],
                            ],
                        ],
                    ],
                ],
            ]
        )
        ->and($indexedContent)->toContain('<h2>Title</h2> <h3>Subtitle</h3> <h3>Subtitle</h3> <h4>Subtitle</h4> <p>Content</p>');
});

it('cannot get headings if there are no headings', function () {
    $html = '<p>Content</p>';
    [$headings, $indexedContent] = Index::getHeadings($html);
    expect($headings)->toBeArray()
        ->and($headings)->toBeEmpty()
        ->and($indexedContent)->toContain('<p>Content</p>');
});

// Tests for Index shortcode
it('can parse index shortcode', function () {
    $html = '<h2>Title</h2> <p>Content</p>';
    $indexedContent = LaravelShortcodePlus::source($html)->withHeadingIds()->parseAll();
    expect($indexedContent)->toContain('<h2 id="title">Title</h2>');
});
