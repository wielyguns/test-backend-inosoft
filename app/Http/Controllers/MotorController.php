<?php

namespace App\Http\Controllers;

use App\Interfaces\MotorRepositoryInterface;
use Illuminate\Http\JsonResponse;
use Illuminate\Http\Request;

class MotorController extends Controller
{
    private MotorRepositoryInterface $motorRepository;

    public function __construct(MotorRepositoryInterface $MotorRepository)
    {
        $this->motorRepository = $MotorRepository;
    }

    function index(): JsonResponse
    {

        $data = $this->motorRepository->getAllMotors();
        return response()->json([
            'status' => 'OK',
            'data' => $data
        ]);
    }
}
