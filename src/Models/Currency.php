<?php

namespace Bkfdev\World\Models;

use Illuminate\Database\Eloquent\Model;

//use Bkfdev\World\Models\Traits\CacheableEloquent;
use Bkfdev\World\Models\Traits\CurrencyRelations;
use Spatie\Translatable\HasTranslations;

//use GeneaLabs\LaravelModelCaching\Traits\Cachable;

class Currency extends Model
{
	use CurrencyRelations;
	//use CacheableEloquent;
	use HasTranslations;
	public $translatable = ['name'];
	protected $fillable = [
		'country_id',
		'name',
		'code',
		'precision',
		'symbol',
		'symbol_native',
		'symbol_first',
		'decimal_mark',
		'thousands_separator',
	];

	public $timestamps = false;

	/**
	 * Get the table associated with the model.
	 *
	 * @return string
	 */
	public function getTable(): string
	{
		return config('laravel-world.migrations.currencies.table_name', parent::getTable());
	}
}