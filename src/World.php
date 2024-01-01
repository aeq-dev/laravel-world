<?php

namespace Bkfdev\World;

use Illuminate\Support\Arr;
use Illuminate\Support\Str;
use Bkfdev\World\Models\Country;
use Illuminate\Support\Facades\File;

class World
{
    public static function Countries()
    {
        return Country::orderBy('name', 'asc')->get();
    }

    public static function getCountryByName($name)
    {
        return Country::whereName($name)->first();
    }


    public static function getCountryByCode($code)
    {
        if (Str::length($code) === 2)
            return Country::whereIso2($code)->first();
        elseif (Str::length($code) === 3)
            return Country::whereIso3($code)->first();
        else
            return null;
    }

    public static function getStatesOfCountry($code)
    {
        return self::getCountryByCode($code)->states;
    }

    public static function getCountriesFromJson()
    {
        return json_decode(File::get(__DIR__ . '/../resources/json/countries.json'), true);
    }

    public static function getCurrenciesFromJson()
    {
        return json_decode(File::get(__DIR__ . '/../resources/json/currencies.json'), true);
    }

    public static function getCountryFromJson($country_code)
    {
        $countries = json_decode(File::get(__DIR__ . '/../resources/json/countries.json'), true);
        $result = array_values(Arr::where($countries, function ($value, $key) use ($country_code) {
            return $value['iso2'] === $country_code;
        }));
        return count($result) ? (object) $result[0] : null;
    }

    public static function getCurrencyFromJson($currency_code)
    {
        $currencies = json_decode(File::get(__DIR__ . '/../resources/json/currencies.json'), true);
        $result = array_values(Arr::where($currencies, function ($value, $key) use ($currency_code) {
            return $value['code'] === $currency_code;
        }));
        return count($result) ? (object) $result[0] : null;
    }
}
