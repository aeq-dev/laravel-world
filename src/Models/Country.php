<?php

namespace Bkfdev\World\Models;

use Illuminate\Database\Eloquent\Model;

use Bkfdev\World\Models\Traits\CountryRelations;
use GeneaLabs\LaravelModelCaching\Traits\Cachable;

class Country extends Model
{
	use CountryRelations;
	use Cachable;

	protected $guarded = [];

	protected $with = ['currency', 'timezones'];

	public $timestamps = false;

	public function getTable(): string
	{
		return config('laravel-world.migrations.countries.table_name', parent::getTable());
	}
}
