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
            'name' => 'Skala 1 do 5',
            'options' => ['1','2','3','4','5'],
        ]);

        //$oid->save();
    }
}
