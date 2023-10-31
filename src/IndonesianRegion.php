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
            return json_decode($response->getBody(), true);
        } catch (\Exception $e) {
            // Handle exceptions and errors here
            // You might want to log the error or throw a custom exception
            return ["error" => $e->getMessage()];
        }
    }

    public function getProvinsi() {
        $endpoint = "/provinsi";
        return (new Collection($this->makeRequest($endpoint)['data']))->map(function($item) {
            return new \GOAPI\IO\Resources\Region\Region($item['id'], $item['name']);
        });
    }

    public function getKota($provinsiId) {
        $endpoint = "/kota";
        $params   = ["provinsi_id" => $provinsiId];
        return (new Collection($this->makeRequest($endpoint, $params)['data']))->map(function($item) {
            return new \GOAPI\IO\Resources\Region\Region($item['id'], $item['name']);
        });
    }

    public function getKecamatan($kotaId) {
        $endpoint = "/kecamatan";
        $params   = ["kota_id" => $kotaId];
        return (new Collection($this->makeRequest($endpoint, $params)['data']))->map(function($item) {
            return new \GOAPI\IO\Resources\Region\Region($item['id'], $item['name']);
        });
    }

    public function getKelurahan($kecamatanId) {
        $endpoint = "/kelurahan";
        $params   = ["kecamatan_id" => $kecamatanId];
        return (new Collection($this->makeRequest($endpoint, $params)['data']))->map(function($item) {
            return new \GOAPI\IO\Resources\Region\Region($item['id'], $item['name']);
        });
    }
}