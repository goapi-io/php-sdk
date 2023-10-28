<?php
namespace GOAPI\IO\Resources;

use Psr\Http\Message\ResponseInterface;

class Company {

    public $symbol;
    public $name;
    public $logo;

    function __construct(
        $symbol,
        $name,
        $logo
    )
    {
        $this->symbol = $symbol;
        $this->name = $name;
        $this->logo = $logo;
    }

    static function fromArray($array): Company {
        return new self(
            $array['symbol'],
            $array['name'],
            $array['logo']
        );
    }

    static function fromArrayList($array): \GOAPI\IO\Collection {
        $output = [];

        foreach($array as $item) {
            $output[] = new static($item->symbol, $item->name, $item->logo);
        }

        return new \GOAPI\IO\Collection($output);
    }

    static function fromResponse(ResponseInterface $response): \GOAPI\IO\Collection {
        $array = json_decode($response->getBody()->getContents());

        return self::fromArrayList($array->data->results);
    }
}