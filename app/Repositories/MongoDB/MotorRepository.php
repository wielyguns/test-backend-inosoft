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

    public function getMotorById($orderId): Object
    {
        return Motor::findOrFail($orderId);
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
        return Motor::whereId($orderId)->update($newDetails);
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
