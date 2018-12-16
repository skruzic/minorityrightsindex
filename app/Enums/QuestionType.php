<?php

namespace App\Enums;

use BenSampo\Enum\Enum;

final class QuestionType extends Enum
{
    const TEXT = 0;
    const TEXT_AREA = 1;
    const CHOICE = 2;
    const MULTIPLE_CHOICE = 3;
    const PANEL = 4;

    public static function getDescription($value): string
    {
        return str_replace('_', ' ', title_case(self::getKey($value)));
    }
}
