<?php

use Illuminate\Database\Seeder;
use App\Models\CampaignQuestion;

class CampaignQuestionTableSeeder extends Seeder
{
    /**
     * Run the database seeds.
     *
     * @return void
     */
    public function run()
    {
        factory(CampaignQuestion::class, 20)->create();
    }
}
