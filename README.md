# PHP Sifen Tool

[![Latest Version on Packagist](https://img.shields.io/packagist/v/nyxcode/php-sifen-tool.svg?style=flat-square)](https://packagist.org/packages/nyxcode/php-sifen-tool)
[![Tests](https://img.shields.io/github/actions/workflow/status/nyxcode/php-sifen-tool/run-tests.yml?branch=main&label=tests&style=flat-square)](https://github.com/nyxcode/php-sifen-tool/actions/workflows/run-tests.yml)
[![Total Downloads](https://img.shields.io/packagist/dt/nyxcode/php-sifen-tool.svg?style=flat-square)](https://packagist.org/packages/nyxcode/php-sifen-tool)

A php package to simplify integration with Paraguay's SIFEN API for electronic invoicing.

## Installation

You can install the package via composer:

```bash
composer require nyxcode/php-sifen-tool
```

## Usage

```php
$skeleton = new Nyxcode\PhpSifenTool();
echo $skeleton->echoPhrase('Hello, Nyxcode!');
```

## Testing

```bash
composer test
```

## Changelog

Please see [CHANGELOG](CHANGELOG.md) for more information on what has changed recently.

## Contributing

Please see [CONTRIBUTING](https://github.com/spatie/.github/blob/main/CONTRIBUTING.md) for details.

## Security Vulnerabilities

Please review [our security policy](../../security/policy) on how to report security vulnerabilities.

## Credits

- [Matias Vega](https://github.com/mati-v7)
- [All Contributors](../../contributors)

## License

The MIT License (MIT). Please see [License File](LICENSE.md) for more information.
