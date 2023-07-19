<?php

namespace App\Repositories\MongoDB;

use App\Interfaces\MobilRepositoryInterface;
use App\Models\Mobil;

class MobilRepository implements MobilRepositoryInterface
{
    public function getAllMobils(): Object
    {
        return Mobil::all();
    }

    public function getMobilById($orderId, $with = []): Object
    {
        return Mobil::with($with)->findOrFail($orderId);
    }

    public function deleteMobil($orderId): void
    {
        Mobil::destroy($orderId);
    }

    public function createMobil(array $orderDetails): Object
    {
        return Mobil::create($orderDetails);
    }

    public function updateMobil($orderId, array $newDetails): Object
    {
        $data =  Mobil::findOrFail($orderId);

        foreach ($newDetails as $key => $value) {
            $data[$key] = $value;
        }

        $data->save();

        return $data;
    }

    public function getIdMobil(): Object
    {
        return Mobil::max('id') + 1;
    }

    public function getMobilWithEloquent($relation): Object
    {
        return Mobil::with($relation)->get();
    }
}
