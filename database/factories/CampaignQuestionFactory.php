<?php

use Faker\Generator as Faker;
use App\Models\CampaignQuestion;

$factory->define(CampaignQuestion::class, function (Faker $faker) {
    return [
        'campaign_id' => $faker->numberBetween(1, 10),
        'question_id' => $faker->numberBetween(1, 30),
        'order'       => $faker->numberBetween(1, 10),
        'user_id'     => 1,
    ];
});
