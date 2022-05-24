<?php

namespace Bkfdev\World\Models;

use Bkfdev\World\Models\Traits\CountryRelations;

use Illuminate\Database\Eloquent\Model;

class Country extends Model
{
	use CountryRelations;

	protected $guarded = [];

	public $timestamps = false;

	public function getTable(): string
	{
		return config('laravel-world.migrations.countries.table_name', parent::getTable());
	}
}
