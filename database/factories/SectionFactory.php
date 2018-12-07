<?php

use Faker\Generator as Faker;
use App\Models\Section;

$factory->define(Section::class, function (Faker $faker) {
    return [
        'campaign_id' => $faker->numberBetween(1, 10),
        'title'       => $faker->words(3, true),
        'description' => $faker->paragraphs(2, true),
        'order'       => $faker->numberBetween(1, 20),
    ];
});
