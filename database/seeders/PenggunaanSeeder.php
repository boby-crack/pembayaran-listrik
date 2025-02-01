<?php

namespace Database\Seeders;

use Illuminate\Database\Seeder;
use App\Models\Penggunaan;
use Illuminate\Support\Str;

class PenggunaanSeeder extends Seeder
{
    public function run()
    {
        Penggunaan::insert([
            [
                'id' => '5e270b08-ca78-421b-8e40-33c063406783',
                'id_pelanggan' => '0a1957f8-23d3-406d-8a27-e1ff0c1aed68',
                'bulan' => 'Januari',
                'tahun' => 2024,
                'meter_awal' => 100,
                'meter_akhir' => 200,
            ],
        ]);
    }
}
