<?php

namespace Database\Seeders;

use Illuminate\Database\Seeder;
use App\Models\Pelanggan;
use Illuminate\Support\Str;

class PelangganSeeder extends Seeder
{
    public function run()
    {
        Pelanggan::insert([
            [
                'id' => '0a1957f8-23d3-406d-8a27-e1ff0c1aed68',
                'name' => 'John Doe',
                'password' => bcrypt('password'),
                'nomor_hp' => '081234567890',
                'alamat' => 'Jalan Mawar No. 10',
                'id_tarif' => 1,
                'nomor_kwh' => 'KWH12345',

            ],
            [
                'id' => Str::uuid(),
                'name' => 'John Doe 2',
                'password' => bcrypt('password'),
                'nomor_hp' => '081234567890',
                'alamat' => 'Jalan Mawar No. 10',
                'id_tarif' => 2,
                'nomor_kwh' => 'KWH12345',
            ],
        ]);
    }
}
