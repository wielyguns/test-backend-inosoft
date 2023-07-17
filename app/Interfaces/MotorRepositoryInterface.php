<?php

namespace App\Interfaces;

interface MotorRepositoryInterface
{
    public function getAllMotors();
    public function getIdMotor();
    public function getMotorById($id);
    public function deleteMotor($id);
    public function createMotor(array $details);
    public function updateMotor($id, array $newDetails);
    public function getMotorWithEloquent($relation);
}
