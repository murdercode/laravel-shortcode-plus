<p align="center"><img src="https://github.com/murdercode/laravel-shortcode-plus/raw/HEAD/art/laravel-shortcode-logo.svg" width="50%" alt="Logo Laravel Shortcode Plus"></p>

[![Latest Version on Packagist](https://img.shields.io/packagist/v/murdercode/laravel-shortcode-plus.svg?style=flat-square)](https://packagist.org/packages/murdercode/laravel-shortcode-plus)
[![GitHub Tests Action Status](https://img.shields.io/github/actions/workflow/status/murdercode/laravel-shortcode-plus/run-tests.yml?branch=main&label=pest)](https://github.com/murdercode/laravel-shortcode-plus/actions?query=workflow%3Arun-tests+branch%3Amain)
[![GitHub PHPStan](https://img.shields.io/github/actions/workflow/status/murdercode/laravel-shortcode-plus/phpstan.yml?branch=main&label=phpstan)](https://github.com/murdercode/laravel-shortcode-plus/actions?query=workflow%3Aphpstan+branch%3Amain)
[![GitHub Code Style Action Status](https://img.shields.io/github/actions/workflow/status/murdercode/laravel-shortcode-plus/fix-php-code-style-issues.yml?branch=main&label=pint)](https://github.com/murdercode/laravel-shortcode-plus/actions?query=workflow%3A"Fix+PHP+code+style+issues"+branch%3Amain)
[![Total Downloads](https://img.shields.io/packagist/dt/murdercode/laravel-shortcode-plus.svg?style=flat-square)](https://packagist.org/packages/murdercode/laravel-shortcode-plus)
![License Mit](https://img.shields.io/github/license/murdercode/laravel-shortcode-plus)


---

## Why Shortcode+?

This package allows you to use shortcodes in your application, like a Wordpress / BBS style
websites. **Warning: this is a very opinionated package and it's not intended to be multi-purpose.**

In our days, shortcodes are a great way to preserve the integrity of the data within the content
published on our site (such as a blog or forum) without risking having to rewrite the format each
time.

With Laravel Shortcode+ we have the ability to turn a standard shortcode into a dynamic asset that
can update over time (new HTML standards, cookie consent, AMP versions, and more)!

## How it Works

For example, you can use the following shortcode to embed a Youtube video:

```markdown
[youtube id="123456789"]
```

This will be rendered as:

```html

<iframe src="https://www.youtube-nocookie.com/embed/123456789&autoplay=1" srcdoc="<style>*{padding:0;margin:0;overflow:hidden}html,body{height:100%}img,span{position:absolute;width:100%;top:0;bottom:0;margin:auto}span{height:1.5em;text-align:center;font:48px/1.5 sans-serif;color:white;text-shadow:0 0 0.5em black}</style><a href=https://www.youtube-nocookie.com/embed/123456789?autoplay=1><img style='object-fit:cover;height:100%;' loading='lazy' src=https://img.youtube.com/vi/123456789/hqdefault.jpg alt='123456789'
        loading=lazy><span>▶</span></a>" frameborder="0" allow="accelerometer; autoplay; encrypted-media; gyroscope;
        picture-in-picture" allowfullscreen title="123456789"></iframe>
```

As you can see, we don't just generate an iframe but make it accessible, performant and in line with
the best SEO practices around.

---

## Installation

First, you need Laravel Livewire:

```bash
composer require livewire/livewire
```

You can install the package via composer:

```bash
composer require murdercode/laravel-shortcode-plus
```

You can use shortcodes CSS publishing the assets:

```bash
php artisan vendor:publish --tag="laravel-shortcode-plus-assets"
```

You can publish and run the migrations with:

```bash
php artisan vendor:publish --tag="shortcode-plus-migrations"
php artisan migrate
```

You can publish the config file with:

```bash
php artisan vendor:publish --tag="shortcode-plus-config"
```

<!--
This is the contents of the published config file:

```php
return [
];
```
-->

Optionally, you can publish the views using

```bash
php artisan vendor:publish --tag="shortcode-plus-views"
```

## Usage

Laravel Shortcode Plus is shipped with a default CSS for a better user experience. You can add the
following line before your `</head>`:

```php
<link href="{{asset('vendor/shortcode-plus/css/shortcodes.css')}}" rel="stylesheet">
```

Now you can parse your source as follows:

```php
use Murdercode\ShortcodePlus\Facades\ShortcodePlus;

$html = "I want to parse this twitter tag: [twitter url=\"https://twitter.com/elonmusk/status/1585841080431321088\"]";
return LaravelShortcodePlus::source($html)->parseAll();
```

## Parsers

Here is the list of the available parsers:

| Shortcode      | Description                                                                                     | Parameters                 | Example                                                                                                                               |
|----------------|-------------------------------------------------------------------------------------------------|----------------------------|---------------------------------------------------------------------------------------------------------------------------------------|
| `[twitter]  `  | Get a Twitter card                                                                              | `url`                      | `[twitter url="https://twitter.com/elonmusk/status/1585841080431321088"]`                                                             |
| `[youtube]`    | Get a Youtube (light) player                                                                    | `url`                      | `[youtube url="https://www.youtube.com/watch?v=9bZkp7q19f0"]`                                                                         |
| `[spotify]`    | Get a Spotify player                                                                            | `url` or `uri`             | `[spotify url="https://open.spotify.com/track/2TpxZ7JUBn3uw46aR7qd6V"]`                                                               |
| `[faq]`        | Create a `<details>` tag with embedded content                                                  | `title`                    | `[faq title="What is the answer to the ultimate question?"]42[/faq]`                                                                  |
| `[spoiler]`    | Create a `<details>` tag with embedded content                                                  | `title`                    | `[spoiler title="Spoiler"]This is hidden content[/spoiler]`                                                                           |
| `[facebook]`   | Get a Facebook card                                                                             | `url`                      | `[facebook url="https://www.facebook.com/elonmusk/posts/10157744420210129"]`                                                          |
| `[instagram]`  | Get a Instagram card                                                                            | `url`                      | `[instagram url="https://www.instagram.com/p/CApQfIjBGxC/"]`                                                                          |
| `[image]`      | Create an image with `Image::class` model                                                       | `id`, `caption` (optional) | `[image id="123"]`                                                                                                                    |
| `[gallery]`    | Create a gallery image with `Image::class` model                                                | `title`, `images`          | Single or multiple images: `[gallery title="Gallery title here" images="1"]` or `[gallery title="Gallery title here" images="1,2,3"]` |
| `[photo]`      | Create a gallery image with `[Nova Media Hub](https://github.com/outl1ne/nova-media-hub)` model | `didascalia`               | Single or multiple images: `[photo didascalia="Gallery title here" id="1,2,3"]`                                                       |
| `[leggianche]` | Create a Read more div, based on `Article` or `Post` model                                      | `id`                       | `[leggianche id="1"]`                                                                                                                 |
| `[distico]`    | Create a side text block, based on `Article` or `Post` model                                    | `id`                       | `[distico id="1"]`                                                                                                                    |

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
