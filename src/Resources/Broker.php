<?php
namespace GoAPI\IO\Resources;

class Broker {
    public $code;
    public $name;

    public function __construct($code, $name)
    {
        $this->code = $code;
        $this->name = $name;
    }
}