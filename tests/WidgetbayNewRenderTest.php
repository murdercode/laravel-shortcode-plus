<?php

use Murdercode\LaravelShortcodePlus\Livewire\WidgetbayRenderer;
use Murdercode\LaravelShortcodePlus\Shortcodes\WidgetbayShortcode;

beforeEach(function () {
    // Mock della configurazione
    config([
        'shortcode-plus.widgetbay.endpoint' => 'https://widgetbay.3labs.it/widgetbox',
        'shortcode-plus.widgetbay.use_new_render' => false,
    ]);
});

it('can render widgetbay shortcode with traditional iframe method', function () {
    $shortcode = new WidgetbayShortcode;

    $mockShortcode = new stdClass;
    $mockShortcode->link = 'https://example.com/product';

    $result = $shortcode->register($mockShortcode);

    expect($result)->toContain('widgetbay.3labs.it/widgetbox');
});

it('can extract link from shortcode for new rendering', function () {
    $shortcode = new WidgetbayShortcode;

    // Test con link
    $mockShortcode = new stdClass;
    $mockShortcode->link = 'https://example.com/product';

    $reflection = new ReflectionClass($shortcode);
    $method = $reflection->getMethod('extractLinkFromShortcode');
    $method->setAccessible(true);

    $result = $method->invoke($shortcode, $mockShortcode);

    expect($result)->toBe('https://example.com/product');
});

it('can extract link from shortcode ID for new rendering', function () {
    $shortcode = new WidgetbayShortcode;

    // Test con ID
    $mockShortcode = new stdClass;
    $mockShortcode->id = '12345';

    $reflection = new ReflectionClass($shortcode);
    $method = $reflection->getMethod('extractLinkFromShortcode');
    $method->setAccessible(true);

    $result = $method->invoke($shortcode, $mockShortcode);

    expect($result)->toBe('https://widgetbay.3labs.it/widgetbox/12345');
});

it('returns null when no link or id is provided', function () {
    $shortcode = new WidgetbayShortcode;

    $mockShortcode = new stdClass;

    $reflection = new ReflectionClass($shortcode);
    $method = $reflection->getMethod('extractLinkFromShortcode');
    $method->setAccessible(true);

    $result = $method->invoke($shortcode, $mockShortcode);

    expect($result)->toBeNull();
});

it('uses new render when configured', function () {
    // Abilita il nuovo rendering
    config(['shortcode-plus.widgetbay.use_new_render' => true]);

    $shortcode = new WidgetbayShortcode;

    $mockShortcode = new stdClass;
    $mockShortcode->link = 'https://example.com/product';

    $result = $shortcode->register($mockShortcode);

    // Il nuovo rendering dovrebbe utilizzare Livewire
    expect($result)->toContain('widgetbay-renderer');
});

it('supports layout parameter in shortcode', function () {
    config(['shortcode-plus.widgetbay.use_new_render' => true]);

    $shortcode = new WidgetbayShortcode;

    $mockShortcode = new stdClass;
    $mockShortcode->link = 'https://example.com/product';
    $mockShortcode->layout = 'hero';

    $result = $shortcode->register($mockShortcode);

    expect($result)->toContain('widgetbay-renderer')
        ->and($result)->toContain('hero');
});

it('handles multiple products from comma-separated links', function () {
    $shortcode = new WidgetbayShortcode;

    $mockShortcode = new stdClass;
    $mockShortcode->link = 'https://example.com/product1,https://example.com/product2,https://example.com/product3';

    $reflection = new ReflectionClass($shortcode);
    $method = $reflection->getMethod('extractLinkFromShortcode');
    $method->setAccessible(true);

    $result = $method->invoke($shortcode, $mockShortcode);

    // Dovrebbe restituire il link completo con le virgole
    expect($result)->toBe('https://example.com/product1,https://example.com/product2,https://example.com/product3');
});

it('auto-detects layout based on product count estimation', function () {
    config(['shortcode-plus.widgetbay.use_new_render' => true]);

    $shortcode = new WidgetbayShortcode;

    // Test singolo prodotto -> hero
    $mockShortcode = new stdClass;
    $mockShortcode->link = 'https://example.com/product';

    $result = $shortcode->register($mockShortcode);
    expect($result)->toContain('widgetbay-renderer');

    // Test multipli prodotti -> compact/vertical
    $mockShortcode->link = 'https://example.com/product1,https://example.com/product2,https://example.com/product3';

    $result = $shortcode->register($mockShortcode);
    expect($result)->toContain('widgetbay-renderer');
});

it('shows error when no link is provided for new render', function () {
    // Abilita il nuovo rendering
    config(['shortcode-plus.widgetbay.use_new_render' => true]);

    $shortcode = new WidgetbayShortcode;

    $mockShortcode = new stdClass;

    $result = $shortcode->register($mockShortcode);

    expect($result)->toContain('widgetbay-error');
    expect($result)->toContain('parametro link mancante');
});

it('maintains backward compatibility with iframe rendering', function () {
    // Disabilita il nuovo rendering
    config(['shortcode-plus.widgetbay.use_new_render' => false]);

    $shortcode = new WidgetbayShortcode;

    $mockShortcode = new stdClass;
    $mockShortcode->link = 'https://example.com/product';

    $result = $shortcode->register($mockShortcode);

    // Dovrebbe usare iframe
    expect($result)->toContain('widgetbay.3labs.it/widgetbox')
        ->and($result)->not->toContain('widgetbay-renderer');
});

