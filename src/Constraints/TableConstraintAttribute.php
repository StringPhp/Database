<?php

namespace StringPhp\Database\Constraints;

use Stringable;

abstract class TableConstraintAttribute implements Stringable
{
    abstract public static function getType(): Constraint;
}