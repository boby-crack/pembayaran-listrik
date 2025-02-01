<?php

namespace Database\Seeders;

use Illuminate\Database\Seeder;
use App\Models\Tagihan;
use Illuminate\Support\Str;

class TagihanSeeder extends Seeder
{
    public function run()
    {


        Tagihan::create([
                'id' => '3e270b08-ca78-421b-8e40-33c063406784',
                'id_penggunaan' => '5e270b08-ca78-421b-8e40-33c063406783',
                'id_pelanggan' => '0a1957f8-23d3-406d-8a27-e1ff0c1aed68',
                'bulan' => now()->format('m'),
                'tahun' => now()->format('Y'),
                'jumlah_meter' => 100,
                'total_tagihan' => 200000,
                'status' => 'belum lunas',
            ]);
    }
}
