<?php

namespace App\Client;

class Client
{
    private $client;
    private $apiKey;

    public function __construct(\GuzzleHttp\Client $client)
    {
        $this->client = $client;
        $this->apiKey = config('api.key');
    }
}
