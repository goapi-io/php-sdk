<?php


$client = new \GOAPI\IO\Client([
    'api_key' => getenv('GOAPI_IO_API_KEY'), // your api key
]);

test('get client instance', function () use($client) {
    $region = $client->createIndonesianRegion();

    expect($region instanceof \GOAPI\IO\IndonesianRegion)->toBeTrue();
});

test('get provinsi', function () use($client) {
    $region = $client->createIndonesianRegion();

    $response = $region->getProvinsi();
    
    expect($response->values())->toBeArray();
    expect($response->values()[0] instanceof \GOAPI\IO\Resources\Region\Region)->toBeTrue();
});

test('get kota', function () use($client) {
    $region = $client->createIndonesianRegion();

    $response = $region->getKota('11');


    expect($response->values())->toBeArray();
    expect($response->values()[0] instanceof \GOAPI\IO\Resources\Region\Region)->toBeTrue();
});

test('get kecamatan', function () use($client) {
    $region = $client->createIndonesianRegion();

    $response = $region->getKecamatan('11.01');

    expect($response->values())->toBeArray();
    expect($response->values()[0] instanceof \GOAPI\IO\Resources\Region\Region)->toBeTrue();
});

test('get kelurahan', function () use($client) {
    $region = $client->createIndonesianRegion();

    $response = $region->getKelurahan('11.01.01');

    expect($response->values())->toBeArray();
    expect($response->values()[0] instanceof \GOAPI\IO\Resources\Region\Region)->toBeTrue();
});
