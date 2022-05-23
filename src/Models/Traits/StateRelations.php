<?php

namespace Bkfdev\World\Models\Traits;

use Illuminate\Database\Eloquent\Relations\BelongsTo;
use Illuminate\Database\Eloquent\Relations\HasMany;
use Bkfdev\World\Models;

trait StateRelations
{
	/**
	 * @return BelongsTo
	 */
	public function country(): BelongsTo
	{
		return $this->belongsTo(Models\Country::class);
	}

	public function cities(): HasMany
	{
		return $this->hasMany(Models\City::class);
	}
}
