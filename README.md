# Faker PHP — en_NZ locale

New Zealand English (`en_NZ`) locale for [Faker PHP](https://github.com/xefi/faker-php).

## Installation

```bash
composer require --dev xefi/faker-php-locales-en-nz
```

The service provider is discovered automatically through Composer.

## Usage

```php
use Xefi\Faker\Faker;

$faker = new Faker('en_NZ');
```

Generators without a `en_NZ` variant fall back to the default locale.

## Locale-specific generators

```php
$faker->region();         // 'Canterbury'
$faker->postcode();       // '8011'
$faker->irdNumber();      // IRD number, valid modulus 11 check digit
$faker->nzbn();           // New Zealand Business Number, valid GS1 check digit
$faker->companyNumber();  // Companies Office number
```

New Zealand does not use IBAN: `iban()` returns an IBAN-shaped `NZ` string built from a bank, branch, account and suffix.

## Contributing

1. Fork the repository and create a branch from `main`.
2. Add an extension under `src/Extensions/` and register it in `FakerEnNzServiceProvider::boot()`.
3. Add a test under `tests/Unit/`.
4. Run the suite with `vendor/bin/phpunit` (or `docker compose run php vendor/bin/phpunit`).
5. Open a pull request against `main`.

## License

MIT
