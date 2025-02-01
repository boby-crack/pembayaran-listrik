<?php

namespace Database\Seeders;

use Illuminate\Database\Seeder;
use App\Models\Level;

class LevelSeeder extends Seeder
{
    public function run()
    {
        Level::insert([
            ['nama_level' => 'Admin'],
            ['nama_level' => 'User'],
            ['nama_level' => 'Operator'],
        ]);
    }
}
