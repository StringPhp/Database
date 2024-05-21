<?php

namespace StringPhp\Database\Constraints;

use Stringable;

abstract class ColumnConstraint implements Stringable
{
    abstract public static function getType(): Constraint;
}
