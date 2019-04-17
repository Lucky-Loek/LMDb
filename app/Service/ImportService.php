<?php

namespace App\Service;

use App\Actor;
use App\Client\Client;
use App\Director;
use App\Genre;
use App\Type;

class ImportService
{
    /**
     * @var CsvReaderService
     */
    private $csvReaderService;

    /**
     * @var ApiService
     */
    private $apiService;

    public function __construct(
        CsvReaderService $csvReaderService,
        ApiService $apiService
    ) {
        $this->csvReaderService = $csvReaderService;
        $this->apiService = $apiService;
    }

    public function processWatchlist()
    {
        // Read CSV
        $imdbElements = $this->csvReaderService->readWatchlist();

        // Run line for line through api
        $this->apiService->processImdbElements($imdbElements);
    }
}
