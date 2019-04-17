<?php

namespace App\Providers;

use App\Service\ImportService;
use Illuminate\Support\ServiceProvider;

class ImportServiceProvider extends ServiceProvider
{
    /**
     * Register services.
     *
     * @return void
     */
    public function register()
    {
        $this->app->singleton(ImportService::class, function ($app) {
            return new ImportService(
                $app->make('App\CsvReaderService'),
                $app->make('App\ApiService')
            );
        });
    }
}
