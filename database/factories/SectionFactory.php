<?php

namespace Database\Factories;

use Illuminate\Database\Eloquent\Factories\Factory;
use App\Models\Section;
use App\Models\Campaign;

class SectionFactory extends Factory
{
    protected $model = Section::class;

    public function definition()
    {
        $campaign_ids = Campaign::all()->pluck('id')->toArray();

        return [
            'title'       => $this->faker->sentence(3),
            'description' => $this->faker->text,
            'campaign_id' => $this->faker->randomElement($campaign_ids),
        ];
    }
}

/*$factory->define(Section::class, function (Faker $faker) {
    return [
        'campaign_id' => $faker->numberBetween(1, 10),
        'title'       => $faker->words(3, true),
        'description' => $faker->paragraphs(2, true),
        //'order'       => $faker->numberBetween(1, 20),
    ];
});*/
