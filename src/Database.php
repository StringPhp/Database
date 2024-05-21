<?php

namespace StringPhp\Database;

use Amp\Mysql\MysqlConnectionPool;
use Psr\Log\LoggerInterface;
use Throwable;

class Database
{
    public function __construct(
        public readonly LoggerInterface $logger,
        public readonly MysqlConnectionPool $mysql,
        array $tables = []
    )
    {
        $result = $this->mysql->query('SHOW TABLES;');

        $existingTables = [];

        while ($row = $result->fetchRow()) {
            $existingTables[] = array_values($row)[0];
        }

        $this->logger->debug('Loading tables...');

        foreach ($tables as $table) {
            $this->logger->debug('Loading class ' . $table . '...');

            if (
                !class_exists($table) ||
                !is_subclass_of($table, Table::class)
            ) {
                $this->logger->error('Invalid table class: ' . $table);
                continue;
            }

            try {
                $tableName = [$table, 'getName']();
            } catch (Throwable $e) {
                $this->logger->error('Failed to load table: ' . $table, [
                    'exception' => (string)$e,
                ]);

                continue;
            }

            if (!in_array($tableName, $existingTables)) {
                $this->logger->debug('Table doesnt exist, creating it...');

                try {
                    $this->mysql->query([$table, 'createTableQuery']());
                } catch (Throwable $e) {
                    $this->logger->error('Failed to create table: ' . $tableName, [
                        'exception' => (string)$e,
                    ]);

                    continue;
                }
            }

            $this->logger->debug('Loaded table: ' . $tableName);
        }
    }
}