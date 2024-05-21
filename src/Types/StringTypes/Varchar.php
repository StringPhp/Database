<?php

namespace StringPhp\Database\Types\StringTypes;

use Attribute;
use StringPhp\Database\Types\DataType;
use StringPhp\Database\Types\DataTypeAttribute;
use StringPhp\Database\Types\SizedDataTypeAttribute;

#[Attribute(Attribute::TARGET_PROPERTY)]
class Varchar extends SizedDataTypeAttribute
{
    public function __construct(
        int $size = 255
    )
    {
        parent::__construct($size);
    }

    public static function getDataType(): DataType
    {
        return DataType::VARCHAR;
    }
}