<?php

namespace App\Models\Enums;

use Illuminate\Support\Str;

class Enum extends \MyCLabs\Enum\Enum
{
    public function format(): string
    {
        return static::labels()[$this->value];
    }

    public static function labels(): array
    {
        return array_map(function ($value) {
            return str_replace('_', ' ', Str::title($value));
        }, array_flip(static::toArray()));
    }
}
