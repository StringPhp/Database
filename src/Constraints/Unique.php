<?php

namespace StringPhp\Database\Constraints;

use Attribute;

#[Attribute(Attribute::TARGET_PROPERTY)]
class Unique extends ColumnConstraint
{
    public static function getType(): Constraint
    {
        return Constraint::UNIQUE;
    }

    public function __toString(): string
    {
        return 'UNIQUE';
    }
}