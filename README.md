# Lucky-Loek's Movie Database

Welcome to the most unnecessary app I've ever built. It imports your IMDb watchlist, runs it through [OMDb](https://www.omdbapi.com/) and then displays your movies plus some absolutely tear-jerking statistics on a dashboard.

This app is mostly for me to experiment with certain architectures and editors. Right now, it's a single-action controller based app that I wrote in Vim. But it may change to hexagonal, microservices or whatever I find interesting in the future.

## Requirements

The app works on Docker, or you can run it locally (for which you will need `Php 7.3+`). Now you only need a .csv export of your IMDb watchlist and an API key by OMDb.

*Note: OMDb limits free keys to 1000 requests per day. I've not built in any way of dealing with this limit so expect errors if your watchlist is longer.*

## Installation

```shell
$ docker run --rm -v $(pwd):/opt -w /opt laravelsail/php80-composer:latest composer install
# For local installations: composer install

$ cp .env.example .env

# Fill in all the credentials, paste the csv file in storage/app

# Start the app
$ ./vendor/bin/sail up -d

# First time setup
$ ./vendor/bin/sail artisan key:generate
$ ./vendor/bin/sail artisan migrate

# App is available at localhost
```

## Usage

```shell
$ ./vendor/bin/sail artisan lmdb:import

# Visit localhost
```
