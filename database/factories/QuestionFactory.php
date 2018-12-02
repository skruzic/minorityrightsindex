<?php

use Faker\Generator as Faker;
use App\Models\Question;

$factory->define(Question::class, function (Faker $faker) {
    return [
        //'campaign_id' => $faker->numberBetween(1, 10),
        'type'        => $faker->randomElement(['radio', 'checkbox', 'text']),
        'questions'   => $faker->sentences(3),
        'options'     => $faker->sentences(3),
        //'order'       => $faker->numberBetween(1, 10),
    ];
});
