<?php

namespace App\Interfaces;

interface MobilRepositoryInterface
{
    public function getAllMobils();
    public function getIdMobil();
    public function getMobilById($id);
    public function deleteMobil($id);
    public function createMobil(array $details);
    public function updateMobil($id, array $newDetails);
    public function getMobilWithEloquent($relation);
}
