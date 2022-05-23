<?php

namespace Bkfdev\World\Facades;

use Illuminate\Support\Facades\Facade;

class LaravelWorld extends Facade
{
    /**
     * Get the registered name of the component.
     *
     * @return string
     */
    protected static function getFacadeAccessor(): string
    {
        return 'laravel-world';
    }
}
