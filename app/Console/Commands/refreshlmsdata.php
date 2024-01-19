<?php

namespace App\Console\Commands;

use Illuminate\Console\Command;

class refreshlmsdata extends Command
{
    /**
     * The name and signature of the console command.
     *
     * @var string
     */
    protected $signature = 'refreshlmsdata';

    /**
     * The console command description.
     *
     * @var string
     */
    protected $description = 'Command description';

    /**
     * Execute the console command.
     */
    public function handle()
    {
        app(\App\Http\Controllers\LocationController::class)->refresh_lms_data_all_location();
    }
}
