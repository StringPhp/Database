<?php

namespace StringPhp\Database\Types;

use Override;

abstract class SizedDataTypeAttribute extends DataTypeAttribute
{
    public function __construct(
        public readonly int $size
    ) {

    }

    #[Override]
    public function __toString(): string
    {
        return static::getDataType()->value . "({$this->size})";
    }
}
