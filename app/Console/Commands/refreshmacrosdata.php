<?php

namespace App\Console\Commands;

use Illuminate\Console\Command;

class refreshmacrosdata extends Command
{
    /**
     * The name and signature of the console command.
     *
     * @var string
     */
    protected $signature = 'refreshmacrosdata';

    /**
     * The console command description.
     *
     * @var string
     */
    protected $description = 'Command for refresh macros data ';

    /**
     * Execute the console command.
     */
    public function handle()
    {
        app(\App\Http\Controllers\LocationController::class)->refresh_macro_data();
    }
}
