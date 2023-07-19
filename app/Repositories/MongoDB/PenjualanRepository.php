<?php

namespace App\Repositories\MongoDB;

use App\Interfaces\PenjualanRepositoryInterface;
use App\Models\Penjualan;
use Carbon\Carbon;
use Illuminate\Support\Facades\DB;

class PenjualanRepository implements PenjualanRepositoryInterface
{
    public function getAllPenjualans(): Object
    {
        return Penjualan::all();
    }

    public function getPenjualanById($orderId, $with = []): Object
    {
        return Penjualan::with($with)->findOrFail($orderId);
    }

    public function deletePenjualan($orderId): void
    {
        Penjualan::destroy($orderId);
    }

    public function createPenjualan(array $orderDetails): Object
    {
        return Penjualan::create($orderDetails);
    }

    public function updatePenjualan($orderId, array $newDetails): Object
    {
        $data =  Penjualan::findOrFail($orderId);

        foreach ($newDetails as $key => $value) {
            $data[$key] = $value;
        }

        $data->save();
        return $data;
    }

    public function getIdPenjualan(): Object
    {
        return Penjualan::max('id') + 1;
    }

    public function getPenjualanWithEloquent($relation, $where): Object
    {
        return Penjualan::with($relation)
            ->where(function ($q) use ($where) {
                foreach ($where as $key => $value) {
                    if ($key == 'type') {
                        $q->whereHas('kendaraan', function ($q) use ($value) {
                            $q->where('kendaraanable_type', "App\\Models\\$value");
                        });
                    } else {
                        $q->where($key, $value);
                    }
                }
            })
            ->get();
    }

    function sumPenjualanWithEloquent($where, $column): float
    {
        $data = Penjualan::where(function ($q) use ($where) {
            foreach ($where as $key => $value) {
                if ($key == 'type') {
                    $q->whereHas('kendaraan', function ($q) use ($value) {
                        $q->where('kendaraanable_type', "App\\Models\\$value");
                    });
                } elseif ($key == 'created_at') {
                    $q->where('created_at', '>=', Carbon::parse($value[0])->startOfDay());
                    $q->where('created_at', '<=', Carbon::parse($value[1])->startOfDay());
                } else {
                    $q->where($key, $value);
                }
            }
        })->sum($column);
        return $data;
    }

    public function paginatePenjualanWithEloquent($with, $where)
    {
        return Penjualan::with($with)
            ->where(function ($q) use ($where) {
                foreach ($where as $key => $value) {
                    if ($key == 'type') {
                        $q->whereHas('kendaraan', function ($q) use ($value) {
                            $q->where('kendaraanable_type', "App\\Models\\$value");
                        });
                    } elseif ($key == 'created_at') {
                        $q->where('created_at', '>=', Carbon::parse($value[0])->startOfDay());
                        $q->where('created_at', '<=', Carbon::parse($value[1])->startOfDay());
                    } else {
                        $q->where($key, $value);
                    }
                }
            })
            ->paginate();
    }
}
