<?php

namespace Database\Seeders;

use Illuminate\Database\Seeder;
use App\Models\OptionGroup;
use App\Models\Option;

class OptionsTableSeeder extends Seeder
{
    /**
     * Run the database seeds.
     *
     * @return void
     */
    public function run()
    {
        OptionGroup::create([
            'name'    => 'Skala 1 do 5',
            'options' => [
                ['value' => 1, 'text' => 'Uopće se ne slažem'],
                ['value' => 2, 'text' => 'Ne slažem se'],
                ['value' => 3, 'text' => 'Niti se slažem, niti se ne slažem'],
                ['value' => 4, 'text' => 'Slažem se'],
                ['value' => 5, 'text' => 'Apsolutno se slažem'],
            ],
        ]);

        OptionGroup::create([
            'name'    => 'Da/ne',
            'options' => [
                ['value' => 1, 'text' => 'Da'],
                ['value' => 0, 'text' => 'Ne'],
            ],
        ]);
    }
}
