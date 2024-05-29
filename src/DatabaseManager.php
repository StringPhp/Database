<?php

namespace StringPhp\Database;

interface DatabaseManager
{
    public function __construct(
        Database $database,
    );
}
