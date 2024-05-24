<?php

namespace StringPhp\Database;

use LogicException;
use ReflectionAttribute;
use ReflectionProperty;
use StringPhp\Database\Constraints\ColumnConstraint;
use StringPhp\Database\Constraints\DefaultValue;
use StringPhp\Database\Types\DataTypeAttribute;

class Column
{
    public readonly string $name;
    public readonly DataTypeAttribute $dataType;
    public readonly string $defaultValue;
    public readonly array $columnConstraints;

    public function __construct(
        ReflectionProperty $columnProperty,
    ) {
        $this->name = $columnProperty->name;

        $dataTypeAttributes = $columnProperty->getAttributes(
            DataTypeAttribute::class,
            ReflectionAttribute::IS_INSTANCEOF
        );

        if (empty($dataTypeAttributes)) {
            throw new LogicException(
                "{$columnProperty->getDeclaringClass()->name}::\${$this->name} must have a data type attribute"
            );
        }

        $this->dataType = $dataTypeAttributes[0]->newInstance();

        $mapAttributeInstances = static fn (ReflectionAttribute $attribute) => $attribute->newInstance();

        $defaultValueAttributes = array_map(
            $mapAttributeInstances,
            $columnProperty->getAttributes(
                DefaultValue::class,
                ReflectionAttribute::IS_INSTANCEOF
            )
        );

        if (!empty($defaultValueAttributes)) {
            $this->defaultValue = $defaultValueAttributes[0]->value;
        }

        $this->columnConstraints = array_map(
            $mapAttributeInstances,
            $columnProperty->getAttributes(
                ColumnConstraint::class,
                ReflectionAttribute::IS_INSTANCEOF
            )
        );
    }
}
