<?php

namespace StringPhp\Database\Constraints;

use Attribute;

#[Attribute(Attribute::TARGET_PROPERTY)]
class Primary extends ColumnConstraint
{
    public static function getType(): Constraint
    {
        return Constraint::PRIMARY_KEY;
    }

    public function __toString(): string
    {
        return 'PRIMARY KEY';
    }
}
