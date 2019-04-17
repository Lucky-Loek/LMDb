<?php

namespace App\Providers;

use App\Client\Client;
use Illuminate\Support\ServiceProvider;

class HttpClientServiceProvider extends ServiceProvider
{
    /**
     * Register services.
     *
     * @return void
     */
    public function register()
    {
        $this->app->singleton(Client::class, function ($app) {
            return new Client(
                new \GuzzleHttp\Client()
            );
        });
    }
}
