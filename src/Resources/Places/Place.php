<?php
namespace GOAPI\IO\Resources\Places;

class Place {

    function __construct(
        public $id,
        public $displayName,
        public $lng,
        public $lat,
        public $coordinate,
    ) {}
}