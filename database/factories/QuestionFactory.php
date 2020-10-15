<?php

namespace Database\Factories;

use App\Enums\QuestionType;
use App\Models\Campaign;
use App\Models\OptionGroup;
use Illuminate\Database\Eloquent\Factories\Factory;
use App\Models\Question;

class QuestionFactory extends Factory
{
    protected $model = Question::class;

    public function definition()
    {
        $campaign_ids = Campaign::all()->pluck('id')->toArray();

        return [
            'code'        => $this->faker->uuid,
            'type'        => $this->faker->randomElement(QuestionType::getValues()),
            'text'        => $this->faker->sentence,
            'campaign_id' => $this->faker->randomElement($campaign_ids),
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
