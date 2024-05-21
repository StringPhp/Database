<?php

namespace StringPhp\Database\Types\StringTypes;

use Attribute;
use StringPhp\Database\Types\DataType;
use StringPhp\Database\Types\SizedDataTypeAttribute;

#[Attribute(Attribute::TARGET_PROPERTY)]
class Text extends SizedDataTypeAttribute
{
    public function __construct(
        int $size = 65535
    ) {
        parent::__construct($size);
    }

    public static function getDataType(): DataType
    {
        return DataType::TEXT;
    }
}
