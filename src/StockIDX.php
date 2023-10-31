<?php
namespace GOAPI\IO;

class StockIDX {
    private $client;
    private $apiBaseUrl = '/stock/idx';

    /**
     * Constructs a new instance of the class.
     *
     * @param \GuzzleHttp\Client $client The Guzzle HTTP client.
     */
    public function __construct(\GuzzleHttp\Client $client) {
        $this->client = $client;
    }

    /**
     * Makes a request to the specified endpoint with optional parameters.
     *
     * @param string $endpoint The endpoint to make the request to.
     * @param array $params Optional parameters to include in the request.
     * @throws \Exception If an error occurs during the request.
     * @return array The response from the API as an associative array.
     */
    private function makeRequest($endpoint, $params = []) {
        try {
            $response = $this->client->request('GET', $this->apiBaseUrl . $endpoint, [
                'query' => $params,
            ]);

            // Assuming the API returns JSON response
            return json_decode($response->getBody(), true);
        } catch (\Exception $e) {
            // Handle exceptions and errors here
            // You might want to log the error or throw a custom exception
            return ["error" => $e->getMessage()];
        }
    }

    public function getCompanies() {
        $endpoint = "/companies";
        return (new Collection($this->makeRequest($endpoint)['data']['results']))->map(function($item) {
            return new \GOAPI\IO\Resources\Company($item['symbol'], $item['name'], $item['logo']);
        });
    }

    public function getProfile($symbol) {
        $endpoint = "/$symbol/profile";

        if($this->makeRequest($endpoint)['data']) {
            return \GOAPI\IO\Resources\CompanyProfile::fromArray($this->makeRequest($endpoint)['data']);
        }

    }

    public function getStockPrices(array $symbols) {
        $endpoint = "/prices";
        $params = ["symbols" => implode(',', $symbols)];
        return (new Collection($this->makeRequest($endpoint, $params)['data']['results']))->map(function($item) {
            return \GOAPI\IO\Resources\StockPrice::fromArray($item);
        });
    }

    public function getTrendingStocks() {
        $endpoint = "/trending";
        return (new Collection($this->makeRequest($endpoint)['data']['results']))->map(function($item) {
            return \GOAPI\IO\Resources\StockPriceChange::fromArray($item);
        });
    }

    public function getTopGainerStocks() {
        $endpoint = "/top_gainer";
        return (new Collection($this->makeRequest($endpoint)['data']['results']))->map(function($item) {
            return \GOAPI\IO\Resources\StockPriceChange::fromArray($item);
        });
    }

    public function getTopLoserStocks() {
        $endpoint = "/top_loser";
        return (new Collection($this->makeRequest($endpoint)['data']['results']))->map(function($item) {
            return \GOAPI\IO\Resources\StockPriceChange::fromArray($item);
        });
    }

    public function getIndices() {
        $endpoint = "/indices";
        return (new Collection($this->makeRequest($endpoint)['data']['results']))->map(function($item) {
            return \GOAPI\IO\Resources\StockPriceChange::fromArray($item);
        });
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

        return (new Collection($this->makeRequest($endpoint)['data']['results']))->map(function($item) {
            return \GOAPI\IO\Resources\StockPrice::fromArray($item);
        });
    }

    public function getEIPOList() {
        $endpoint = "/e-ipo";
        return $this->makeRequest($endpoint);
    }

    public function getBrokerSummary($symbol, $date) {
        $endpoint = "/{$symbol}/broker_summary";
        $params   = ["date" => $date];

        return (new Collection($this->makeRequest($endpoint, $params)['data']['results']))->map(function($item) {
            return \GOAPI\IO\Resources\BrokerSummary::fromArray($item);
        });
    }

    public function getStockIndicators($page = 1, $date = null) {
        $endpoint = "/indicators";
        $params = [];
        if ($page) {
            $params["page"] = $page;
        }
        if ($date) {
            $params["date"] = $date;
        }

        return (new Collection($this->makeRequest($endpoint, $params)['data']['results']))->map(function($item) {
            return \GOAPI\IO\Resources\StockIndicator::fromArray($item);
        });
    }
}