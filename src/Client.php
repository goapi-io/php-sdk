<?php
namespace GOAPI\IO;

use GuzzleHttp\Client as GuzzleHttpClient;

class Client {
    const API_BASE_PATH = 'https://api.goapi.io';
    const API_VERSION = '';

    private $config;
    private $http;

    public function __construct(array $config = [])
    {
        $this->config = array_merge([
            'base_uri' => self::API_BASE_PATH . '/' . self::API_VERSION . '/',
            'api_key' => '',
        ], $config);
    }

    private function createHttpClient()
    {
        $options = [
            'base_uri' => $this->config['base_uri'],
            'headers' => [
                'X-API-KEY' => $this->config['api_key']
            ]
        ];

        return new GuzzleHttpClient($options);
    }

    public function getHttpClient()
    {
        if (!isset($this->http)) {
            $this->http = $this->createHttpClient();
        }

        return $this->http;
    }


    public function createStockIDX()
    {
        return new \GOAPI\IO\StockIDX($this->getHttpClient());
    }

    public function createIndonesianRegion()
    {
        return new \GOAPI\IO\IndonesianRegion($this->getHttpClient());
    }

    public function createPlaces()
    {
        return new \GOAPI\IO\Places($this->getHttpClient());
    }
}