<?php

namespace Database\Seeders;

use Illuminate\Database\Seeder;

class DatabaseSeeder extends Seeder
{
    public function run(): void
    {
        $this->call([
            LevelSeeder::class,
            UserSeeder::class,
            TarifSeeder::class,
            PelangganSeeder::class,
            PenggunaanSeeder::class,
            TagihanSeeder::class,
            PembayaranSeeder::class,
        ]);
    }
}
