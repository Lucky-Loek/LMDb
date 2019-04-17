<?php

namespace App\Service;

use App\Actor;
use App\Client\Client;
use App\Director;
use App\Genre;
use App\Type;

class ApiService
{
    private $client;

    public function __construct(Client $client)
    {
        $this->client = $client;
    }

    public function processWatchlist()
    {
        // Read CSV
        // Run line for line through api
        // Check if api response already in DB
        //   Write api response to DB
        // Check if movie, series or episode
        //   If series then retrieve seasons
        //   Retrieve all episodes for all seasons

        $response = $this->client->getScreeningById('tt0111161');

        $decoded = json_decode($response);

        $actors = $this->createAndGetItemsFromString($decoded->Actors, Actor::class);
        $directors = $this->createAndGetItemsFromString($decoded->Director, Director::class);
        $genres = $this->createAndGetItemsFromString($decoded->Genre, Genre::class);
        $type = Type::where('type', $decoded->Type);

        print_r($actors);

        return 'yippie';
    }

    private function createAndGetItemsFromString(string $items, string $className): array
    {
        $itemNames = explode(', ', $items);

        $items = [];
        foreach ($itemNames as $name) {
            $items[] = $className::firstOrCreate(['name' => $name]);
        }

        return $items;
    }
}
