<?php

namespace Bkfdev\World\Console;

use Illuminate\Support\Arr;
use Illuminate\Console\Command;
use Bkfdev\World\Models;
use Illuminate\Support\Facades\File;
use Illuminate\Support\Facades\Schema;

class AddCountryCommand extends Command
{
    protected $signature = 'world:add {country* : iso2 separated by comma} --queue';

    protected $description = 'Add new country from json data into DB';

    private array $modules = [
        'states' => [
            'class' => Models\State::class,
            'data' => [],
            'enabled' => false,
        ],
        'cities' => [
            'class' => Models\City::class,
            'data' => [],
            'enabled' => false,
        ],
        'timezones' => [
            'class' => Models\Timezone::class,
            'enabled' => false,
        ],
        'currencies' => [
            'class' => Models\Currency::class,
            'data' => [],
            'enabled' => false,
        ],
        'languages' => [
            'class' => Models\Language::class,
            'data' => [],
            'enabled' => false,
        ],
    ];


    public function handle()
    {
        $country_codes = $this->argument('country');
        $this->getOutput()->block('Start Adding...');

        $bar = $this->output->createProgressBar(count($country_codes));
        $bar->start();
        // Ensure country codes are uppercase        
        $iso2 = [];
        foreach ($country_codes as $key => $value) {
            $iso2[] = strtoupper($value);
        }
        // Prepare Modules

        foreach (config('laravel-world.modules') as $module => $enabled) {
            if ($enabled) {
                $this->modules[$module]['enabled'] = true;
                $this->initModule($module);
            }
        }

        // Get Countries 
        $countryFields = Schema::getColumnListing(config('laravel-world.migrations.countries.table_name'));

        $this->forgetFields($countryFields, ['id']);

        $countries = json_decode(File::get(__DIR__ . '/../../resources/json/countries.json'), true);

        $countries = Arr::where($countries, function ($value, $key) use ($iso2) {
            return in_array($value['iso2'], $iso2);
        });
        //dd($countries);
        foreach (array_chunk($countries, 20) as $countryChunks) {

            foreach ($countryChunks as $countryArray) {

                $countryArray = array_map(fn($field) => gettype($field) === 'string' ? trim($field) : $field, $countryArray);

                $exist = Models\Country::whereIso2($countryArray['iso2'])->first();

                if (!$exist) {
                    $country = Models\Country::create(Arr::only($countryArray, $countryFields));
                    // states and cities
                    if ($this->isModuleEnabled('states')) {
                        $this->seedStates($country, $countryArray);
                    }

                    // timezones
                    if ($this->isModuleEnabled('timezones')) {
                        $this->seedTimezones($country, $countryArray);
                    }
                    // currencies
                    if ($this->isModuleEnabled('currencies')) {
                        $this->seedCurrencies($country, $countryArray);
                    }
                }
                $bar->advance();
            }
        }

        // languages
        if ($this->isModuleEnabled('languages')) {
            $this->seedLanguages();
        }

        if ($this->isModuleEnabled('currencies')) {
            $this->seedAllCurrencies();
        }

        $bar->finish();

        $this->getOutput()->info('Done!');
    }

    /**
     * @param  string  $module
     * @return void
     */
    private function initModule(string $module)
    {
        if (array_key_exists($module, $this->modules)) {
            // truncate module database table.
            //app($this->modules[$module]['class'])->truncate();
            // import json data.
            $moduleSourcePath = __DIR__ . '/../../resources/json/' . $module . '.json';

            if (File::exists($moduleSourcePath)) {
                $this->modules[$module]['data'] = json_decode(File::get($moduleSourcePath), true);
            }
        }
    }

    /**
     * @param  string  $module
     * @return bool
     */
    private function isModuleEnabled(string $module): bool
    {
        return $this->modules[$module]['enabled'];
    }

    /**
     * @param  Models\Country  $country
     * @param array $countryArray
     */
    private function seedStates(Models\Country $country, array $countryArray): void
    {
        // country states and cities
        $countryStates = Arr::where($this->modules['states']['data'], fn($state) => $state['country_id'] === $countryArray['id']);
        // state schema
        $stateFields = Schema::getColumnListing(config('laravel-world.migrations.states.table_name'));

        $this->forgetFields($stateFields, ['id', 'country_id']);

        foreach (array_chunk($countryStates, 20) as $stateChunks) {

            foreach ($stateChunks as $stateArray) {

                $stateArray = array_map(fn($field) => gettype($field) === 'string' ? trim($field) : $field, $stateArray);

                $state = $country
                    ->states()
                    ->create(Arr::only($stateArray, $stateFields));
                // state cities
                if ($this->isModuleEnabled('cities')) {
                    $stateCities = Arr::where(
                        $this->modules['cities']['data'],
                        fn($city) => $city['state_id'] === $stateArray['id']
                    );

                    $this->seedCities($country, $state, $stateCities);
                }
            }
        }
    }

    /**
     * @param  Models\Country  $country
     * @param  Models\State  $state
     * @param  array  $cities
     */
    private function seedCities(Models\Country $country, Models\State $state, array $cities): void
    {
        // state schema
        $cityFields = Schema::getColumnListing(config('laravel-world.migrations.cities.table_name'));

        $this->forgetFields($cityFields, ['id', 'state_id']);

        foreach (array_chunk($cities, 20) as $cityChunks) {

            foreach ($cityChunks as $cityArray) {

                $cityArray = array_map(fn($field) => gettype($field) === 'string' ? trim($field) : $field, $cityArray);

                $state
                    ->cities()
                    ->create(
                        Arr::only($cityArray, $cityFields),
                    );
            }
        }
    }

    /**
     * @param  Models\Country  $country
     * @param $countryArray
     * @return void
     */
    private function seedTimezones(Models\Country $country, $countryArray): void
    {
        foreach ($countryArray['timezones'] as $timezone) {
            $country
                ->timezones()
                ->create([
                    'name' => (string) $timezone['zoneName'],
                ]);
        }
    }

    private function seedCurrencies(Models\Country $country, array $countryArray): void
    {
        // currencies
        $exists = in_array($countryArray['currency'], array_keys($this->modules['currencies']['data']), true);
        $currency = $exists
            ? $this->modules['currencies']['data'][$countryArray['currency']]
            : [
                'name' => (string) $countryArray['currency'],
                'code' => (string) $countryArray['currency'],
                'symbol' => (string) $countryArray['currency_symbol'],
                'symbol_native' => (string) $countryArray['currency_symbol'],
                'decimal_digits' => 2,
            ];
        $country
            ->currency()
            ->create([
                'name' => (string) $currency['name'],
                'code' => (string) $currency['code'],
                'symbol' => (string) $currency['symbol'],
                'symbol_native' => (string) $currency['symbol_native'],
                'precision' => (int) $currency['decimal_digits'],
            ]);
    }

    /**
     * @return void
     */
    private function seedLanguages(): void
    {
        // languages
        foreach ($this->modules['languages']['data'] as $language) {
            Models\Language::create($language);
        }
    }

    private function seedAllCurrencies(): void
    {
        // currencies
        foreach ($this->modules['currencies']['data'] as $currency) {
            Models\Currency::create($currency);
        }
    }

    /**
     * @param  array  $array
     * @param  array  $values
     * @return void
     */
    private function forgetFields(array &$array, array $values)
    {
        foreach ($values as $value) {
            if (($key = array_search($value, $array)) !== false) {
                unset($array[$key]);
            }
        }
    }
}