<?php

namespace Bkfdev\World\Models\Traits;

use Bkfdev\World\Models;

use Illuminate\Database\Eloquent\Relations\BelongsTo;

trait CityRelations
{
	/**
	 * @return BelongsTo
	 */
	public function country(): BelongsTo
	{
		return $this->belongsTo(Models\Country::class);
	}

	/**
	 * @return BelongsTo
	 */
	public function state(): BelongsTo
	{
		return $this->belongsTo(Models\State::class);
	}
}
