<?php

namespace Bkfdev\World;

use Bkfdev\World\Models\Country;

class World
{
    public static function Countries()
    {
        return Country::orderBy('name', 'asc')->get();
    }
}
