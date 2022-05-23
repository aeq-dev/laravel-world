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
	| Routes.
	|--------------------------------------------------------------------------
	*/
    'routes' => true,
    /*
	|--------------------------------------------------------------------------
	| Migrations.
	|--------------------------------------------------------------------------
	*/
    'migrations' => [
        'countries' => [
            'table_name' => 'world_countries',
            'optional_fields' => [
                'phone_code' => [
                    'required' => true,
                    'type' => 'string',
                    'length' => 5,
                ],
                'iso3' => [
                    'required' => true,
                    'type' => 'string',
                    'length' => 3,
                ],
                'native' => [
                    'required' => true,
                    'type' => 'string',
                ],
                'region' => [
                    'required' => true,
                    'type' => 'string',
                ],
                'subregion' => [
                    'required' => true,
                    'type' => 'string',
                ],
                'latitude' => [
                    'required' => true,
                    'type' => 'string',
                ],
                'longitude' => [
                    'required' => true,
                    'type' => 'string',
                ],
                'emoji' => [
                    'required' => true,
                    'type' => 'string',
                ],
                'emojiU' => [
                    'required' => true,
                    'type' => 'string',
                ],
            ],
        ],
        'states' => [
            'table_name' => 'world_states',
            'optional_fields' => [
                'country_code' => [
                    'required' => false,
                    'type' => 'string',
                    'length' => 3,
                ],
                'state_code' => [
                    'required' => false,
                    'type' => 'string',
                    'length' => 3,
                ],
                'latitude' => [
                    'required' => true,
                    'type' => 'string',
                ],
                'longitude' => [
                    'required' => true,
                    'type' => 'string',
                ],
            ],
        ],
        'cities' => [
            'table_name' => 'world_cities',
            'optional_fields' => [
                'country_code' => [
                    'required' => false,
                    'type' => 'string',
                    'length' => 3,
                ],
                'state_code' => [
                    'required' => false,
                    'type' => 'string',
                    'length' => 3,
                ],
                'latitude' => [
                    'required' => true,
                    'type' => 'string',
                ],
                'longitude' => [
                    'required' => true,
                    'type' => 'string',
                ],
            ],
        ],
        'timezones' => [
            'table_name' => 'world_timezones',
        ],
        'currencies' => [
            'table_name' => 'world_currencies',
        ],
        'languages' => [
            'table_name' => 'world_languages',
        ],
    ],
];

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
