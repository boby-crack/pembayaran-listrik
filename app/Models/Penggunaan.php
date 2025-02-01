<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;
use Illuminate\Database\Eloquent\Concerns\HasUuids;

class Penggunaan extends Model
{
    use HasFactory, HasUuids;

    protected $primaryKey = 'id';
    public $incrementing = false;
    protected $keyType = 'string';
    protected $table = 'penggunaans';

    protected $fillable = ['id_pelanggan', 'bulan', 'tahun', 'meter_awal', 'meter_akhir'];
     public function pelanggan()
    {
        return $this->belongsTo(Pelanggan::class, 'id_pelanggan', 'id');
    }
    public function getSelisihMeteranAttribute()
{
    return $this->meter_akhir - $this->meter_awal;
}

}
