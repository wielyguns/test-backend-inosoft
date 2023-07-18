<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Relations\MorphOne;
use Jenssegers\Mongodb\Eloquent\Model;

class Motor extends Model
{
    use HasFactory;

    /**
     * Get the motor's kendaraan.
     */
    public function kendaraan(): MorphOne
    {
        return $this->morphOne(Kendaraan::class, 'kendaraanable');
    }
}
