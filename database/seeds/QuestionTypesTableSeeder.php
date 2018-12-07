<?php

use Illuminate\Database\Seeder;
use App\Models\QuestionType;

class QuestionTypesTableSeeder extends Seeder
{
    /**
     * Run the database seeds.
     *
     * @return void
     */
    public function run()
    {
        QuestionType::create([
            'name' => 'choice',
            'display' => 'Choice',
        ]);

        QuestionType::create([
            'name' => 'multiple_choice',
            'display' => 'Multiple choice'
        ]);
    }
}
