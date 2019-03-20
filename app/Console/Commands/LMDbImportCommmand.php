<?php

namespace App\Console\Commands;

use App\Service\ApiService;
use Illuminate\Console\Command;

class LMDbImportCommmand extends Command
{
    /**
     * The name and signature of the console command.
     *
     * @var string
     */
    protected $signature = 'lmdb:import';

    /**
     * The console command description.
     *
     * @var string
     */
    protected $description = 'Imports screenings from the OMDb API';

    /**
     * Create a new command instance.
     *
     * @return void
     */
    public function __construct()
    {
        parent::__construct();
    }

    /**
     * Execute the console command.
     *
     * @return mixed
     */
    public function handle(ApiService $service)
    {
        $this->output->writeln($service->workWell());
    }
}
