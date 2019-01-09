<?php

use Faker\Generator as Faker;
use App\Models\Question;

$factory->define(Question::class, function (Faker $faker) {
    return [
        //'campaign_id' => $faker->numberBetween(1, 10),
        //'question_type_id' => 1,
        'type'            => $faker->numberBetween(0, 6),
        'question'        => $faker->sentence,
        'option_group_id' => 1,
        'section_id'      => $faker->numberBetween(1, 20),
    ];
});
