<?php

namespace App\Console\Commands;

use Illuminate\Console\Command;
use App\Library\Concrete\WebserviceDataImporter;

class WebimporterCron extends Command
{
    /**
     * The name and signature of the console command.
     *
     * @var string
     */
    protected $signature = 'webimporter:cron';

    /**
     * The console command description.
     *
     * @var string
     */
    protected $description = 'Consume a webservice that enlists customer profile in raw format. Store as new record on db or update if customer email is already existing.';

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
    public function handle()
    {
        \Log::info("Cron is working fine!");

        $request = new WebserviceDataImporter();
        \Log::info($request->fetchData());
        \Log::info($request->prepareData());
        \Log::info($request->importData());
    }
}
