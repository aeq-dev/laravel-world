<?php

namespace Bkfdev\World\Console;

use Illuminate\Console\Command;

class InitCommand extends Command
{
    protected $signature = 'world:init';

    protected $description = 'Initialize';


    public function handle()
    {
        $this->call('db:seed', ['--class' => 'WorldSeeder']);
    }
}
