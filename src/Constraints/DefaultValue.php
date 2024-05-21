<?php

namespace StringPhp\Database\Constraints;

use Attribute;

#[Attribute(Attribute::TARGET_PROPERTY)]
class DefaultValue extends ColumnConstraint
{
    public function __construct(
        public readonly mixed $value,
    ) {
    }

    public function __toString(): string
    {
        return "DEFAULT {$this->value}";
    }

    public static function getType(): Constraint
    {
        return Constraint::DEFAULT;
    }
}
