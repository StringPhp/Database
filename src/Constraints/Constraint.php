<?php

namespace StringPhp\Database\Constraints;

enum Constraint
{
    case FOREIGN_KEY;
    case NOT_NULL;
    case AUTO_INCREMENT;
    case PRIMARY_KEY;
    case UNIQUE;
    case DEFAULT;
}