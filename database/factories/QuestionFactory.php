<?php

use Faker\Generator as Faker;
use App\Models\Question;

$factory->define(Question::class, function (Faker $faker) {
    return [
        'campaign_id' => $faker->numberBetween(1, 10),
        'type'        => $faker->word,
        'questions'   => serialize($faker->sentences(3)),
        'options'     => serialize($faker->sentences(3)),
        'order'       => $faker->numberBetween(1, 10),
    ];
});
