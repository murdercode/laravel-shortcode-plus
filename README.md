# Laravel Shortcode+

[![Latest Version on Packagist](https://img.shields.io/packagist/v/murdercode/laravel-shortcode-plus.svg?style=flat-square)](https://packagist.org/packages/murdercode/laravel-shortcode-plus)
[![GitHub Tests Action Status](https://img.shields.io/github/workflow/status/murdercode/laravel-shortcode-plus/run-tests?label=tests)](https://github.com/murdercode/laravel-shortcode-plus/actions?query=workflow%3Arun-tests+branch%3Amain)
[![GitHub Code Style Action Status](https://img.shields.io/github/workflow/status/murdercode/laravel-shortcode-plus/Fix%20PHP%20code%20style%20issues?label=code%20style)](https://github.com/murdercode/laravel-shortcode-plus/actions?query=workflow%3A"Fix+PHP+code+style+issues"+branch%3Amain)
[![Total Downloads](https://img.shields.io/packagist/dt/murdercode/laravel-shortcode-plus.svg?style=flat-square)](https://packagist.org/packages/murdercode/laravel-shortcode-plus)

---

**This package is under heavy development. Please avoid using it in production.**

**Laravel Shortcode Plus** is a package that allows you to use shortcodes for your Laravel
application.

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

Laravel Shortcode Plus is shipped with a default CSS for a better user experience. You can add the following line before your `</head>`:
    
```php
{!! LaravelShortcodePlus::css() !!}
```


Now you can parse your source as follow:
```php
use Murdercode\ShortcodePlus\Facades\ShortcodePlus;

$html = "I want to parse this twitter tag: [twitter url=\"https://twitter.com/elonmusk/status/1585841080431321088\"]";
return LaravelShortcodePlus::source($html)->parse();
```

You can also specify a specific shortcode to parse:

```php
$html = "[twitter url=\"https://twitter.com/elonmusk/status/1585841080431321088\"]";
$twitterOembed = LaravelShortcodePlus::source($html)->parseTwitterTag();
```

You can use those methods:

- `parseTwitterTag()` - It converts [twitter url="<your-url-here>"] tags to oembed html
- `parseYoutubeTag()` - It converts [youtube url="<your-url-here>"] tags to oembed html

### TODO: Facebook

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

Please review [our security policy](../../security/policy) on how to report security vulnerabilities.

## Credits

- [Stefano Novelli](https://github.com/murdercode)
- [All Contributors](../../contributors)

## License

The MIT License (MIT). Please see [License File](LICENSE.md) for more information.
