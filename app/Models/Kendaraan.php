<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Jenssegers\Mongodb\Eloquent\Model;
use Jenssegers\Mongodb\Relations\MorphTo;

class Kendaraan extends Model
{
    use HasFactory;

    /**
     * Get the parent kendaraanable model (motor,mobil).
     */
    public function imageable(): MorphTo
    {
        return $this->morphTo();
    }
}
