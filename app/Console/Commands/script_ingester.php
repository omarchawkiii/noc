<?php

namespace App\Console\Commands;

use Illuminate\Console\Command;

class script_ingester extends Command
{
    /**
     * The name and signature of the console command.
     *
     * @var string
     */
    protected $signature = 'script_ingester';

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
        app(\App\Http\Controllers\IngesterManager::class)->script_ingester();
    }
}
