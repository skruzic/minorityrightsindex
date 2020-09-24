<?php

namespace App\Enums;

use BenSampo\Enum\Enum;

final class QuestionType extends Enum
{
    const Text = 0;
    const TextArea = 1;
    const Choice = 2;
    const MultipleChoice = 3;
    const Panel = 4;
    const RadioArray = 5;
    //const CHECKBOX_ARRAY = 6;
    const StaticText = 6;

    public static function asArray(): array
    {
        $arr = array_flip(parent::asArray());

        foreach ($arr as $key => $value) {
            $arr[$key] = self::getDescription($key);
        }

        return $arr;
    }
}
