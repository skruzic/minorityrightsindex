<?php

namespace Database\Factories;

use App\Enums\AccessType;
use App\Models\Campaign;
use Illuminate\Database\Eloquent\Factories\Factory;

class CampaignFactory extends Factory
{
    protected $model = Campaign::class;

    public function definition()
    {
        return [
            'title'       => $this->faker->sentence(3),
            'slug'        => $this->faker->slug,
            'description' => $this->faker->text,
            'access_type'      => $this->faker->randomElement(AccessType::getValues()),
        ];
    }
}
