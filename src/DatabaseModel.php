<?php

namespace StringPhp\Database;

use Amp\Mysql\MysqlConnectionPool;
use LogicException;
use StringPhp\Models\Model;
use StringPhp\Validation\ValidationException;

use function StringPhp\Validation\getValidators;
use function StringPhp\Validation\validateArray;

abstract class DatabaseModel extends Model
{
    abstract protected static function tableName(): string;

    /**
     * @return string[]
     */
    abstract protected static function primaryKeys(): array;

    abstract protected static function getConnectionPool(): MysqlConnectionPool;

    /**
     * @param Model $existing Must be an instance of the class extending DatabaseModel
     * @param Model $updated Must be an instance of the class extending DatabaseModel
     *
     * @throws ValidationException If the updated model is invalid
     */
    public static function update(Model $existing, Model $updated): void
    {
        if (
            !($existing instanceof self) ||
            !($updated instanceof self)
        ) {
            throw new LogicException('Models must be instances of ' . self::class);
        }

        if (!empty($errors = $updated->validate())) {
            throw new ValidationException($errors);
        }

        $changedFields = $existing->compare($updated);

        if (empty($changedFields)) {
            return;
        }

        $mapParam = static fn (string $param): string => "{$param} = ?";
        $tableName = static::tableName();
        $setFields = 'SET ' . implode(', ', array_map($mapParam, $changedFields));
        $whereFields = 'WHERE ' . implode(' AND ', array_map($mapParam, static::primaryKeys()));

        $params = [];
        $serializedUser = $updated->arraySerialize(true);

        foreach ($changedFields as $field) {
            $params[] = $serializedUser[$field];
        }

        foreach (static::primaryKeys() as $field) {
            $params[] = $serializedUser[$field];
        }

        $query = "UPDATE {$tableName} {$setFields} {$whereFields}";

        static::getConnectionPool()->execute($query, $params);
    }

    public function validate(): array
    {
        return validateArray(
            getValidators(static::class),
            $this->arraySerialize(true)
        );
    }
}
