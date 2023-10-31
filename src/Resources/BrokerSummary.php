<?php
namespace GOAPI\IO\Resources;

class BrokerSummary
{
    public Broker $broker;
    public $code;
    public $date;
    public $side;
    public $lot;
    public $value;
    public $transaction_type;
    public $investor;
    public $avg;
    public $symbol;

    public function __construct($code, $broker, $date, $side, $lot, $value, $transaction_type, $investor, $avg, $symbol)
    {
        $this->broker = new Broker($broker['code'], $broker['name']);
        $this->code = $code;
        $this->date = $date;
        $this->side = $side;
        $this->lot = $lot;
        $this->value = $value;
        $this->transaction_type = $transaction_type;
        $this->investor = $investor;
        $this->avg = $avg;
        $this->symbol = $symbol;
    }

    static function fromArray($array) {

        return new BrokerSummary(
            $array['code'],
            $array['broker'],
            $array['date'],
            $array['side'],
            $array['lot'],
            $array['value'],
            $array['transaction_type'],
            $array['investor'],
            $array['avg'],
            $array['symbol']
        );
    }
}