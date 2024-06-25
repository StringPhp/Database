<?php

namespace StringPhp\Database\Types\StringTypes;

use Attribute;
use StringPhp\Database\Types\DataType;
use StringPhp\Database\Types\DataTypeAttribute;

#[Attribute(Attribute::TARGET_PROPERTY)]
class LongBlob extends DataTypeAttribute
{

    public static function getDataType(): DataType
    {
        return DataType::LONGBLOB;
    }
}