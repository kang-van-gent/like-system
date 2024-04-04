<?php

namespace App\Console\Commands;

use Illuminate\Console\Command;
use Symfony\Component\Process\Process;

class StartQueueWorker extends Command
{
    /**
     * The name and signature of the console command.
     *
     * @var string
     */
    protected $signature = 'queue:start';
    protected $description = 'Start the queue worker';



    /**
     * Execute the console command.
     */
    public function handle()
    {
        //
        $process = new Process(['php', 'artisan', 'queue:work']);
        $process->start();

        $this->info('Queue worker started.');
    }
}
