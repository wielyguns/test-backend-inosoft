<?php

namespace App\Interfaces;

interface PenjualanRepositoryInterface
{
    public function getAllPenjualans();
    public function getIdPenjualan();
    public function getPenjualanById($id, $with = []);
    public function deletePenjualan($id);
    public function createPenjualan(array $details);
    public function updatePenjualan($id, array $newDetails);
    public function getPenjualanWithEloquent($relation, $where);
    public function sumPenjualanWithEloquent($where, $column);
    public function paginatePenjualanWithEloquent($with, $where);
}
