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
    const RADIO_ARRAY = 5;
    //const CHECKBOX_ARRAY = 6;
    const STATIC_TEXT = 6;

    public static function getDescription($value): string
    {
        return str_replace('_', ' ', title_case(self::getKey($value)));
    }

    public static function toArray(): array
    {
        $arr = array_flip(parent::toArray());

        foreach ($arr as $key => $value) {
            $arr[$key] = self::getDescription($key);
        }

        return $arr;
    }
}
