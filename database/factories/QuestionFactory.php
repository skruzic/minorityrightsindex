<?php

use Faker\Generator as Faker;
use App\Models\Question;

$factory->define(Question::class, function (Faker $faker) {
    return [
        //'campaign_id' => $faker->numberBetween(1, 10),
        'question_type_id' => 1,
        'questions'        => $faker->sentences(3),
        'option_group_id'  => 1,
    ];
});
