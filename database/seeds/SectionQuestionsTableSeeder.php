<?php

use Illuminate\Database\Seeder;
use App\Models\SectionQuestion;

class SectionQuestionsTableSeeder extends Seeder
{
    /**
     * Run the database seeds.
     *
     * @return void
     */
    public function run()
    {
        factory(SectionQuestion::class,100)->create();
    }
}
