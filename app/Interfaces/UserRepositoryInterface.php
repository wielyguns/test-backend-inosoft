<?php

namespace App\Interfaces;

interface UserRepositoryInterface
{
    public function getAllUsers();
    public function getIdUser();
    public function getUserById($id, $with = []);
    public function deleteUser($id);
    public function createUser(array $details);
    public function updateUser($id, array $newDetails);
    public function getUserWithEloquent($relation);
    public function findUserWhere(array $where);
}
