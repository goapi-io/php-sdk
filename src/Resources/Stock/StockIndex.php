<?php
namespace GOAPI\IO\Resources\Stock;


class StockIndex {

    public function __construct(public $symbol, public $description, public Price $price) {
        
    }

    static function fromArray($array): StockIndex
    {
        return new self(
            $array['symbol'],
            $array['description'],
            Price::fromArray($array['price'])
        );
    }

    static function fromArrayList($array): array
    {
        return array_map(function($item) {
            return self::fromArray($item);
        }, $array);
    }
}