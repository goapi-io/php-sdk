<?php
namespace GOAPI\IO;

class StockIDX {
    private $client;
    private $apiBaseUrl = '/stock/idx';

    public function __construct(\GuzzleHttp\Client $client) {
        $this->client = $client;
    }

    private function makeRequest($endpoint, $params = []) {
        try {
            $response = $this->client->request('GET', $this->apiBaseUrl . $endpoint, [
                'query' => $params,
            ]);

            // Assuming the API returns JSON response
            return json_decode($response->getBody());
        } catch (\Exception $e) {
            // Handle exceptions and errors here
            // You might want to log the error or throw a custom exception
            return ["error" => $e->getMessage()];
        }
    }

    public function getCompanies() {
        $endpoint = "/companies";
        return (new Collection($this->makeRequest($endpoint)->data->results))->map(function($item) {
            return new \GOAPI\IO\Resources\Company($item->symbol, $item->name, $item->logo);
        });
    }

    public function getStockPrices(array $symbols) {
        $endpoint = "/prices";
        $params = ["symbols" => implode(',', $symbols)];
        return (new Collection($this->makeRequest($endpoint, $params)->data->results))->map(function($item) {
            return \GOAPI\IO\Resources\StockPrice::fromArray(json_decode(json_encode($item), true));
        });
    }

    public function getTrendingStocks() {
        $endpoint = "/trending";
        return $this->makeRequest($endpoint);
    }

    public function getTopGainerStocks() {
        $endpoint = "/top_gainer";
        return $this->makeRequest($endpoint);
    }

    public function getTopLoserStocks() {
        $endpoint = "/top_loser";
        return $this->makeRequest($endpoint);
    }

    public function getHistoricalData($symbol, $from = null, $to = null) {
        $endpoint = "/{$symbol}/historical";
        $params = [];
        if ($from) {
            $params["from"] = $from;
        }
        if ($to) {
            $params["to"] = $to;
        }
        return $this->makeRequest($endpoint, $params);
    }

    public function getEIPOList() {
        $endpoint = "/e-ipo";
        return $this->makeRequest($endpoint);
    }

    public function getBrokerSummary($symbol, $date) {
        $endpoint = "/{$symbol}/broker_summary";
        $params = ["date" => $date];
        return $this->makeRequest($endpoint, $params);
    }

    public function getStockIndicators($page = null, $date = null) {
        $endpoint = "/indicators";
        $params = [];
        if ($page) {
            $params["page"] = $page;
        }
        if ($date) {
            $params["date"] = $date;
        }
        return $this->makeRequest($endpoint, $params);
    }
}

// Example usage:
// $apiBaseUrl = "https://api.example.com";
// $stockAPI = new StockIDX($apiBaseUrl);
// $stockPrices = $stockAPI->getStockPrices("BBCA,AALI,GOTO");
// var_dump($stockPrices);
