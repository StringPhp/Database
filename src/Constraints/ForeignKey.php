<?php

namespace StringPhp\Database\Constraints;

use Attribute;

#[Attribute(Attribute::TARGET_CLASS)]
class ForeignKey extends TableConstraintAttribute
{
    public function __construct(
        public readonly string $columnName,
        public readonly string $referencedTable,
        public readonly string $referencedColumn
    ) {

    }

    public function __toString(): string
    {
        return "FOREIGN KEY ({$this->columnName}) REFERENCES {$this->referencedTable}({$this->referencedColumn})";
    }

    public static function getType(): Constraint
    {
        return Constraint::FOREIGN_KEY;
    }
}