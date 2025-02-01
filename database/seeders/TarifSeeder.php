<?php

namespace Database\Seeders;

use Illuminate\Database\Seeder;
use App\Models\Tarif;

class TarifSeeder extends Seeder
{
    public function run()
    {
        Tarif::insert([
            ['daya' => 900, 'tarifperkwh' => 1350.50],
            ['daya' => 1300, 'tarifperkwh' => 1440.75],
            ['daya' => 2200, 'tarifperkwh' => 1550.00],
        ]);
    }
}
