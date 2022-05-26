<?php

namespace Bkfdev\World\Models;

use Illuminate\Database\Eloquent\Model;

use Bkfdev\World\Models\Traits\StateRelations;
use GeneaLabs\LaravelModelCaching\Traits\Cachable;

class State extends Model
{
	use StateRelations;
	use Cachable;


	protected $guarded = [];

	public $timestamps = false;

	/**
	 * Get the table associated with the model.
	 *
	 * @return string
	 */
	public function getTable(): string
	{
		return config('laravel-world.migrations.states.table_name', parent::getTable());
	}
}
