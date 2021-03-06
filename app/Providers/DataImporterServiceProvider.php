<?php

namespace App\Providers;

use Illuminate\Support\ServiceProvider;
use App\Library\DataImporter;

class DataImporterServiceProvider extends ServiceProvider
{
    
    protected $defer = true;

    /**
     * Bootstrap the application services.
     *
     * @return void
     */
    public function boot()
    {
        //
    }

    /**
     * Register the application services.
     *
     * @return void
     */
    public function register()
    {
        $this->app->singleton(DataImporter::class, function(){
            return new DataImporter();
        });
    }
}
