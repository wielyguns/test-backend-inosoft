<?php

namespace App\Interfaces;

interface KendaraanRepositoryInterface
{
    public function getAllKendaraans();
    public function getIdKendaraan();
    public function getKendaraanById($id, $with = []);
    public function deleteKendaraan($id);
    public function createKendaraan(array $details);
    public function updateKendaraan($id, array $newDetails);
    public function getKendaraanWithEloquent($relation);
}
