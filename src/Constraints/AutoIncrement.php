<?php

namespace StringPhp\Database\Constraints;

use Attribute;

#[Attribute(Attribute::TARGET_PROPERTY)]
class AutoIncrement extends ColumnConstraint
{
    public static function getType(): Constraint
    {
        return Constraint::AUTO_INCREMENT;
    }

    public function __toString(): string
    {
        return "AUTO_INCREMENT";
    }
}