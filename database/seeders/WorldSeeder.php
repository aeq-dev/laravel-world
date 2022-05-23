<?php

namespace Database\Seeders;

use Bkfdev\World\Actions\SeedWorld;
use Illuminate\Database\Seeder;

class WorldSeeder extends Seeder
{
	public function run()
	{
		$this->call([
			SeedWorld::class,
		]);
	}
}
