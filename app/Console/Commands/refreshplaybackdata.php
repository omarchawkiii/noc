<?php

namespace App\Console\Commands;

use Illuminate\Console\Command;

class refreshplaybackdata extends Command
{
    /**
     * The name and signature of the console command.
     *
     * @var string
     */
    protected $signature = 'refreshplaybackdata';

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
        app(\App\Http\Controllers\LocationController::class)->refresh_playback_data();
    }
}
