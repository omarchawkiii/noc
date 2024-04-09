<?php

namespace App\Console\Commands;

use Illuminate\Console\Command;

class refresh_disk_usage_data extends Command
{
    /**
     * The name and signature of the console command.
     *
     * @var string
     */
    protected $signature = 'refresh_disk_usage_data';

    /**
     * The console command description.
     *
     * @var string
     */
    protected $description = 'refresh disk usage data';

    /**
     * Execute the console command.
     */
    public function handle()
    {
        app(\App\Http\Controllers\LocationController::class)->refresh_disk_usage_data();
    }
}
