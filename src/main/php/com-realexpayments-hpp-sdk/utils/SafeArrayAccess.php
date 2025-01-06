<?php


namespace com\realexpayments\hpp\sdk\utils;


use ArrayAccess;

class SafeArrayAccess implements ArrayAccess
{
    private $array;
    private $default;

    public function __construct(array $array, $default = null)
    {
        $this->array = $array;
        $this->default = $default;
    }

    public function offsetExists($offset): bool
    {
        return isset($this->array[$offset]);
    }

    public function offsetGet($offset): mixed
    {
        return $this->array[$offset] ?? $this->default;
    }

    public function offsetSet($offset, $value): void
    {
        $this->array[$offset] = $value;
    }

    public function offsetUnset($offset): void
    {
        unset($this->array[$offset]);
    }

    public function getUnderLayingArray(): array
    {
        return $this->array;
    }
}