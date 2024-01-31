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
    $html = '<h2 id="my-id">Title</h2> <p>Content</p>';
    $headings = Index::getHeadings($html);
    expect($headings)->toBeArray()
        ->and($headings)->toContain([
            'id' => 'my-id',
            'title' => 'Title',
            'level' => 2,
            'childrens' => [],
        ]);
});

it('cannot get headings if there is no id', function () {
    $html = '<h2>Title</h2> <p>Content</p>';
    $headings = Index::getHeadings($html);
    expect($headings)->toBeArray()->toBeEmpty();
});

it('can get an h2 with id and cannot take h3 without id', function () {
    $html = '<h2 id="my-id">Title</h2> <h3>Subtitle</h3> <p>Content</p>';
    $headings = Index::getHeadings($html);
    expect($headings)->toBeArray()
        ->and($headings)->toContain([
            'id' => 'my-id',
            'title' => 'Title',
            'level' => 2,
            'childrens' => [],
        ]);
});

it('can get h2 and h3', function () {
    $html = '<h2 id="title">Title</h2> <h3 id="subtitle">Subtitle</h3> <p>Content</p>';
    $headings = Index::getHeadings($html);
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
        ]);
});

it('can get h2 and h4', function () {
    $html = '<h2 id="title">Title</h2> <h4 id="subtitle">Subtitle</h4> <p>Content</p>';
    $headings = Index::getHeadings($html);
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
        ]);
});

it('can get articulated structure', function () {
    $html = '<h2 id="title">Title</h2> <h3 id="subtitle">Subtitle</h3> <h3 id="subtitle-2">Subtitle 2</h3> <h4 id="sub-subtitle">Subtitle</h4> <p>Content</p>';
    $headings = Index::getHeadings($html);
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
                [
                    'id' => 'subtitle-2',
                    'title' => 'Subtitle 2',
                    'level' => 3,
                    'childrens' => [
                        [
                            'id' => 'sub-subtitle',
                            'title' => 'Subtitle',
                            'level' => 4,
                            'childrens' => [],
                        ],
                    ],
                ],
            ],
        ]);
});

it('cannot get headings if there are no headings', function () {
    $html = '<p>Content</p>';
    $headings = Index::getHeadings($html);
    expect($headings)->toBeArray()
        ->and($headings)->toBeEmpty();
});

it('can get headings without childrens', function () {
    $html = '<h2 id="title">Title</h2> <h3 id="subtitle">Subtitle</h3> <p>Content</p>';
    $headings = Index::getHeadings($html, false);
    expect($headings)->toBeArray()
        ->toContain([
            'id' => 'title',
            'title' => 'Title',
            'level' => 2,
            'childrens' => [],
        ])
        ->toContain([
            'id' => 'subtitle',
            'title' => 'Subtitle',
            'level' => 3,
            'childrens' => [],
        ]);
});

// Tests for Index shortcode
it('can add ids to headlines', function () {
    $html = '<h2>Title</h2> <p>Content</p>';
    $indexedContent = LaravelShortcodePlus::source($html)->withAutoHeadingIds()->parseAll();
    expect($indexedContent)->toContain('<h2 id="title">Title</h2> <p>Content</p>');
});

it('can parse index shortcode without adding automatic ids', function () {
    $html = '<h2 id="test">Title</h2> <p>Content</p> [index]';
    $indexedContent = LaravelShortcodePlus::source($html)->parseAll();
    // Remove all spaces and new lines
    $indexedContent = str_replace("\n", '', $indexedContent);
    $indexedContent = preg_replace('/\s+/', ' ', $indexedContent);
    expect($indexedContent)->toContain('<h2 id="test">Title</h2> <p>Content</p> <ul class="shortcode_index"> <li class="level-2"> <a href="#test"> Title </a> </li> </ul>');
});

it('can parse index shortcode with adding automatic ids', function () {
    $html = '<h2>Title</h2> <p>Content</p> [index]';
    $indexedContent = LaravelShortcodePlus::source($html)->withAutoHeadingIds()->parseAll();
    // Remove all spaces and new lines
    $indexedContent = str_replace("\n", '', $indexedContent);
    $indexedContent = preg_replace('/\s+/', ' ', $indexedContent);
    expect($indexedContent)->toContain('<h2 id="title">Title</h2> <p>Content</p> <ul class="shortcode_index"> <li class="level-2"> <a href="#title"> Title </a> </li> </ul>');
});

it('can parse index shortcode with adding automatic ids and h2 plus h3', function () {
    $html = '<h2>Title</h2> <h3>Subtitle</h3> <p>Content</p> [index]';
    $indexedContent = LaravelShortcodePlus::source($html)->withAutoHeadingIds()->parseAll();
    // Remove all spaces and new lines
    $indexedContent = str_replace("\n", '', $indexedContent);
    $indexedContent = preg_replace('/\s+/', ' ', $indexedContent);
    expect($indexedContent)->toContain('<h2 id="title">Title</h2> <h3 id="subtitle">Subtitle</h3> <p>Content</p> <ul class="shortcode_index"> <li class="level-2"> <a href="#title"> Title </a> <ul> <li class="level-3"> <a href="#subtitle"> Subtitle </a> </li> </ul> </li> </ul>');
});

it('can parse index shortcode with adding automatic ids and h2 plus h4', function () {
    $html = '<h2>Title</h2> <h4>Subtitle</h4> <p>Content</p> [index]';
    $indexedContent = LaravelShortcodePlus::source($html)->withAutoHeadingIds()->parseAll();
    // Remove all spaces and new lines
    $indexedContent = str_replace("\n", '', $indexedContent);
    $indexedContent = preg_replace('/\s+/', ' ', $indexedContent);
    expect($indexedContent)->toContain('<h2 id="title">Title</h2> <h4 id="subtitle">Subtitle</h4> <p>Content</p> <ul class="shortcode_index"> <li class="level-2"> <a href="#title"> Title </a> <ul> <li class="level-4"> <a href="#subtitle"> Subtitle </a> </li> </ul> </li> </ul>');
});
