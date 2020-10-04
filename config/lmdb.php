<?php

return [
    'api_key' => env('OMDB_API_KEY'),
    'watchlist_filename' => storage_path('app/' . env('IMDB_WATCHLIST_FILENAME'))
];
