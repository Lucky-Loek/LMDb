<?php

namespace App\Providers;

use App\Service\ApiService;
use Illuminate\Support\ServiceProvider;

class ApiServiceProvider extends ServiceProvider
{
    /**
     * Register services.
     *
     * @return void
     */
    public function register()
    {
        $this->app->singleton(ApiService::class, function ($app) {
            return new ApiService($app->make('App\Client'));
        });
    }
}
