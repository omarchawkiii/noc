<?php

namespace App\Console\Commands;

use Illuminate\Console\Command;

class link_pending_spls_movies extends Command
{
    /**
     * The name and signature of the console command.
     *
     * @var string
     */
    protected $signature = 'link_pending_spls_movies';

    /**
     * The console command description.
     *
     * @var string
     */
    protected $description = 'link_pending_spls_movies';

    /**
     * Execute the console command.
     */
    public function handle()
    {
        app(\App\Http\Controllers\MoviescodController::class)->link_pending_spl_movies();
    }
}
