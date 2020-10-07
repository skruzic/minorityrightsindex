<?php

namespace Database\Factories;

use App\Models\Section;
use Illuminate\Database\Eloquent\Factories\Factory;
use App\Models\Question;

class QuestionFactory extends Factory
{
    protected $model = Question::class;

    public function definition()
    {
        $section_ids = Section::all()->pluck('id')->toArray();

        return [
            //'campaign_id' => $faker->numberBetween(1, 10),
            //'question_type_id' => 1,
            'code'            => $this->faker->uuid,
            'type'            => $this->faker->numberBetween(0, 6),
            'text'            => $this->faker->sentence,
            'option_group_id' => 1,
            'section_id'      => $this->faker->randomElement($section_ids),
        ];
    }

    /*$factory->define(Question::class, function (Faker $faker)
    {
        return [
            //'campaign_id' => $faker->numberBetween(1, 10),
            //'question_type_id' => 1,
            'type'            => $faker->numberBetween(0, 6),
            'question'        => $faker->sentence,
            'option_group_id' => 1,
            'section_id'      => $faker->numberBetween(1, 20),
        ];
    });*/
}
