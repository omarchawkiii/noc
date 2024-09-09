<?php

namespace App\Console\Commands;

use Illuminate\Console\Command;

class refresh_asset_infos extends Command
{
    /**
     * The name and signature of the console command.
     *
     * @var string
     */
    protected $signature = 'refresh_asset_infos';

    /**
     * The console command description.
     *
     * @var string
     */
    protected $description = 'Refresh Asset Infos';

    /**
     * Execute the console command.
     */
    public function handle()
    {
        app(\App\Http\Controllers\LocationController::class)->refresh_asset_infos();
    }
}
