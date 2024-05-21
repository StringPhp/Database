<?php

namespace StringPhp\Database\Constraints;

use Attribute;

#[Attribute(Attribute::TARGET_PROPERTY)]
class NotNull extends ColumnConstraint
{
    public static function getType(): Constraint
    {
        return Constraint::NOT_NULL;
    }

    public function __toString(): string
    {
        return 'NOT NULL';
    }
}
