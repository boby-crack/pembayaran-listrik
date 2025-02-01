<?php

namespace App\Models;
use App\Models\Penggunaan;
use App\Models\Pelanggan;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;
use Illuminate\Database\Eloquent\Concerns\HasUuids;

class Tagihan extends Model
{
     use HasFactory;
   protected $keyType = 'string';
    public $incrementing = false; // UUID tidak auto-increment

    protected $fillable = [
        'id',
        'id_penggunaan',
        'id_pelanggan',
        'bulan',
        'tahun',
        'jumlah_meter',
        'total_tagihan',
        'status',
    ];

    // Relasi ke Penggunaan
    public function penggunaan()
    {
        return $this->belongsTo(Penggunaan::class, 'id_penggunaan');
    }

    // Relasi ke Pelanggan
    public function pelanggan()
    {
        return $this->belongsTo(Pelanggan::class, 'id_pelanggan');
    }

    // Hitung Total Tagihan


    // Event untuk Menghitung Total Tagihan

}
