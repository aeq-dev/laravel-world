<?php

namespace Database\Seeders;

use Illuminate\Database\Seeder;
use Bkfdev\World\Actions\SeedAction;

class WorldSeeder extends Seeder
{
	public function run()
	{
		$this->call([
			SeedAction::class,
		]);
	}
}
