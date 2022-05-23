<?php

namespace Bkfdev\World\Models\Traits;

use Bkfdev\World\Models;

use Illuminate\Database\Eloquent\Relations\BelongsTo;

trait TimezoneRelations
{
	/**
	 * @return BelongsTo
	 */
	public function country(): BelongsTo
	{
		return $this->belongsTo(Models\Country::class);
	}
}
