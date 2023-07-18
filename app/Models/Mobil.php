<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;
use Illuminate\Database\Eloquent\Relations\MorphOne;

class Mobil extends Model
{
    use HasFactory;

    /**
     * Get the mobil's kendaraan.
     */
    public function kendaraan(): MorphOne
    {
        return $this->morphOne(Kendaraan::class, 'kendaraanable');
    }
}
