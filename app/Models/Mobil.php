<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Jenssegers\Mongodb\Eloquent\Model;
use Jenssegers\Mongodb\Relations\HasOne;

class Mobil extends Model
{
    use HasFactory;
    protected $connection = 'mongodb';

    protected $table = 'mobils';

    protected $fillable = [
        'mesin',
        'kapasitas_penumpang',
        'tipe',
        'kendaraan_id',
    ];

    public function kendaraans()
    {
        return $this->morphMany(Kendaraan::class, 'kendaraanable');
    }
}
