<?php

namespace Bkfdev\World\Models;

use Illuminate\Database\Eloquent\Model;

use Bkfdev\World\Models\Traits\CityRelations;

//use GeneaLabs\LaravelModelCaching\Traits\Cachable;

class City extends Model
{
	use CityRelations;
	//use Cachable;

	protected $guarded = [];

	public $timestamps = false;

	/**
	 * Get the table associated with the model.
	 *
	 * @return string
	 */
	public function getTable(): string
	{
		return config('laravel-world.migrations.cities.table_name', parent::getTable());
	}
}