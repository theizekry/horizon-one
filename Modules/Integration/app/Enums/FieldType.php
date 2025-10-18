<?php

namespace Modules\Integration\Enums;

enum FieldType: int
{
    case DIRECT    = 0;
    case RELATION  = 1;
    case JSON_PATH = 2;

    public function stringVal(): string
    {
        return match ($this) {
            self::DIRECT    => '0',
            self::RELATION  => '1',
            self::JSON_PATH => '2',
        };
    }
}
