<?php

namespace Bkfdev\World\Models;

use Illuminate\Database\Eloquent\Model;

use Bkfdev\World\Models\Traits\CountryRelations;
//use Bkfdev\World\Models\Traits\CacheableEloquent;
//use Spatie\Translatable\HasTranslations;

//use GeneaLabs\LaravelModelCaching\Traits\Cachable;

class Country extends Model
{
	use CountryRelations;
	//use CacheableEloquent;
	//use HasTranslations;
	//public $translatable = ['name'];
	protected $guarded = [];

	protected $with = ['currency', 'timezones'];

	public $timestamps = false;

	public function getTable(): string
	{
		return config('laravel-world.migrations.countries.table_name', parent::getTable());
	}
}
