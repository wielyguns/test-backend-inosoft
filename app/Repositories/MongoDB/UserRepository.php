<?php

namespace App\Repositories\MongoDB;

use App\Interfaces\UserRepositoryInterface;
use App\Models\User;

class UserRepository implements UserRepositoryInterface
{
    public function getAllUsers(): Object
    {
        return User::all();
    }

    public function getUserById($orderId, $with = []): Object
    {
        return User::with($with)->findOrFail($orderId);
    }

    public function deleteUser($orderId): void
    {
        User::destroy($orderId);
    }

    public function createUser(array $orderDetails): Object
    {
        return User::create($orderDetails);
    }

    public function updateUser($orderId, array $newDetails): Object
    {
        return User::whereId($orderId)->update($newDetails);
    }

    public function getIdUser(): Object
    {
        return User::max('id') + 1;
    }

    public function getUserWithEloquent($relation): Object
    {
        return User::with($relation)->get();
    }

    public function findUserWhere(array $relation): ?Object
    {
        return User::where(function ($q) use ($relation) {
            foreach ($relation as $key => $value) {
                $q->where($key, $value);
            }
        })->first();
    }
}
