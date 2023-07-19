<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Jenssegers\Mongodb\Eloquent\Model;
use Jenssegers\Mongodb\Relations\HasOne;

class Motor extends Model
{
    use HasFactory;
    protected $fillable = [
        'mesin',
        'tipe_suspensi',
        'tipe_transmisi',
        'kendaraan_id',
    ];

    public function kendaraans()
    {
        return $this->morphMany(Kendaraan::class, 'kendaraanable');
    }
}
