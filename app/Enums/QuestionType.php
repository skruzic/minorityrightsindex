<?php

namespace App\Enums;

enum QuestionType: int
{
    case Text = 0;
    case TextArea = 1;
    case Choice = 2;
    case MultipleChoice = 3;
    case ChoiceArray = 4;
    case StaticText = 5;

    public function label(): string
    {
        return match ($this) {
            self::Text => 'Text',
            self::TextArea => 'Text area',
            self::Choice => 'Choice',
            self::MultipleChoice => 'Multiple choice',
            self::ChoiceArray => 'Choice array',
            self::StaticText => 'Static text',
        };
    }

    /**
     * @return array<int, string>
     */
    public static function asSelectArray(): array
    {
        $options = [];

        foreach (self::cases() as $case) {
            $options[$case->value] = $case->label();
        }

        return $options;
    }

    /**
     * @return array<int, int>
     */
    public static function getValues(): array
    {
        return array_map(fn (self $case) => $case->value, self::cases());
    }
}
