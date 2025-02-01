<?php

namespace Database\Seeders;

use Illuminate\Database\Seeder;
use App\Models\Pembayaran;
use Illuminate\Support\Str;

class PembayaranSeeder extends Seeder
{
    public function run()
    {
        Pembayaran::insert([
            [
                'id' => Str::uuid(),
                'id_tagihan' => '3e270b08-ca78-421b-8e40-33c063406784',
                'tanggal_pembayaran' => now(),
                'bulan_bayar' => 'Januari',
                'biaya_admin' => 5000,
                'total_bayar' => 150000,
                'id_user' => '5f1b45b2-24a6-41d8-a5cc-223cc9a6f004',
            ],
        ]);
    }
}
