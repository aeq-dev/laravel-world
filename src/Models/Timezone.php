<?php

namespace Bkfdev\World\Models;

use Illuminate\Database\Eloquent\Model;

//use Bkfdev\World\Models\Traits\CacheableEloquent;
use Bkfdev\World\Models\Traits\TimezoneRelations;

//use GeneaLabs\LaravelModelCaching\Traits\Cachable;

class Timezone extends Model
{
	//use CacheableEloquent;
	use TimezoneRelations;

	protected $fillable = [
		'country_id',
		'name',
	];

	public $timestamps = false;

	/**
	 * Get the table associated with the model.
	 *
	 * @return string
	 */
	public function getTable(): string
	{
		return config('laravel-world.migrations.timezones.table_name', parent::getTable());
	}
}