# LaravelWorld

[![Latest Version on Packagist][ico-version]][link-packagist]
[![Total Downloads][ico-downloads]][link-downloads]
[![Build Status][ico-travis]][link-travis]
[![StyleCI][ico-styleci]][link-styleci]

The Laravel-World is a Laravel package which provides a list of the countries, states, cities, timezones, currencies and languages.

It can be consumed with the World Facade

## Installation

Via Composer

```bash
    composer require bkfdev/laravel-world
```

## Publish

```bash
    php artisan vendor:publish --force --provider="Bkfdev\World\LaravelWorldServiceProvider"
```

## Setup Config

```bash
<?php

return [
    /*
	|--------------------------------------------------------------------------
	| Allowed countries to be loaded
	| Leave it empty to load all countries
	|--------------------------------------------------------------------------
	*/
    'allowed_countries' => [],

    /*
	|--------------------------------------------------------------------------
	| Disallowed countries to not be loaded
	| Leave it empty to allow all countries to be loaded
	|--------------------------------------------------------------------------
	*/
    'disallowed_countries' => [],

    /*
	|--------------------------------------------------------------------------
	| Supported locales.
	|--------------------------------------------------------------------------
	*/
    'accepted_locales' => [
        'ar',
        'en',
        /* 'bn',
        'br',
        'de',
        'es',
        'fr',
        'ja',
        'kr',
        'nl',
        'pl',
        'pt',
        'ro',
        'ru',
        'zh', */
    ],
    /*
	|--------------------------------------------------------------------------
	| Enabled modules.
	| The cities module depends on the states module.
	|--------------------------------------------------------------------------
	*/
    'modules' => [
        'states' => true,
        'cities' => true,
        'timezones' => true,
        'currencies' => true,
        'languages' => true,
    ],

    /*
	|--------------------------------------------------------------------------
	| Migrations.
	|--------------------------------------------------------------------------
	*/
    'migrations' => [
        'countries' => [
            'table_name' => 'world_countries',
            'optional_fields' => [

    ...

```

## Migrate

```bash
    php artisan migrate
```

## Run Command to import data

```bash
    php artisan world:init
```

## Usage

It's just an eloquent so you may run whetever your want

```bash
    use Bkfdev\World\World;
```

### Get All countries :

```bash
    $countries = World::Countries();
```

### Get country by code iso2 or iso3 :

```bash
    $country = World::getCountryByCode($code);
```

### Get country by name :

```bash
    $country = World::getCountryByName($name);
```

### Get states of a give country by code :

```bash
    $states = World::getStatesOfCountry($code);
```

## Change log

Please see the [changelog](changelog.md) for more information on what has changed recently.

## Testing

```bash
    composer test
```

## Contributing

Please see [contributing.md](contributing.md) for details and a todolist.

## Security

If you discover any security related issues, please email bkfdev@gmail.com instead of using the issue tracker.

## Credits

- [Author Name][link-author]
- [All Contributors][link-contributors]

## License

MIT. Please see the [license file](license.md) for more information.

[ico-version]: https://img.shields.io/packagist/v/bkfdev/laravel-world.svg?style=flat-square
[ico-downloads]: https://img.shields.io/packagist/dt/bkfdev/laravel-world.svg?style=flat-square
[ico-travis]: https://img.shields.io/travis/bkfdev/laravel-world/master.svg?style=flat-square
[ico-styleci]: https://styleci.io/repos/12345678/shield
[link-packagist]: https://packagist.org/packages/bkfdev/laravel-world
[link-downloads]: https://packagist.org/packages/bkfdev/laravel-world
[link-travis]: https://travis-ci.org/bkfdev/laravel-world
[link-styleci]: https://styleci.io/repos/12345678
[link-author]: https://github.com/bkfdev
[link-contributors]: ../../contributors
