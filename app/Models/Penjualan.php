<?php

namespace App\Models;

use DateTimeInterface;
use Illuminate\Database\Eloquent\Factories\HasFactory;
use Jenssegers\Mongodb\Eloquent\Model;
use Jenssegers\Mongodb\Relations\HasOne;

class Penjualan extends Model
{
    use HasFactory;
    protected $fillable = [
        'code',
        'pembeli',
        'telpon',
        'bruto',
        'discount',
        'netto',
        'kendaraan_id',
    ];

    protected function serializeDate(DateTimeInterface $date): string
    {
        return $date->format('Y-m-d H:i:s');
    }

    function kendaraan(): HasOne
    {
        return $this->hasOne(Kendaraan::class, '_id', 'kendaraan_id');
    }
}
