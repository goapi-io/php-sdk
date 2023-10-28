<?php
namespace GOAPI\IO;

class IndonesianRegion {
    private $client;
    private $apiBaseUrl = '/regional';

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

    public function getProvince() {
        $endpoint = "/province";
        return $this->makeRequest($endpoint);
    }

    public function getCity($provinceId) {
        $endpoint = "/city";
        $params   = ["province_id" => $provinceId];
        return $this->makeRequest($endpoint, $params);
    }

    public function getSubDistrict() {

    }

    public function getVillage() {
        
    }
}