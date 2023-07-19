<?php

namespace App\Services;

use App\Interfaces\PenjualanRepositoryInterface;
use Carbon\Carbon;

class ReportService
{
    private PenjualanRepositoryInterface $penjualan;

    function __construct(PenjualanRepositoryInterface $Penjualan)
    {
        $this->penjualan = $Penjualan;
    }
    /**
     * To calculate netto.
     * @param array $req;
     * @return array
     */
    public function where($req): array
    {
        $where = [];
        if ($req['type'] != '') {
            $where['type'] = ucwords(strtolower($req['type']));
        }

        $where['created_at'] = [
            CarbonParse(dateStore(request('min_date')), 'Y-m-d'),
            CarbonParse(dateStore(request('max_date')), 'Y-m-d')
        ];
        return $where;
    }
    /**
     * To calculate revenue per kendaraan.
     * @param array $req;
     * @return array
     */
    function pendapatan(): array
    {
        $createdAt = [
            CarbonParse(dateStore(request('min_date')), 'Y-m-d'),
            CarbonParse(dateStore(request('max_date')), 'Y-m-d')
        ];

        $where['motor'] = [
            'type' => 'Motor',
            'created_at' => $createdAt
        ];

        $where['mobil'] = [
            'type' => 'Mobil',
            'created_at' => $createdAt
        ];

        return [
            'motor' => $this->penjualan->sumPenjualanWithEloquent($where['motor'], 'netto'),
            'mobil' => $this->penjualan->sumPenjualanWithEloquent($where['mobil'], 'netto')
        ];
    }
}
