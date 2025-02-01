<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;
use Illuminate\Support\Str;

class Pelanggan extends Model
{
    use HasFactory;

    protected $table = 'pelanggans';

    protected $fillable = [
        'id',
        'name',
        'password',
        'nomor_kwh',
        'nomor_hp',
        'alamat',
        'id_tarif',
    ];

    public $incrementing = false; // Matikan auto-increment
    protected $keyType = 'string'; // Atur tipe primary key menjadi string

    protected static function booted()
    {
        static::creating(function ($model) {
            if (empty($model->{$model->getKeyName()})) {
                $model->{$model->getKeyName()} = Str::uuid()->toString();
            }
        });
    }

    public function tarif()
    {
        return $this->belongsTo(Tarif::class, 'id_tarif', 'id');
    }
    public function penggunaanTerakhir()
{
    return $this->hasOne(Penggunaan::class, 'id_pelanggan')->latest();
}

}
