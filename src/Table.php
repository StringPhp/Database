<?php

namespace StringPhp\Database;

use ReflectionAttribute;
use ReflectionClass;
use ReflectionProperty;
use StringPhp\Database\Constraints\TableConstraintAttribute;

abstract class Table
{
    abstract public static function getName(): string;

    public static function createTableQuery(): string
    {
        $query = "CREATE TABLE " . static::getName() . " (\n";

        foreach ((new ReflectionClass(static::class))->getProperties(ReflectionProperty::IS_PUBLIC) as $property) {
            $column = new Column($property);

            $query .= "    {$column->name} {$column->dataType}";

            if (!empty($column->columnConstraints)) {
                $query .= ' ';
                $query .= implode(' ', $column->columnConstraints);
            }

            $query .= ",\n";
        }

        $query = substr($query, 0, -2);

        $tableConstraints = array_map(
            static fn (ReflectionAttribute $attribute) => $attribute->newInstance(),
            (new ReflectionClass(static::class))->getAttributes(TableConstraintAttribute::class, ReflectionAttribute::IS_INSTANCEOF)
        );

        if (!empty($tableConstraints)) {
            $query .= ",\n    ";
            $query .= implode(",\n    ", $tableConstraints);
        }

        $query .= "\n)";

        return "{$query};";
    }
}