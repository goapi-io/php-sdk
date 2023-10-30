<?php
namespace GOAPI\IO\Resources;

use Psr\Http\Message\ResponseInterface;


class StockPrice {
    public $symbol;
    public $company;
    public $date;
    public $open;
    public $high;
    public $low;
    public $close;
    public $volume;

    function __construct($symbol, Company $company, $date, $open, $high, $low, $close, $volume) {
        $this->symbol = $symbol;
        $this->company = $company;
        $this->date = $date;
        $this->open = $open;
        $this->high = $high;
        $this->low = $low;
        $this->close = $close;
        $this->volume = $volume;
    }

    static function fromArray($array): StockPrice {
        $company = Company::fromArray($array['company']);

        return new self(
            $array['symbol'],
            $company,
            $array['date'],
            $array['open'],
            $array['high'],
            $array['low'],
            $array['close'],
            $array['volume']
        );
    }

    static function fromJson($json): StockPrice {
        $array = json_decode($json, true);
        return self::fromArray($array);
    }
}