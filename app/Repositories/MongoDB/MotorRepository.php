<?php

namespace App\Repositories\MongoDB;

use App\Interfaces\MotorRepositoryInterface;
use App\Models\Motor;

class MotorRepository implements MotorRepositoryInterface
{
    public function getAllMotors(): Object
    {
        return Motor::all();
    }

    public function getMotorById($orderId, $with = []): Object
    {
        return Motor::with($with)->findOrFail($orderId);
    }

    public function deleteMotor($orderId): void
    {
        Motor::destroy($orderId);
    }

    public function createMotor(array $orderDetails): Object
    {
        return Motor::create($orderDetails);
    }

    public function updateMotor($orderId, array $newDetails): Object
    {
        $data =  Motor::findOrFail($orderId);

        foreach ($newDetails as $key => $value) {
            $data[$key] = $value;
        }

        $data->save();
        return $data;
    }

    public function getIdMotor(): Object
    {
        return Motor::max('id') + 1;
    }

    public function getMotorWithEloquent($relation): Object
    {
        return Motor::with($relation)->get();
    }
}
