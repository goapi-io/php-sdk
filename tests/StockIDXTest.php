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
});

test('get company profile', function() use($client) {
    $stockIDX = $client->createStockIDX();
    $response  = $stockIDX->getProfile(symbol: 'BBCA');

    expect($response instanceof \GOAPI\IO\Resources\Stock\CompanyProfile)->toBeTrue();
    expect($response->symbol == 'BBCA')->toBeTrue();
});

test('get stock indices', function() use($client) {
    $stockIDX = $client->createStockIDX();
    $response  = $stockIDX->getIndices();

    expect($response instanceof \GOAPI\IO\Collection)->toBeTrue();
    expect($response[0] instanceof \GOAPI\IO\Resources\Stock\StockIndex)->toBeTrue();
});

test('get stock index items', function() use($client) {
    $stockIDX = $client->createStockIDX();
    $response  = $stockIDX->getIndexItems('LQ45');

    expect($response instanceof \GOAPI\IO\Collection)->toBeTrue();
    expect(is_string($response[0]))->toBeTrue();
});

test('get stock price', function() use($client) {
    $stockIDX = $client->createStockIDX();
    $symbols = ['BBCA'];

    $companies = $stockIDX->getStockPrices($symbols);

    expect($companies->count() == count($symbols))->toBeTrue();
});

test('get stock historical price', function() use($client) {
    $stockIDX = $client->createStockIDX();

    $historical = $stockIDX->getHistoricalData('BBCA', from: date('Y-m-d', strtotime('-1 month')), to: date('Y-m-d'));

    expect($historical instanceof \GOAPI\IO\Collection)->toBeTrue();
});

test('get stock trending', function() use($client) {
    $stockIDX = $client->createStockIDX();

    $results = $stockIDX->getTrendingStocks()->values();
    expect($results)->toBeArray();
});

test('get stock top loser', function() use($client) {
    $stockIDX = $client->createStockIDX();

    $results = $stockIDX->getTopLoserStocks()->values();
    expect($results)->toBeArray();
});

test('get stock top gainer', function() use($client) {
    $stockIDX = $client->createStockIDX();

    $results = $stockIDX->getTopGainerStocks()->values();
    expect($results)->toBeArray();
});

test('get broker summary', function() use($client) {
    $stockIDX = $client->createStockIDX();
    $results  = $stockIDX->getBrokerSummary('BBCA', '2023-10-30');
    
    expect($results instanceof \GOAPI\IO\Collection)->toBeTrue();
});

test('get stock indicators', function() use($client) {
    $stockIDX = $client->createStockIDX();
    $results  = $stockIDX->getStockIndicators(page: 1, date: '2023-10-30');

    expect($results instanceof \GOAPI\IO\Collection)->toBeTrue();
});

test('get brokers', function() use($client) {
    $stockIDX = $client->createStockIDX();
    $results  = $stockIDX->getBrokers();

    expect($results instanceof \GOAPI\IO\Collection)->toBeTrue();
    expect($results[0] instanceof \GOAPI\IO\Resources\Stock\Broker)->toBeTrue();
});