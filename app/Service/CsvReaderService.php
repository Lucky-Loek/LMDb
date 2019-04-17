<?php

namespace App\Service;

class CsvReaderService
{
    /**
     * @var string
     */
    private $filePath;

    public function __construct()
    {
        $this->filePath = config('lmdb.watchlist_filename');
    }

    /**
     * My attempt at functional programming that got a little out of hand.
     * Reads the watchlist and returns an array of arrays with csv column
     * headers as keys in the associative arrays.
     *
     * @return array
     */
    public function readWatchList()
    {
        $csv = array_map('str_getcsv', file($this->filePath));

        // In-place convert every element to UTF-8
        array_walk_recursive($csv, function (&$a) use ($csv) {
            $a = mb_convert_encoding($a, 'UTF-8', 'Windows-1252');
        });

        // In-place convert every index to a meaningful key
        array_walk($csv, function(&$a) use ($csv) {
            $a = array_combine($csv[0], $a);
        });

        // Remove the headers as first element of the array
        array_shift($csv);

        return $csv;
    }
}
