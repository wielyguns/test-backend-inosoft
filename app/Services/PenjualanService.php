<?php

namespace App\Services;

use Carbon\Carbon;

class PenjualanService
{
    /**
     * To calculate netto.
     * @param array $req;
     * @return array
     */
    public function data($req): array
    {
        $discount = $req['bruto'] - $req['discount'];
        return [
            'code' => $this->generateCode(),
            'pembeli' => $req['pembeli'],
            'telpon' => $req['telpon'],
            'bruto' => $req['bruto'],
            'discount' => $req['discount'],
            'netto' => $discount,
            'kendaraan_id' => $req['kendaraan_id'],
        ];
    }
    /**
     * To generate code.
     * @return string
     */
    public function generateCode(): string
    {
        return 'POS' . Carbon::now()->format('ymdhis');
    }
}
