<?php

namespace Bkfdev\World\Models\Traits;

use Bkfdev\World\Models;
use Illuminate\Database\Eloquent\Relations\HasOne;
use Illuminate\Database\Eloquent\Relations\HasMany;

trait CountryRelations
{
	/**
	 * @return HasMany
	 */
	public function states(): HasMany
	{
		return $this->hasMany(Models\State::class, 'country_id', 'id');
	}


	/**
	 * @return HasMany
	 */
	public function timezones(): HasMany
	{
		return $this->hasMany(Models\Timezone::class, 'country_id', 'id');
	}

	/**
	 * @return HasOne
	 */
	public function currency(): HasOne
	{
		return $this->hasOne(Models\Currency::class, 'country_id', 'id');
	}
}
