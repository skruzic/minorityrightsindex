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
            'name'    => 'radio',
            'display' => 'Choice',
        ]);

        QuestionType::create([
            'name'    => 'checkbox',
            'display' => 'Multiple choice',
        ]);

        QuestionType::create([
            'name'    => 'text',
            'display' => 'Text',
        ]);

        QuestionType::create([
            'name'    => 'textarea',
            'display' => 'Text area',
        ]);
    }
}
