<?php
namespace GOAPI\IO\Resources\Stock;


class Price {

    public function __construct(
        public $date, 
        public $open,
        public $high,
        public $low,
        public $close, 
        public $volume,
        public $change,
        public $change_pct,
    ) {}


    public static function fromArray($array) {
        return new self(
            $array['date'],
            $array['open'],
            $array['high'],
            $array['low'],
            $array['close'],
            $array['volume'],
            $array['change'],
            $array['change_pct']
        );
    }
}