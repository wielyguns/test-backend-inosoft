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

    public function getMobilById($orderId): Object
    {
        return Mobil::findOrFail($orderId);
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
        return Mobil::whereId($orderId)->update($newDetails);
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
