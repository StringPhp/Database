<?php

namespace StringPhp\Database\Types\StringTypes;

use Attribute;
use StringPhp\Database\Types\DataType;
use StringPhp\Database\Types\DataTypeAttribute;

#[Attribute(Attribute::TARGET_PROPERTY)]
class Enum extends DataTypeAttribute
{
    public readonly array $values;

    public function __construct(
        string ...$values
    ) {
        $this->values = $values;
    }

    public function __toString(): string
    {
        $choices = implode(', ', array_map(static fn ($value) => "'{$value}'", $this->values));

        return "ENUM({$choices})";
    }

    public static function getDataType(): DataType
    {
        return DataType::ENUM;
    }
}
