<?php

namespace GOAPI\IO;


class Collection implements \Countable, \ArrayAccess, \IteratorAggregate
{

    private $items;

    function __construct($array)
    {
        $this->items = $array;
    }

    public function count(): int
    {
        return count($this->items);
    }

    public function offsetSet($offset, $value): void {
        if (is_null($offset)) {
            $this->items[] = $value;
        } else {
            $this->items[$offset] = $value;
        }
    }

    public function offsetExists($offset): bool {
        return isset($this->items[$offset]);
    }

    public function offsetUnset($offset): void {
        unset($this->items[$offset]);
    }

    public function offsetGet($offset): mixed {
        return isset($this->items[$offset]) ? $this->items[$offset] : null;
    }

    public function filter(callable $callback = null)
    {

        if ($callback) {
            return new static(array_filter($this->items, $callback, ARRAY_FILTER_USE_BOTH));
        }

        return new static(array_filter($this->items));
    }

    public function values(): array
    {
        return array_values($this->items);
    }

    public function take($count)
    {
        return new static(array_slice($this->items, 0, $count));
    }

    public function map(callable $callback)
    {
        return new static(array_map($callback, $this->items));
    }

    public function getIterator(): \Traversable
    {
        return new \ArrayIterator($this->items);
    }

}
