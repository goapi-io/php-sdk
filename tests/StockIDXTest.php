<?php

use GOAPI\IO\Client;
use GOAPI\IO\StockIDX;

$client = new Client([
    'api_key' => getenv('GOAPI_IO_API_KEY'), // your api key
]);

test('get client instance', function () use($client) {
    $stockIDX = $client->createStockIDX();

    expect($stockIDX instanceof StockIDX)->toBeTrue();

});


test('get companies', function() use($client) {
    $stockIDX = $client->createStockIDX();

    $companies = $stockIDX->getCompanies();

    expect($companies->count() > 0)->toBeTrue();
    // expect($companies->values()[0] instanceof Company)->toBeTrue();
});

test('get stock price', function() use($client) {
    $stockIDX = $client->createStockIDX();
    $symbols = ['BBCA'];

    $companies = $stockIDX->getStockPrices($symbols);

    expect($companies->count() == count($symbols))->toBeTrue();
    // expect($companies->values()[0] instanceof Company)->toBeTrue();
});