<?php

namespace StringPhp\Database\Types;

use Stringable;

abstract class DataTypeAttribute implements Stringable
{
    abstract public static function getDataType(): DataType;

    public function __toString(): string
    {
        return static::getDataType()->value;
    }
}