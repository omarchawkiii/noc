<?php

namespace App\Console\Commands;

use Illuminate\Console\Command;

class refresh_dcp_trensfer_data extends Command
{
    /**
     * The name and signature of the console command.
     *
     * @var string
     */
    protected $signature = 'refresh_dcp_trensfer_data';

    /**
     * The console command description.
     *
     * @var string
     */
    protected $description = 'refresh_dcp_trensfer_data';

    /**
     * Execute the console command.
     */
    public function handle()
    {
        $counter = 0;
        while ($counter <59)
        {
            app(\App\Http\Controllers\LocationController::class)->refresh_dcp_trensfer_data();
            sleep (1) ;
            $counter++;
        }
    }
}
