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
        } catch (\GuzzleHttp\Exception\RequestException $e) {
            // Handle exceptions and errors here
            // You might want to log the error or throw a custom exception
            if($e->getResponse()->getStatusCode() === 401) {
                $response = json_decode($e->getResponse()->getBody()->getContents(), true);
                throw new \GOAPI\IO\Exceptions\RequestException($response['message'], $e->getResponse()->getStatusCode());
            }

            throw new \GOAPI\IO\Exceptions\RequestException($e->getMessage(), $e->getCode());
        }
    }

    public function getCompanies() {
        $endpoint = "/companies";
        return (new Collection($this->makeRequest($endpoint)['data']['results']))->map(function($item) {
            return new \GOAPI\IO\Resources\Stock\Company($item['symbol'], $item['name'], $item['logo']);
        });
    }

    public function getProfile($symbol) {
        $endpoint = "/$symbol/profile";

        if($this->makeRequest($endpoint)['data']) {
            return \GOAPI\IO\Resources\Stock\CompanyProfile::fromArray($this->makeRequest($endpoint)['data']);
        }

    }

    public function getStockPrices(array $symbols) {
        $endpoint = "/prices";
        $params = ["symbols" => implode(',', $symbols)];
        return (new Collection($this->makeRequest($endpoint, $params)['data']['results']))->map(function($item) {
            return \GOAPI\IO\Resources\Stock\StockPrice::fromArray($item);
        });
    }

    public function getTrendingStocks() {
        $endpoint = "/trending";
        return (new Collection($this->makeRequest($endpoint)['data']['results']))->map(function($item) {
            return \GOAPI\IO\Resources\Stock\StockPriceChange::fromArray($item);
        });
    }

    public function getTopGainerStocks() {
        $endpoint = "/top_gainer";
        return (new Collection($this->makeRequest($endpoint)['data']['results']))->map(function($item) {
            return \GOAPI\IO\Resources\Stock\StockPriceChange::fromArray($item);
        });
    }

    public function getTopLoserStocks() {
        $endpoint = "/top_loser";
        return (new Collection($this->makeRequest($endpoint)['data']['results']))->map(function($item) {
            return \GOAPI\IO\Resources\Stock\StockPriceChange::fromArray($item);
        });
    }

    public function getIndices() {
        $endpoint = "/indices";
        return (new Collection($this->makeRequest($endpoint)['data']['results']))->map(function($item) {
            return \GOAPI\IO\Resources\Stock\StockIndex::fromArray($item);
        });
    }

    /**
     * Retrieves the index items for a given symbol.
     *
     * @param string $symbol The index symbol for which to retrieve index items.
     * @return \Illuminate\Support\Collection A collection of StockIndex objects.
     */
    public function getIndexItems($symbol) {
        $endpoint = "/index/$symbol/items";
        return (new Collection($this->makeRequest($endpoint)['data']['results']));
    }

    /**
     * Retrieves historical data for a given stock symbol within a specified date range.
     *
     * @param string $symbol The stock symbol to retrieve historical data for.
     * @param string|null $from The start date of the historical data range in 'YYYY-MM-DD' format. Defaults to null.
     * @param string|null $to The end date of the historical data range in 'YYYY-MM-DD' format. Defaults to null.
     * @return \GOAPI\IO\Resources\Stock\StockPrice[] A collection of StockPrice objects representing the historical data.
     */
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
            return \GOAPI\IO\Resources\Stock\StockPrice::fromArray($item);
        });
    }

    public function getEIPOList() {
        $endpoint = "/e-ipo";
        return $this->makeRequest($endpoint);
    }

    /**
     * Retrieves the broker summary for a given symbol and date.
     *
     * @param string $symbol The symbol to retrieve the broker summary for.
     * @param string $date The date to retrieve the broker summary for.
     * @throws Some_Exception_Class A description of the exception that may be thrown.
     * @return Collection The broker summary as a collection of BrokerSummary objects.
     */
    public function getBrokerSummary($symbol, $date) {
        $endpoint = "/{$symbol}/broker_summary";
        $params   = ["date" => $date];

        return (new Collection($this->makeRequest($endpoint, $params)['data']['results']))->map(function($item) {
            return \GOAPI\IO\Resources\Stock\BrokerSummary::fromArray($item);
        });
    }

    /**
     * Retrieves the stock indicators from the API.
     *
     * @param int $page The page number of the results. Default is 1.
     * @param string|null $date The date of the indicators. Default is null.
     * @throws Some_Exception_Class A description of the exception that can be thrown.
     * @return Collection A collection of StockIndicator objects.
     */
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
            return \GOAPI\IO\Resources\Stock\StockIndicator::fromArray($item);
        });
    }

    public function getBrokers() {
        $endpoint = "/brokers";
        return (new Collection($this->makeRequest($endpoint)['data']['results']))->map(function($item) {
            return new \GOAPI\IO\Resources\Stock\Broker($item['code'], $item['name']);
        });
    }
}