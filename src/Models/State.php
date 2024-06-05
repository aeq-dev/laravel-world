<?php

namespace Bkfdev\World\Models;

use Illuminate\Database\Eloquent\Model;

use Bkfdev\World\Models\Traits\StateRelations;
//use Bkfdev\World\Models\Traits\CacheableEloquent;
//use Spatie\Translatable\HasTranslations;

//use GeneaLabs\LaravelModelCaching\Traits\Cachable;

class State extends Model
{
	use StateRelations;
	//use CacheableEloquent;
	//use HasTranslations;
	//public $translatable = ['name'];
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
