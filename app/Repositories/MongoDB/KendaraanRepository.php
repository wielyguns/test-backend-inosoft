<?php

namespace App\Repositories\MongoDB;

use App\Interfaces\KendaraanRepositoryInterface;
use App\Models\Kendaraan;

class KendaraanRepository implements KendaraanRepositoryInterface
{
    public function getAllKendaraans(): Object
    {
        return Kendaraan::all();
    }

    public function getKendaraanById($orderId): Object
    {
        return Kendaraan::findOrFail($orderId);
    }

    public function deleteKendaraan($orderId): void
    {
        Kendaraan::destroy($orderId);
    }

    public function createKendaraan(array $orderDetails): Object
    {
        return Kendaraan::create($orderDetails);
    }

    public function updateKendaraan($orderId, array $newDetails): Object
    {
        return Kendaraan::whereId($orderId)->update($newDetails);
    }

    public function getIdKendaraan(): Object
    {
        return Kendaraan::max('id') + 1;
    }

    public function getKendaraanWithEloquent($relation): Object
    {
        return Kendaraan::with($relation)->get();
    }
}
