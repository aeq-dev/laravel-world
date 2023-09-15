<?php

namespace Bkfdev\World\Models;

use Illuminate\Database\Eloquent\Model;
use Bkfdev\World\Models\Traits\CacheableEloquent;

//use GeneaLabs\LaravelModelCaching\Traits\Cachable;

class Language extends Model
{
	use CacheableEloquent;

	protected $fillable = [
		'code',
		'name',
		'name_native',
		'dir',
	];

	public $timestamps = false;

	/**
	 * Get the table associated with the model.
	 *
	 * @return string
	 */
	public function getTable(): string
	{
		return config('laravel-world.migrations.languages.table_name', parent::getTable());
	}
}