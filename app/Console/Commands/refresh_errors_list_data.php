<?php

namespace App\Console\Commands;

use Illuminate\Console\Command;

class refresh_errors_list_data extends Command
{
    /**
     * The name and signature of the console command.
     *
     * @var string
     */
    protected $signature = 'refresh_errors_list_data';

    /**
     * The console command description.
     *
     * @var string
     */
    protected $description = 'refresh_errors_list_data';

    /**
     * Execute the console command.
     */
    public function handle()
    {
        app(\App\Http\Controllers\LocationController::class)->refresh_errors_list_data();
    }
}
