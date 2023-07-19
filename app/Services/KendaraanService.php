<?php

namespace App\Services;

use App\Interfaces\MobilRepositoryInterface;
use App\Interfaces\MotorRepositoryInterface;

class KendaraanService
{
    private MotorRepositoryInterface $motor;
    private MobilRepositoryInterface $mobil;

    function __construct(MotorRepositoryInterface $Motor, MobilRepositoryInterface $Mobil)
    {
        $this->motor = $Motor;
        $this->mobil = $Mobil;
    }
    /**
     * To saving pivot of kendaraan.
     *
     * @param  string  $type
     * @param  string  $kendaraanableId
     * @param  object  $data
     * @return void
     */
    public function savePivot($type, $kendaraanableId, $data): void
    {
        if ($type == 'motor') {
            $this->motor->getMotorById($kendaraanableId)->kendaraans()->save($data);
        } else {
            $this->mobil->getMobilById($kendaraanableId)->kendaraans()->save($data);
        }
    }
}
