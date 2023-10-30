<?php
namespace GOAPI\IO\Resources;

use Psr\Http\Message\ResponseInterface;


class StockPriceChange {
    public $symbol;
    public $company;
    public $close;
    public $change;
    public $percent;

    function __construct($symbol, Company $company, $close, $change, $percent,) {
        $this->symbol = $symbol;
        $this->company = $company;
        $this->close = $close;
        $this->change = $change;
        $this->percent = $percent;
    }

    static function fromArray($array): StockPriceChange {

        $company = Company::fromArray($array['company']);

        return new self(
            $array['symbol'],
            $company,
            $array['close'],
            $array['change'],
            $array['percent']
        );
    }
}