<?php

namespace App\Service;

use App\Client\Client;

class ApiService
{
    private $client;

    public function __construct(Client $client)
    {
        $this->client = $client;
    }

    public function workWell()
    {
        return 'work very well!';
    }
}
