<?php

use Faker\Generator as Faker;
use App\Models\Campaign;

$factory->define(Campaign::class, function (Faker $faker) {
    return [
        'title' => $faker->words(3, true),
        'description' => $faker->paragraph,
        'user_id' => 1,
    ];
});
