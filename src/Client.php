<?php
namespace GOAPI\IO;

use GuzzleHttp\Client as GuzzleHttpClient;

class Client {

    const API_BASE_PATH = 'https://api.goapi.io';
    const API_VERSION   = 'v1';
    const LIBVER        = '0.0.1';

    private $config;

    private $idx;

    private $regional;

    private $places;

    private $http;

    function __construct(array $config=[])
    {
        $this->config = array_merge([
            'base_uri' => self::API_BASE_PATH.'/'.self::API_VERSION.'/',
            'api_key'   => '',
        ], $config);

    }

    function getHttpClient() {
        if(!isset($this->http)) {
            $this->http = $this->createHttpClient();
        }

        return $this->http;
    }

    protected function createHttpClient() {
        $options = [
            'base_uri' => $this->config['base_uri'],
            'headers' => [
                'X-API-KEY' => $this->config['api_key']
            ]
        ];

        return new GuzzleHttpClient($options);
    }

    function createStockIDX(): \GOAPI\IO\StockIDX {
        return new \GOAPI\IO\StockIDX($this->getHttpClient());
    }
    
}