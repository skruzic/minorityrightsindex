<?php

use Faker\Generator as Faker;
use App\Models\Section;

$factory->define(Section::class, function (Faker $faker) {
    return [
        'campaign_id' => $faker->numberBetween(1, 10),
        'order'       => $faker->numberBetween(1, 20),
    ];
});
