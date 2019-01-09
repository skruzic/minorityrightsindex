<?php

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
        $oid = OptionGroup::create([
            'name'    => 'Skala 1 do 5',
            'options' => [
                ['num' => 1, 'text' => 'Uopće se ne slažem'],
                ['num' => 2, 'text' => 'Ne slažem se'],
                ['num' => 3, 'text' => 'Niti se slažem, niti se ne slažem'],
                ['num' => 4, 'text' => 'Slažem se'],
                ['num' => 5, 'text' => 'Apsolutno se slažem'],
            ],
        ]);
    }
}
