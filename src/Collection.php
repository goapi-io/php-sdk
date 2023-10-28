<?php
namespace GOAPI\IO;


class Collection {

    private $items;

    function __construct($array)
    {
        $this->items = $array;
    }

    function count() {
        return count($this->items);
    }

    public function filter(callable $callback = null)
    {

        if ($callback) {
            return new static( array_filter($this->items, $callback, ARRAY_FILTER_USE_BOTH) );
        }

        return new static( array_filter($this->items) );
    }

    public function values() : Array {
        return $this->items;
    }

    public function take($count) {
        return new static(array_slice($this->items, 0, $count));
    }

    public function map(callable $callback) {
        return new static(array_map($callback, $this->items));
    }

}