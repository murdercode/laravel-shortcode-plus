<p align="center"><img src="https://github.com/murdercode/laravel-shortcode-plus/raw/HEAD/art/laravel-shortcode-logo.svg" width="50%" alt="Logo Laravel Shortcode Plus"></p>

[![Latest Version on Packagist](https://img.shields.io/packagist/v/murdercode/laravel-shortcode-plus.svg?style=flat-square)](https://packagist.org/packages/murdercode/laravel-shortcode-plus)
[![GitHub Tests Action Status](https://img.shields.io/github/workflow/status/murdercode/laravel-shortcode-plus/run-tests?label=tests)](https://github.com/murdercode/laravel-shortcode-plus/actions?query=workflow%3Arun-tests+branch%3Amain)
[![GitHub Code Style Action Status](https://img.shields.io/github/workflow/status/murdercode/laravel-shortcode-plus/Fix%20PHP%20code%20style%20issues?label=code%20style)](https://github.com/murdercode/laravel-shortcode-plus/actions?query=workflow%3A"Fix+PHP+code+style+issues"+branch%3Amain)
[![Total Downloads](https://img.shields.io/packagist/dt/murdercode/laravel-shortcode-plus.svg?style=flat-square)](https://packagist.org/packages/murdercode/laravel-shortcode-plus)

---

## How it Works

This package allows you to use shortcodes in your application.

For example, you can use the following shortcode to embed a Youtube video:

```markdown
[youtube id="123456789"]
```

This will be rendered as:

```html

<iframe width="560" height="315" src="https://www.youtube.com/embed/123456789" frameborder="0"
        allow="accelerometer; autoplay; clipboard-write; encrypted-media; gyroscope; picture-in-picture"
        allowfullscreen></iframe>
```

_Note: the example is for purposes of demonstration only. The package apply a lot of optimizations
for better SEO and performance._

---

## Installation

You can install the package via composer:

```bash
composer require murdercode/laravel-shortcode-plus
```

You can publish and run the migrations with:

```bash
php artisan vendor:publish --tag="laravel-shortcode-plus-migrations"
php artisan migrate
```

You can publish the config file with:

```bash
php artisan vendor:publish --tag="laravel-shortcode-plus-config"
```

This is the contents of the published config file:

```php
return [
];
```

Optionally, you can publish the views using

```bash
php artisan vendor:publish --tag="laravel-shortcode-plus-views"
```

## Usage

Laravel Shortcode Plus is shipped with a default CSS for a better user experience. You can add the
following line before your `</head>`:

```php
{!! LaravelShortcodePlus::css() !!}
```

Now you can parse your source as follow:

```php
use Murdercode\ShortcodePlus\Facades\ShortcodePlus;

$html = "I want to parse this twitter tag: [twitter url=\"https://twitter.com/elonmusk/status/1585841080431321088\"]";
return LaravelShortcodePlus::source($html)->parseAll();
```

You can also specify a specific shortcode to parse:

```php
$html = "[twitter url=\"https://twitter.com/elonmusk/status/1585841080431321088\"]";
$twitterOembed = LaravelShortcodePlus::source($html)->parseTwitterTag();
```

## Parsers

Here is the list of the available parsers:

| Parser | Description              | Parameters     | Example                                                                   |
| --- |--------------------------|----------------|---------------------------------------------------------------------------|
| `parseTwitterTag()` | Parse a `[twitter]` tag. | `url`          | `[twitter url="https://twitter.com/elonmusk/status/1585841080431321088"]` |
| `parseYoutubeTag()` | Parse a `[youtube]` tag. | `url`          | `[youtube url="https://www.youtube.com/watch?v=9bZkp7q19f0"]`             |
| `parseSpotifyTag()` | Parse a `[spotify]` tag. | `url` or `uri` | `[spotify url="https://open.spotify.com/track/2TpxZ7JUBn3uw46aR7qd6V"]`   |
| `parseFaqTag()`     | Parse a `[faq]` tag.     | `title`        | `[faq title="What is the answer to the ultimate question?"]42[/faq]`      |
| `parseSpoilerTag()` | Parse a `[spoiler]` tag. | `title`        | `[spoiler title="Spoiler"]This is hidden content[/spoiler]`               |
| `parseFacebookTag()` | Parse a `[facebook]` tag. | `url` | `[facebook url="https://www.facebook.com/elonmusk/posts/10157744420210129"]` |
| `parseImageTag()` | Parse an `[image]` tag. | `id`, `caption` (optional) | `[image id="123"]` |
| `parseGalleryTag()` | Parse a `[gallery]` tag. | `title`, `images`  | Single or multiple images: `[image title="Gallery title here" images="1"]` or `[image title="Gallery title here" images="1,2,3"]` |

### Note for Facebook

Please remember to call the SDK before </body>:

```html

<div id="fb-root"></div>
<script async defer crossorigin="anonymous"
        src="https://connect.facebook.net/en_US/sdk.js#xfbml=1&version=v15.0"
        nonce="UcAjseAO"></script>
```

## Testing

```bash
composer test
```

## Changelog

Please see [CHANGELOG](CHANGELOG.md) for more information on what has changed recently.

## Contributing

Please see [CONTRIBUTING](CONTRIBUTING.md) for details.

## Security Vulnerabilities

Please review [our security policy](../../security/policy) on how to report security
vulnerabilities.

## Credits

- [Stefano Novelli](https://github.com/murdercode)
- [All Contributors](../../contributors)

## License

The MIT License (MIT). Please see [License File](LICENSE.md) for more information.
