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
