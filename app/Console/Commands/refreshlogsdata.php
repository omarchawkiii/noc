<?php

namespace App\Console\Commands;

use Illuminate\Console\Command;

class refreshlogsdata extends Command
{
    /**
     * The name and signature of the console command.
     *
     * @var string
     */
    protected $signature = 'refreshlogsdata';

    /**
     * The console command description.
     *
     * @var string
     */
    protected $description = 'Get Performence Logs Data from API ';

    /**
     * Execute the console command.
     */
    public function handle()
    {
        app(\App\Http\Controllers\LocationController::class)->refresh_logs_data();
    }
}
