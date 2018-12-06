<?php

use Faker\Generator as Faker;
use App\Models\SectionQuestion;

$factory->define(SectionQuestion::class, function (Faker $faker) {
    return [
        'section_id'  => $faker->numberBetween(1, 10),
        'question_id' => $faker->numberBetween(1, 30),
        'order'       => $faker->numberBetween(1, 10),
    ];
});
