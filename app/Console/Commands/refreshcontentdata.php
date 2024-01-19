<?php

namespace App\Console\Commands;

use Illuminate\Console\Command;

class refreshcontentdata extends Command
{
    /**
     * The name and signature of the console command.
     *
     * @var string
     */
    protected $signature = 'refreshcontentdata';

    /**
     * The console command description.
     *
     * @var string
     */
    protected $description = 'Refresh SPL CPL KDM Content';

    /**
     * Execute the console command.
     */
    public function handle()
    {
        app(\App\Http\Controllers\LocationController::class)->refresh_content_all_location();
    }
}
