<?php
namespace GOAPI\IO\Exceptions;

class RequestException extends \Exception {

    function __construct($message, $code)
    {
        parent::__construct($message, $code);
    }
}