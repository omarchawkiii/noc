<?php

namespace App\Console\Commands;

use Illuminate\Console\Command;

class execute_dcp_command extends Command
{
    /**
     * The name and signature of the console command.
     *
     * @var string
     */
    protected $signature = 'execute_dcp_command';

    /**
     * The console command description.
     *
     * @var string
     */
    protected $description = 'execute_dcp_command';

    /**
     * Execute the console command.
     */
    public function handle()
    {
        $counter = 0;
        while ($counter <30)
        {
            app(\App\Http\Controllers\LocationController::class)->execute_dcp_command();
            sleep (5) ;
            $counter++;
        }



    }
}
