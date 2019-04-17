<?php

namespace App\Providers;

use App\Service\CsvReaderService;
use Illuminate\Support\ServiceProvider;

class CsvReaderServiceProvider extends ServiceProvider
{
    /**
     * Register services.
     *
     * @return void
     */
    public function register()
    {
        $this->app->singleton(CsvReaderService::class, function ($app) {
            return new CsvReaderService();
        });
    }
}
