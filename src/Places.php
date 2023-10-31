<?php
namespace GOAPI\IO;

class Places
{
    private $client;
    private $apiBaseUrl = '/places';

    public function __construct(\GuzzleHttp\Client $client) {
        $this->client = $client;
    }

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

    public function search($keyword) {
        $response = $this->makeRequest('', ['search' => $keyword]);

        return (new Collection($response['data']['results']))->map(function($item) {
            return new \GOAPI\IO\Resources\Places\Place(
                id: $item['id'],
                displayName: $item['displayName'],
                lng: $item['lng'],
                lat: $item['lat'],
                coordinate: $item['coordinate'],
            );
        });
    }

}