<?php

namespace StringPhp\Database\Types;

enum DataType: string
{
    case INTEGER = 'integer';
    case VARCHAR = 'varchar';
    case ENUM = 'enum';
    case TEXT = 'text';
    case BLOB = 'blob';
    case LONGBLOB = 'longblob';
}
