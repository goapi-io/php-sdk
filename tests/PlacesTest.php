<?php

$client = new \GOAPI\IO\Client([
    'api_key' => getenv('GOAPI_IO_API_KEY'), // your api key
]);

test('get client instance', function () use($client) {
    $instance = $client->createPlaces();

    expect($instance instanceof \GOAPI\IO\Places)->toBeTrue();
});

test('get search', function () use($client) {
    $instance = $client->createPlaces();

    $response = $instance->search("Jakarta");


    expect($response->values())->toBeArray();
    expect($response[0] instanceof \GOAPI\IO\Resources\Places\Place)->toBeTrue();
});