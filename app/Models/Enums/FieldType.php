<?php

namespace App\Models\Enums;

/**
 * @method static FieldType DATE()
 * @method static FieldType NUMBER()
 * @method static FieldType STRING()
 * @method static FieldType BOOLEAN()
 */
class FieldType extends Enum
{
    private const DATETYPE = 'date';
    private const NUMBERTYPE = 'number';
    private const STRINGTYPE = 'string';
    private const BOOLEANTYPE = 'boolean';
}