it('supports both id and link parameters', function () {
    $shortcode = new WidgetbayShortcode;

    // Test con ID
    $mockShortcodeId = new stdClass;
    $mockShortcodeId->id = '12345';

    $reflection = new ReflectionClass($shortcode);
    $method = $reflection->getMethod('extractLinkFromShortcode');
    $method->setAccessible(true);

    $resultId = $method->invoke($shortcode, $mockShortcodeId);
    expect($resultId)->toContain('widgetbay.3labs.it/widgetbox/12345');

    // Test con link
    $mockShortcodeLink = new stdClass;
    $mockShortcodeLink->link = 'https://custom.example.com/product';

    $resultLink = $method->invoke($shortcode, $mockShortcodeLink);
    expect($resultLink)->toBe('https://custom.example.com/product');
});

// Test per il componente Livewire WidgetbayRenderer
it('can parse multiple links correctly', function () {
    $renderer = new WidgetbayRenderer;

    $reflection = new ReflectionClass($renderer);
    $method = $reflection->getMethod('parseLinks');
    $method->setAccessible(true);

    // Test link singolo
    $singleLink = 'https://example.com/product';
    $result = $method->invoke($renderer, $singleLink);
    expect($result)->toHaveCount(1)
        ->and($result[0])->toBe('https://example.com/product');

    // Test link multipli
    $multipleLinks = 'https://example.com/product1,https://example.com/product2,https://example.com/product3';
    $result = $method->invoke($renderer, $multipleLinks);
    expect($result)->toHaveCount(3)
        ->and($result[0])->toBe('https://example.com/product1')
        ->and($result[1])->toBe('https://example.com/product2')
        ->and($result[2])->toBe('https://example.com/product3');

    // Test con spazi
    $linksWithSpaces = 'https://example.com/product1, https://example.com/product2 , https://example.com/product3';
    $result = $method->invoke($renderer, $linksWithSpaces);
    expect($result)->toHaveCount(3)
        ->and($result[0])->toBe('https://example.com/product1')
        ->and($result[1])->toBe('https://example.com/product2')
        ->and($result[2])->toBe('https://example.com/product3');
});

it('detects optimal layout based on product count', function () {
    $renderer = new WidgetbayRenderer;

    $reflection = new ReflectionClass($renderer);
    $method = $reflection->getMethod('detectOptimalLayout');
    $method->setAccessible(true);

    // 1 prodotto -> hero
    expect($method->invoke($renderer, 1))->toBe('hero');

    // 2-3 prodotti -> compact
    expect($method->invoke($renderer, 2))->toBe('compact');
    expect($method->invoke($renderer, 3))->toBe('compact');

    // 4+ prodotti -> vertical
    expect($method->invoke($renderer, 4))->toBe('vertical');
    expect($method->invoke($renderer, 10))->toBe('vertical');
});

it('normalizes widget data correctly', function () {
    $renderer = new WidgetbayRenderer;

    $reflection = new ReflectionClass($renderer);
    $method = $reflection->getMethod('normalizeWidgetData');
    $method->setAccessible(true);

    // Mock object data
    $mockData = [
        (object) [
            'title' => 'Test Product <script>alert("xss")</script>',
            'description' => '<p>Description with <strong>HTML</strong></p><script>alert("xss")</script>',
            'price' => '29.99',
            'original_price' => '39.99',
            'image' => 'https://cdn.example.com/image.jpg',
            'link' => 'https://example.com/product',
        ],
    ];

    $result = $method->invoke($renderer, $mockData);

    expect($result)->toHaveCount(1);
    expect($result[0]['title'])->toBe('Test Product');
    expect($result[0]['description'])->toBe('<p>Description with <strong>HTML</strong></p>');
    expect($result[0]['price'])->toBe('29.99€');
    expect($result[0]['original_price'])->toBe('39.99€');
    expect($result[0]['image'])->toContain('https://cdn.example.com/image.jpg');
});

it('sanitizes title correctly', function () {
    $renderer = new WidgetbayRenderer;

    $reflection = new ReflectionClass($renderer);
    $method = $reflection->getMethod('sanitizeTitle');
    $method->setAccessible(true);

    // Test XSS protection
    $maliciousTitle = 'Product Name <script>alert("xss")</script>';
    expect($method->invoke($renderer, $maliciousTitle))->toBe('Product Name');

    // Test length limiting
    $longTitle = str_repeat('Very Long Product Title ', 10);
    $result = $method->invoke($renderer, $longTitle);
    expect(strlen($result))->toBeLessThanOrEqual(103); // 100 + "..."

    // Test null handling
    expect($method->invoke($renderer, null))->toBeNull();
});

it('formats price consistently', function () {
    $renderer = new WidgetbayRenderer;

    $reflection = new ReflectionClass($renderer);
    $method = $reflection->getMethod('formatPrice');
    $method->setAccessible(true);

    // Test numeric price
    expect($method->invoke($renderer, '29.99'))->toBe('29.99€');
    expect($method->invoke($renderer, '29,99'))->toBe('29,99€');

    // Test price with currency
    expect($method->invoke($renderer, '29.99€'))->toBe('29.99€');

    // Test null handling
    expect($method->invoke($renderer, null))->toBeNull();
    expect($method->invoke($renderer, ''))->toBeNull();
});
